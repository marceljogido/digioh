<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleTranslateService
{
    /**
     * Translate text using MyMemory API (free, no key required).
     * Limit: 1000 words/day for anonymous, 10000/day with email.
     *
     * @param string $text The text to translate
     * @param string $sourceLang Source language code (e.g., 'id')
     * @param string $targetLang Target language code (e.g., 'en')
     * @return string Translated text or original text on failure
     */
    public function translate(string $text, string $sourceLang, string $targetLang): string
    {
        if (empty(trim($text))) {
            return '';
        }

        try {
            // MyMemory uses format: source|target (e.g., "id|en")
            $langPair = $sourceLang . '|' . $targetLang;
            
            $response = Http::timeout(30)->get('https://api.mymemory.translated.net/get', [
                'q' => $text,
                'langpair' => $langPair,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Check for valid response
                if (isset($data['responseStatus']) && $data['responseStatus'] == 200) {
                    return $data['responseData']['translatedText'] ?? $text;
                }
                
                // Log error if translation failed
                Log::warning('MyMemory translation warning', [
                    'status' => $data['responseStatus'] ?? 'unknown',
                    'message' => $data['responseDetails'] ?? 'No details',
                ]);
            }

            return $text; // Return original on error

        } catch (\Exception $e) {
            Log::error('MyMemory translation exception', [
                'message' => $e->getMessage(),
            ]);

            return $text; // Return original on error
        }
    }

    /**
     * Translate multiple texts at once.
     *
     * @param array $texts Array of texts to translate
     * @param string $sourceLang Source language code
     * @param string $targetLang Target language code
     * @return array Array of translated texts
     */
    public function translateBatch(array $texts, string $sourceLang, string $targetLang): array
    {
        $results = [];
        
        foreach ($texts as $text) {
            if (empty(trim($text))) {
                $results[] = '';
            } else {
                $results[] = $this->translate($text, $sourceLang, $targetLang);
                // Small delay to avoid rate limiting
                usleep(100000); // 100ms
            }
        }
        
        return $results;
    }

    /**
     * Check if the service is configured and working.
     */
    public function isConfigured(): bool
    {
        return true; // MyMemory doesn't require configuration
    }
}

