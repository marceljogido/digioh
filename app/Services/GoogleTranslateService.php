<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleTranslateService
{
    protected ?string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google.translate_api_key');
    }

    /**
     * Translate text from source language to target language.
     *
     * @param string $text The text to translate
     * @param string $targetLang Target language code (e.g., 'en', 'id')
     * @param string|null $sourceLang Source language code (auto-detect if null)
     * @return string|null Translated text or null on failure
     */
    public function translate(string $text, string $targetLang, ?string $sourceLang = null): ?string
    {
        if (empty($this->apiKey)) {
            Log::warning('Google Translate API key not configured');
            return null;
        }

        if (empty(trim($text))) {
            return '';
        }

        try {
            $params = [
                'key' => $this->apiKey,
                'q' => $text,
                'target' => $targetLang,
                'format' => 'html', // Preserve HTML tags
            ];

            if ($sourceLang) {
                $params['source'] = $sourceLang;
            }

            $response = Http::get('https://translation.googleapis.com/language/translate/v2', $params);

            if ($response->successful()) {
                $data = $response->json();
                return $data['data']['translations'][0]['translatedText'] ?? null;
            }

            Log::error('Google Translate API error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return null;
        } catch (\Exception $e) {
            Log::error('Google Translate exception', [
                'message' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Translate multiple texts at once.
     *
     * @param array $texts Array of texts to translate
     * @param string $targetLang Target language code
     * @param string|null $sourceLang Source language code
     * @return array Array of translated texts
     */
    public function translateBatch(array $texts, string $targetLang, ?string $sourceLang = null): array
    {
        if (empty($this->apiKey)) {
            Log::warning('Google Translate API key not configured');
            return array_fill(0, count($texts), null);
        }

        // Filter out empty texts but keep track of indices
        $nonEmptyTexts = [];
        $indices = [];
        foreach ($texts as $index => $text) {
            if (!empty(trim($text))) {
                $nonEmptyTexts[] = $text;
                $indices[] = $index;
            }
        }

        if (empty($nonEmptyTexts)) {
            return array_fill(0, count($texts), '');
        }

        try {
            $params = [
                'key' => $this->apiKey,
                'q' => $nonEmptyTexts,
                'target' => $targetLang,
                'format' => 'html',
            ];

            if ($sourceLang) {
                $params['source'] = $sourceLang;
            }

            $response = Http::asForm()->post('https://translation.googleapis.com/language/translate/v2', $params);

            if ($response->successful()) {
                $data = $response->json();
                $translations = $data['data']['translations'] ?? [];

                // Map translations back to original indices
                $result = array_fill(0, count($texts), '');
                foreach ($indices as $i => $originalIndex) {
                    $result[$originalIndex] = $translations[$i]['translatedText'] ?? '';
                }

                return $result;
            }

            Log::error('Google Translate API batch error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return array_fill(0, count($texts), null);
        } catch (\Exception $e) {
            Log::error('Google Translate batch exception', [
                'message' => $e->getMessage(),
            ]);

            return array_fill(0, count($texts), null);
        }
    }

    /**
     * Check if the service is configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }
}
