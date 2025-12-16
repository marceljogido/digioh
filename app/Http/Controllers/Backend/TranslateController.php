<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\GoogleTranslateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
    public function __construct(
        protected GoogleTranslateService $translator
    ) {}

    /**
     * Translate text from one language to another.
     */
    public function translate(Request $request): JsonResponse
    {
        $request->validate([
            'text' => 'required|string',
            'source' => 'required|string|size:2',
            'target' => 'required|string|size:2',
        ]);

        if (!$this->translator->isConfigured()) {
            return response()->json([
                'success' => false,
                'message' => 'Translation service not configured',
            ], 503);
        }

        $translated = $this->translator->translate(
            $request->input('text'),
            $request->input('source'),
            $request->input('target')
        );

        if ($translated === null) {
            return response()->json([
                'success' => false,
                'message' => 'Translation failed',
            ], 500);
        }

        return response()->json([
            'success' => true,
            'translated' => $translated,
        ]);
    }

    /**
     * Translate multiple texts at once.
     */
    public function translateBatch(Request $request): JsonResponse
    {
        $request->validate([
            'texts' => 'required|array',
            'texts.*' => 'nullable|string',
            'source' => 'required|string|size:2',
            'target' => 'required|string|size:2',
        ]);

        if (!$this->translator->isConfigured()) {
            return response()->json([
                'success' => false,
                'message' => 'Translation service not configured',
            ], 503);
        }

        $translations = $this->translator->translateBatch(
            $request->input('texts'),
            $request->input('source'),
            $request->input('target')
        );

        return response()->json([
            'success' => true,
            'translations' => $translations,
        ]);
    }
}
