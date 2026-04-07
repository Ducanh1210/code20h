<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenRouterService
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl = 'https://openrouter.ai/api/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = config('services.openrouter.api_key', env('OPENROUTER_API_KEY'));
        $this->model = config('services.openrouter.model', env('OPENROUTER_MODEL', 'google/gemini-2.0-flash-001'));
    }

    /**
     * Compare CV content with a Job Description.
     */
    public function compareCvWithJd(string $cvText, string $jdText): array
    {
        $prompt = <<<PROMPT
Bạn là chuyên gia tuyển dụng & phân tích CV hàng đầu. Hãy so sánh CV với JD (Job Description) bên dưới.

=== CV ===
{$cvText}

=== JD (Mô tả công việc) ===
{$jdText}

Hãy phân tích và trả về KẾT QUẢ CHÍNH XÁC dưới dạng JSON (KHÔNG markdown, KHÔNG ```, CHỈ JSON thuần):

{
  "match_score": <số nguyên từ 0-100>,
  "match_level": "<Phù hợp cao|Phù hợp trung bình|Chưa phù hợp>",
  "summary": "<Tóm tắt ngắn gọn 2-3 câu về mức độ phù hợp>",
  "strengths": [
    {"title": "<Điểm mạnh>", "detail": "<Chi tiết giải thích>"}
  ],
  "weaknesses": [
    {"title": "<Điểm yếu>", "detail": "<Chi tiết giải thích>"}
  ],
  "missing_skills": ["<kỹ năng thiếu 1>", "<kỹ năng thiếu 2>"],
  "skill_breakdown": [
    {"category": "<Nhóm kỹ năng>", "required": "<Yêu cầu từ JD>", "score": <0-100>}
  ],
  "experience_analysis": [
    {"company": "<Tên công ty>", "role": "<Vị trí>", "period": "<Thời gian>", "relevance": <0-100>, "note": "<Đánh giá mức độ liên quan đến JD>"}
  ],
  "improvement_suggestions": [
    "<Gợi ý cải thiện 1>",
    "<Gợi ý cải thiện 2>"
  ],
  "roadmap": {
    "current_progress": <số nguyên 0-100, dựa trên mức độ đáp ứng JD hiện tại>,
    "estimated_time": "<Ước tính thời gian cần thiết để bù đắp các lỗ hổng, VD: 12 giờ, 2 tuần...>",
    "focus_today": ["<Kỹ năng trọng tâm 1 cần học ngay>", "<Kỹ năng trọng tâm 2>"],
    "steps": [
      {
        "title": "<Tên bước/kỹ năng trong lộ trình>",
        "description": "<Mô tả ngắn gọn nội dung cần học hoặc hành động cần thực hiện>",
        "topics": ["<Chủ đề con 1>", "<Chủ đề con 2>"],
        "duration": "<Thời gian ước tính cho bước này, VD: 4 giờ, 2 ngày>",
        "status": "<completed|active|pending - completed cho kỹ năng đã có, active cho kỹ năng quan trọng nhất đang thiếu, pending cho còn lại>",
        "type": "<theory|practice|project>"
      }
    ]
  }
}

QUY TẮC PHÂN TÍCH:
- Chỉ dựa trên THÔNG TIN CÓ TRONG CV, KHÔNG được tự ý bịa thêm kinh nghiệm.
- match_score: Đánh giá trung thực, khắt khe dựa trên JD.
- missing_skills: Liệt kê RÕ RÀNG các kỹ năng JD yêu cầu mà CV không đề cập hoặc chưa đạt tới level yêu cầu.

QUY TẮC SINH LỘ TRÌNH (ROADMAP):
- Nếu CV chưa đáp ứng đầy đủ yêu cầu (thiếu kinh nghiệm/kỹ năng) -> BẮT BUỘC cung cấp lộ trình học tập để bù đắp.
- Roadmap phải thực tế, chia thành các giai đoạn (steps).
- Mỗi step phải có:
    - title: Tên kỹ năng/giai đoạn.
    - description: Hành động cụ thể (VD: Học khóa X, Xây dựng dự án Y).
    - topics: 3-5 chủ đề con liên quan mật thiết.
    - duration: Thời gian thực tế để nắm vững (VD: 10 giờ, 3 ngày, 1 tuần).
- roadmap.current_progress: Phản ánh % mức độ sẵn sàng hiện tại của ứng viên.
- Trả lời bằng tiếng Việt.
PROMPT;

        return $this->callApi($prompt);
    }

    /**
     * Analyze CV content (extract skills, experience, projects, achievements).
     */
    public function analyzeCv(string $cvText): array
    {
        $prompt = <<<PROMPT
Bạn là chuyên gia phân tích CV. Hãy trích xuất thông tin từ CV sau:

=== CV ===
{$cvText}

Trả về KẾT QUẢ dưới dạng JSON (KHÔNG markdown, KHÔNG ```, CHỈ JSON thuần):

{
  "candidate_name": "<Tên ứng viên>",
  "job_title": "<Vị trí ứng tuyển>",
  "skills": {
    "technical": ["<Kỹ năng kỹ thuật 1>", "<Kỹ năng kỹ thuật 2>"],
    "soft": ["<Kỹ năng mềm 1>", "<Kỹ năng mềm 2>"]
  },
  "experience": [
    {"company": "<Tên công ty>", "role": "<Vai trò>", "period": "<Thời gian>", "highlights": ["<Thành tựu>"]}
  ],
  "projects": [
    {"name": "<Tên dự án>", "description": "<Mô tả ngắn>", "tech": ["<Công nghệ>"]}
  ],
  "achievements": ["<Thành tựu 1>", "<Thành tựu 2>"],
  "education": [
    {"school": "<Tên trường>", "major": "<Ngành>", "period": "<Thời gian>", "gpa": "<GPA nếu có>"}
  ],
  "overall_assessment": "<Đánh giá tổng quan về chất lượng CV, 2-3 câu>"
}

QUY TẮC:
- Chỉ trích xuất thông tin CÓ TRONG CV, KHÔNG bịa thêm.
- Nếu mục nào không có thông tin, để mảng rỗng [].
- Trả lời bằng tiếng Việt.
PROMPT;

        return $this->callApi($prompt);
    }

    /**
     * Generate interactive interview quiz (multiple-choice + fill-in-the-blank) based on JD.
     */
    public function generateInterviewQuestions(string $jdText): array
    {
        $prompt = <<<PROMPT
Bạn là chuyên gia tuyển dụng cấp cao. Dựa trên JD dưới đây, hãy tạo BỘ CÂU HỎI LUYỆN PHỎNG VẤN TƯƠNG TÁC gồm 2 dạng: Trắc nghiệm (multiple_choice) và Điền vào chỗ trống (fill_blank).

=== JD (Mô tả công việc) ===
{$jdText}

YÊU CẦU:
1. Phân loại thành 3 mức độ: easy, medium, hard.
2. Mỗi mức độ có ĐÚNG 4 câu hỏi: 2 câu trắc nghiệm + 2 câu điền vào chỗ trống.
3. Câu trắc nghiệm: 4 đáp án A/B/C/D, chỉ 1 đáp án đúng, có giải thích.
4. Câu điền vào chỗ trống: Một câu văn có chỗ trống ký hiệu là _____, kèm đáp án đúng và giải thích.
5. Các câu hỏi phải bám sát nội dung JD (kỹ năng, công nghệ, yêu cầu cụ thể).

Trả về KẾT QUẢ dưới dạng JSON (KHÔNG markdown, KHÔNG ```, CHỈ JSON thuần):

{
  "easy": [
    {
      "format": "multiple_choice",
      "question": "<Câu hỏi trắc nghiệm>",
      "type": "<Technical|Soft Skill>",
      "options": {"A": "<Đáp án A>", "B": "<Đáp án B>", "C": "<Đáp án C>", "D": "<Đáp án D>"},
      "correct": "<A|B|C|D>",
      "explanation": "<Giải thích tại sao đáp án đúng>"
    },
    {
      "format": "fill_blank",
      "question": "<Câu văn có chứa _____ ở chỗ cần điền>",
      "type": "<Technical|Soft Skill>",
      "answer": "<Từ/cụm từ đúng cần điền vào chỗ trống>",
      "explanation": "<Giải thích>"
    }
  ],
  "medium": [...],
  "hard": [...]
}

QUY TẮC:
- Xen kẽ multiple_choice và fill_blank trong mỗi level.
- Đáp án trắc nghiệm phải có tính mô phạm, các lựa chọn sai phải hợp lý (không quá dễ loại).
- Câu điền chỗ trống: dùng _____ (5 dấu gạch dưới) để đánh dấu chỗ trống, đáp án là 1-3 từ ngắn gọn.
- Trả lời bằng tiếng Việt.
- CHỈ TRẢ VỀ ĐÚNG JSON.
PROMPT;

        return $this->callApi($prompt);
    }

    /**
     * Call OpenRouter API.
     */
    protected function callApi(string $prompt): array
    {
        try {
            $response = Http::timeout(60)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                    'HTTP-Referer' => config('app.url', 'http://localhost'),
                    'X-Title' => 'Career Tailor CV Analyzer',
                ])
                ->post($this->baseUrl, [
                    'model' => $this->model,
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt,
                        ],
                    ],
                    'temperature' => 0.0,
                    'max_tokens' => 4096,
                ]);

            if ($response->failed()) {
                Log::error('OpenRouter API error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return ['error' => 'API request failed: ' . $response->status()];
            }

            $data = $response->json();
            $content = $data['choices'][0]['message']['content'] ?? '';

            // Clean markdown code blocks if present
            $content = preg_replace('/^```(?:json)?\s*/m', '', $content);
            $content = preg_replace('/```\s*$/m', '', $content);
            $content = trim($content);

            $parsed = json_decode($content, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('OpenRouter JSON parse error', [
                    'raw' => $content,
                    'error' => json_last_error_msg(),
                ]);
                return ['error' => 'Failed to parse AI response', 'raw' => $content];
            }

            return $parsed;
        } catch (\Exception $e) {
            Log::error('OpenRouter exception', ['message' => $e->getMessage()]);
            return ['error' => 'Service unavailable: ' . $e->getMessage()];
        }
    }

    /**
     * Extract readable text from CV content (JSON structure → plain text).
     */
    public static function cvContentToText(array $content): string
    {
        $text = '';

        // Header
        if (isset($content['header'])) {
            $h = $content['header'];
            $text .= "Họ tên: " . ($h['name'] ?? '') . "\n";
            $text .= "Vị trí: " . ($h['job_title'] ?? '') . "\n";
            $text .= "Email: " . ($h['email'] ?? '') . "\n";
            if (!empty($h['phone'])) $text .= "SĐT: {$h['phone']}\n";
            if (!empty($h['dob'])) $text .= "Ngày sinh: {$h['dob']}\n";
            if (!empty($h['address'])) $text .= "Địa chỉ: {$h['address']}\n";
            $text .= "\n";
        }

        // Sections (classic template format)
        if (isset($content['sections'])) {
            foreach ($content['sections'] as $section) {
                $text .= "## " . ($section['title'] ?? '') . "\n";
                if (isset($section['content'])) {
                    $text .= $section['content'] . "\n\n";
                }
                if (isset($section['items'])) {
                    foreach ($section['items'] as $item) {
                        $text .= "- " . ($item['title'] ?? '') . " | " . ($item['subtitle'] ?? '') . " (" . ($item['date'] ?? '') . ")\n";
                        if (!empty($item['description'])) {
                            $text .= "  " . $item['description'] . "\n";
                        }
                    }
                    $text .= "\n";
                }
            }
        }

        // Left sections (builder format)
        if (isset($content['left_sections'])) {
            foreach ($content['left_sections'] as $section) {
                $text .= "## " . ($section['title'] ?? '') . "\n";
                if (isset($section['content'])) {
                    $text .= $section['content'] . "\n\n";
                }
                if (isset($section['items'])) {
                    foreach ($section['items'] as $item) {
                        $text .= "- " . ($item['title'] ?? '') . " | " . ($item['subtitle'] ?? '') . " (" . ($item['date'] ?? '') . ")\n";
                        if (!empty($item['description'])) {
                            $text .= "  " . $item['description'] . "\n";
                        }
                    }
                    $text .= "\n";
                }
            }
        }

        // Right sections (builder format)
        if (isset($content['right_sections'])) {
            foreach ($content['right_sections'] as $section) {
                $text .= "## " . ($section['title'] ?? '') . "\n";
                if (isset($section['content'])) {
                    $text .= $section['content'] . "\n\n";
                }
                if (isset($section['items'])) {
                    foreach ($section['items'] as $item) {
                        $text .= "- " . ($item['title'] ?? '') . " | " . ($item['subtitle'] ?? '') . " (" . ($item['date'] ?? '') . ")\n";
                        if (!empty($item['description'])) {
                            $text .= "  " . $item['description'] . "\n";
                        }
                    }
                    $text .= "\n";
                }
            }
        }

        // Plain text CV
        if (isset($content['text'])) {
            $text .= $content['text'];
        }

        return trim($text);
    }

    /**
     * Convert JD to readable text.
     */
    public static function jdToText($jd): string
    {
        $text = "Vị trí: {$jd->title}\n";
        $text .= "Công ty: {$jd->company_name}\n";
        if ($jd->domain) $text .= "Lĩnh vực: {$jd->domain}\n";
        $text .= "\nMô tả công việc:\n{$jd->description}\n";
        $text .= "\nYêu cầu:\n{$jd->requirements}\n";
        if ($jd->benefits) $text .= "\nPhúc lợi:\n{$jd->benefits}\n";

        return trim($text);
    }
}
