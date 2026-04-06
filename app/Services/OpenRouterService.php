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
  ]
}

QUY TẮC:
- Chỉ dựa trên THÔNG TIN CÓ TRONG CV, KHÔNG bịa thêm.
- match_score phải phản ánh chính xác mức độ phù hợp thực tế.
- Nếu CV không đề cập kỹ năng mà JD yêu cầu → đưa vào missing_skills.
- strengths và weaknesses tối thiểu 2 mục, tối đa 5 mục.
- skill_breakdown chia theo nhóm kỹ năng từ JD.
- experience_analysis: trích xuất TẤT CẢ kinh nghiệm từ CV, đánh giá relevance so với JD.
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
