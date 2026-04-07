<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{
    /**
     * Display a listing of CVs with optional search and date filters.
     */
    public function index(Request $request)
    {
        $query = Cv::where('user_id', Auth::id());

        // Search by Title/Keywords
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Filter by Date Range (Fixed presets)
        if ($request->filled('date_range')) {
            if ($request->date_range == '7_days') {
                $query->where('created_at', '>=', now()->subDays(7));
            } elseif ($request->date_range == '30_days') {
                $query->where('created_at', '>=', now()->subDays(30));
            }
        }

        // Filter by Specific Date Range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter by Domain (Job Position)
        if ($request->filled('domain')) {
            $query->where('title', 'like', '%' . $request->domain . '%');
        }

        // Sorting Logic
        $sortBy = $request->get('sort_by', 'latest');
        switch ($sortBy) {
            case 'oldest':
                $query->oldest();
                break;
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $cvs = $query->paginate(9)->withQueryString();

        return view('client.cv-management', compact('cvs'));
    }

    /**
     * Store a newly created CV.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'cv_file' => 'nullable|file|mimes:pdf,docx|max:10240',
            'manual_content' => 'nullable|string',
        ]);

        $cv = new Cv();
        $cv->user_id = Auth::id();
        $cv->title = $request->title;

        if ($request->hasFile('cv_file')) {
            $path = $request->file('cv_file')->store('cvs', 'public');
            $cv->file_path = $path;
            $cv->is_uploaded = true;

            // Extract Text
            $fullPath = storage_path('app/public/' . $path);
            $ext = strtolower($request->file('cv_file')->getClientOriginalExtension());
            $extractedText = '';

            try {
                if ($ext === 'pdf') {
                    $parser = new \Smalot\PdfParser\Parser();
                    $pdf = $parser->parseFile($fullPath);
                    $extractedText = $pdf->getText();
                } elseif (in_array($ext, ['doc', 'docx'])) {
                    $phpWord = \PhpOffice\PhpWord\IOFactory::load($fullPath);
                    foreach ($phpWord->getSections() as $section) {
                        foreach ($section->getElements() as $element) {
                            if (method_exists($element, 'getElements')) {
                                foreach ($element->getElements() as $childElement) {
                                    if (method_exists($childElement, 'getText')) {
                                        $extractedText .= $childElement->getText() . ' ';
                                    }
                                }
                            } elseif (method_exists($element, 'getText')) {
                                $extractedText .= $element->getText() . "\n";
                            }
                        }
                    }
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('CV parsing failed: ' . $e->getMessage());
            }

            // Cleanup whitespace
            $extractedText = trim(preg_replace('/\s+/', ' ', $extractedText));
            
            // Prevent JSON Encoding Exception for Malformed UTF-8 from PDF
            $extractedText = mb_convert_encoding($extractedText, 'UTF-8', 'UTF-8');
            
            $cv->content = ['text' => $extractedText];
        } else {
            $sampleData = $this->getDefaultBuilderData();
            if ($request->filled('manual_content')) {
                $sampleData['text'] = $request->manual_content;
            }
            $cv->content = $sampleData;
            $cv->is_uploaded = false;
        }

        $cv->save();

        return redirect()->route('client.cv-management')->with('success', 'Hồ sơ đã được lưu thành công.');
    }

    /**
     * Update an existing CV.
     */
    public function update(Request $request, Cv $cv)
    {
        $this->authorizeOwner($cv);

        $request->validate([
            'title' => 'required|string|max:255',
            'manual_content' => 'nullable|string',
        ]);

        $cv->title = $request->title;
        
        // ONLY update content if it's a simple text-based CV (not a builder one)
        if (!$cv->is_uploaded && (!isset($cv->content['header']))) {
            if ($request->has('manual_content')) {
                $cv->content = ['text' => $request->manual_content];
            }
        }

        $cv->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true, 
                'title' => $cv->title,
                'message' => 'Đã cập nhật tiêu đề hồ sơ.'
            ]);
        }

        return redirect()->route('client.cv-management')->with('success', 'Hồ sơ đã được cập nhật.');
    }

    /**
     * Remove the specified CV.
     */
    public function destroy(Cv $cv)
    {
        $this->authorizeOwner($cv);

        if ($cv->is_uploaded && $cv->file_path) {
            Storage::disk('public')->delete($cv->file_path);
        }

        $cv->delete();

        return redirect()->route('client.cv-management')->with('success', 'Hồ sơ đã được xóa.');
    }

    /**
     * Show the CV Template gallery.
     */
    public function templates()
    {
        $templates = [
            [
                'id' => 'classic_prof',
                'name' => 'Chuyên nghiệp',
                'category' => 'Professional',
                'preview' => '/images/templates/prof.png',
                'colors' => ['indigo', 'slate', 'emerald'],
                'description' => 'Mẫu truyền thống, phù hợp cho các khối ngành kỹ thuật và quản lý.'
            ],
            [
                'id' => 'modern_bento',
                'name' => 'Bento Hiện đại',
                'category' => 'Modern',
                'preview' => '/images/templates/modern.png',
                'colors' => ['rose', 'amber', 'indigo'],
                'description' => 'Bố cục 2 cột sáng tạo, tối ưu hóa không gian và trải nghiệm đọc.'
            ],
            [
                'id' => 'minimalist',
                'name' => 'Tối giản',
                'category' => 'Simple',
                'preview' => '/images/templates/minimal.png',
                'colors' => ['slate', 'stone', 'zinc'],
                'description' => 'Loại bỏ sự rườm rà, tập trung hoàn toàn vào nội dung công việc.'
            ],
            [
                'id' => 'creative_ats',
                'name' => 'Sáng tạo & ATS',
                'category' => 'ATS',
                'preview' => '/images/templates/ats.png',
                'colors' => ['violet', 'cyan', 'rose'],
                'description' => 'Dễ đọc bởi robot (ATS) nhưng vẫn giữ được nét cá tính riêng.'
            ]
        ];

        return view('cvs.templates', compact('templates'));
    }

    /**
     * Store a new CV based on a selected template.
     */
    public function storeWithTemplate(Request $request)
    {
        $request->validate([
            'template_id' => 'required|string',
            'base_color' => 'nullable|string'
        ]);

        $cv = new Cv();
        $cv->user_id = Auth::id();
        $cv->title = 'CV mới (' . date('d/m/Y') . ')';
        $cv->is_uploaded = false;

        $content = $this->getDefaultBuilderData();
        $content['settings']['theme'] = $request->base_color ?? 'indigo';
        $content['settings']['template'] = $request->template_id;

        $cv->content = $content;
        $cv->save();

        return redirect()->route('client.cv-builder', $cv);
    }

    /**
     * Show the interactive CV Builder.
     */
    public function builder(Request $request, Cv $cv)
    {
        $this->authorizeOwner($cv);

        // Allow forcing a demo reset via ?reset=1
        if ($request->has('reset') || empty($cv->content) || !isset($cv->content['header'])) {
            $cv->content = $this->getDefaultBuilderData();
            $cv->save();
        }

        return view('cvs.builder', compact('cv'));
    }

    /**
     * Get the default rich sample data for CV Builder.
     */
    private function getDefaultBuilderData()
    {
        return [
            'settings' => [
                'theme' => 'blue',
                'font' => 'Be Vietnam Pro',
                'zoom' => 0.9,
                'font_size' => 10.5,
                'template' => 'tpl_1'
            ],
            'header' => [
                'name' => Auth::user()->name ?: 'CHU QUỐC TUẤN',
                'job_title' => 'Lập Trình Viên Web',
                'image' => null,
                'phone' => '0983267793',
                'email' => Auth::user()->email ?: 'chutuxfyu@gmail.com',
                'dob' => '02/10/2006',
                'gender' => 'Nam',
                'address' => 'Phường Lý Thường Kiệt - Ninh Bình'
            ],
            'left_sections' => [
                [
                    'id' => 'edu',
                    'title' => 'HỌC VẤN',
                    'items' => [
                        [
                            'title' => 'Trường Cao Đẳng FPT Polytechnic',
                            'subtitle' => 'Lập Trình Web',
                            'date' => '2024 - 2026',
                            'description' => "- Sinh viên học kỳ 5 / 6\n- GPA: 3.72 / 4.0"
                        ]
                    ]
                ],
                [
                    'id' => 'skills',
                    'title' => 'KỸ NĂNG',
                    'items' => [
                        [
                            'title' => 'Ngôn ngữ: PHP, JS',
                            'subtitle' => 'Cơ sở dữ liệu: My SQL',
                            'date' => '',
                            'description' => "- Làm việc nhóm\n- Giải quyết vấn đề"
                        ]
                    ]
                ],
                [
                    'id' => 'certs',
                    'title' => 'CHỨNG CHỈ',
                    'items' => [
                        [
                            'title' => '2025: Xây dựng hệ thống quản lý & tự động hóa quy trình hợp tác doanh nghiệp',
                            'subtitle' => '',
                            'date' => '',
                            'description' => "- 2025: Luyện tập kỹ năng lập trình OOP PHP"
                        ]
                    ]
                ],
                [
                    'id' => 'awards',
                    'title' => 'GIẢI THƯỞNG',
                    'items' => [
                        [
                            'title' => 'Đạt danh hiệu Ong vàng học kỳ 3.',
                            'subtitle' => '',
                            'date' => '',
                            'description' => "- Đạt danh hiệu Sinh viên giỏi kỳ 1,2,3,4."
                        ]
                    ]
                ]
            ],
            'right_sections' => [
                [
                    'id' => 'objective',
                    'title' => 'MỤC TIÊU NGHỀ NGHIỆP',
                    'type' => 'text',
                    'content' => "Ngắn hạn (dưới 2 năm): Nâng cao kỹ năng lập trình, tích lũy kinh nghiệm thực tế, cải thiện khả năng xử lý lỗi.\nDài hạn (2-3 năm): Trở thành lập trình viên vững chuyên môn, có khả năng phát triển và tối ưu hệ thống độc lập, đóng góp hiệu quả vào các dự án của công ty."
                ],
                [
                    'id' => 'experience',
                    'title' => 'KINH NGHIỆM LÀM VIỆC',
                    'items' => [
                        [
                            'title' => 'Dự án 1: Hệ thống đặt phòng khách sạn',
                            'subtitle' => 'Vai trò: Trưởng nhóm',
                            'date' => '13/11/2025 - 10/12/2025',
                            'description' => "- Phân công công việc và quản lý tiến độ cho các thành viên trong nhóm.\n- Tham gia xây dựng các chức năng chính: đặt phòng, thanh toán online, quản lý đơn phòng.\n- Kiểm thử chức năng và hỗ trợ xử lý lỗi phát sinh.\n- Đảm bảo dự án hoàn thành đúng thời hạn.\n- Kết quả hoàn thành tốt dự án ( 8đ )."
                        ],
                        [
                            'title' => 'Dự án N8N',
                            'subtitle' => 'Xây dựng hệ thống quản lý & tự động hóa quy trình hợp tác doanh nghiệp',
                            'date' => '10/2025 - 12/2025',
                            'description' => "- Xây dựng workflow tự động hóa bằng n8n để thu thập và xử lý dữ liệu\n- Sử dụng HTTP Request để crawl và trích xuất dữ liệu\n- Xây dựng các bước xử lý dữ liệu (lọc, chuẩn hóa, loại bỏ trùng lặp)\n- Tích hợp hệ thống qua API/Webhook\n- Giảm -70% thao tác nhập liệu thủ công"
                        ]
                    ]
                ],
                [
                    'id' => 'activities',
                    'title' => 'HOẠT ĐỘNG',
                    'items' => [
                        [
                            'title' => 'Câu Lạc Bộ IT',
                            'subtitle' => 'Thành viên',
                            'date' => '2024 - 2026',
                            'description' => "- Tham gia hỗ trợ trending AI cho các thầy cô giáo tiểu học và trung học\n- Hỗ trợ người dân thực hiện một số thủ tục hành chính ở các phường xã\n- Tham gia các cuộc thi kỹ năng tin học và công nghệ thông tin"
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Save the structured builder data.
     */
    public function saveBuilder(Request $request, Cv $cv)
    {
        $this->authorizeOwner($cv);

        $cv->content = $request->input('content');
        $cv->save();

        return response()->json(['success' => true, 'message' => 'Hồ sơ đã được lưu.']);
    }

    /**
     * Ensure the logged-in user owns the CV.
     */
    protected function authorizeOwner(Cv $cv)
    {
        if ($cv->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền thực hiện hành động này.');
        }
    }
}
