<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Columns to convert to JSON for Spatie Translatable.
     */
    private array $columns = ['name', 'intro', 'content', 'meta_title', 'meta_description'];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $sourceLocale = config('translatable.source_locale', 'id');

        // For each row, wrap existing string values in {"id": "value"} JSON
        DB::table('posts')->orderBy('id')->chunk(100, function ($posts) use ($sourceLocale) {
            foreach ($posts as $post) {
                $updates = [];
                foreach ($this->columns as $col) {
                    $val = $post->{$col};
                    // Skip if already JSON or null
                    if ($val === null || $this->isJson($val)) {
                        continue;
                    }
                    $updates[$col] = json_encode([$sourceLocale => $val], JSON_UNESCAPED_UNICODE);
                }
                if ($updates !== []) {
                    DB::table('posts')->where('id', $post->id)->update($updates);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $sourceLocale = config('translatable.source_locale', 'id');

        // Convert JSON back to plain string (extract source locale value)
        DB::table('posts')->orderBy('id')->chunk(100, function ($posts) use ($sourceLocale) {
            foreach ($posts as $post) {
                $updates = [];
                foreach ($this->columns as $col) {
                    $val = $post->{$col};
                    if ($val === null || !$this->isJson($val)) {
                        continue;
                    }
                    $decoded = json_decode($val, true);
                    $updates[$col] = $decoded[$sourceLocale] ?? ($decoded['en'] ?? null);
                }
                if ($updates !== []) {
                    DB::table('posts')->where('id', $post->id)->update($updates);
                }
            }
        });
    }

    private function isJson($string): bool
    {
        if (!is_string($string)) {
            return false;
        }
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
};
