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
    private array $columns = ['name'];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $sourceLocale = config('translatable.source_locale', 'id');

        DB::table('categories')->orderBy('id')->chunk(100, function ($categories) use ($sourceLocale) {
            foreach ($categories as $category) {
                $updates = [];
                foreach ($this->columns as $col) {
                    $val = $category->{$col};
                    if ($val === null || $this->isJson($val)) {
                        continue;
                    }
                    $updates[$col] = json_encode([$sourceLocale => $val], JSON_UNESCAPED_UNICODE);
                }
                if ($updates !== []) {
                    DB::table('categories')->where('id', $category->id)->update($updates);
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

        DB::table('categories')->orderBy('id')->chunk(100, function ($categories) use ($sourceLocale) {
            foreach ($categories as $category) {
                $updates = [];
                foreach ($this->columns as $col) {
                    $val = $category->{$col};
                    if ($val === null || !$this->isJson($val)) {
                        continue;
                    }
                    $decoded = json_decode($val, true);
                    $updates[$col] = $decoded[$sourceLocale] ?? ($decoded['en'] ?? null);
                }
                if ($updates !== []) {
                    DB::table('categories')->where('id', $category->id)->update($updates);
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
