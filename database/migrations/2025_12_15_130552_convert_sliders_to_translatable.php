<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Converts existing slider title, subtitle, button_text from plain strings to JSON format for translatable support.
     */
    public function up(): void
    {
        $sliders = DB::table('sliders')->get();
        $sourceLocale = config('translatable.source_locale', 'id');
        
        foreach ($sliders as $slider) {
            $updates = [];
            
            // Convert title
            if ($slider->title && !$this->isJson($slider->title)) {
                $updates['title'] = json_encode([$sourceLocale => $slider->title]);
            }
            
            // Convert subtitle
            if ($slider->subtitle && !$this->isJson($slider->subtitle)) {
                $updates['subtitle'] = json_encode([$sourceLocale => $slider->subtitle]);
            }
            
            // Convert button_text
            if ($slider->button_text && !$this->isJson($slider->button_text)) {
                $updates['button_text'] = json_encode([$sourceLocale => $slider->button_text]);
            }
            
            if (!empty($updates)) {
                DB::table('sliders')->where('id', $slider->id)->update($updates);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $sliders = DB::table('sliders')->get();
        $sourceLocale = config('translatable.source_locale', 'id');
        
        foreach ($sliders as $slider) {
            $updates = [];
            
            // Revert title
            if ($slider->title && $this->isJson($slider->title)) {
                $decoded = json_decode($slider->title, true);
                $updates['title'] = $decoded[$sourceLocale] ?? array_values($decoded)[0] ?? '';
            }
            
            // Revert subtitle
            if ($slider->subtitle && $this->isJson($slider->subtitle)) {
                $decoded = json_decode($slider->subtitle, true);
                $updates['subtitle'] = $decoded[$sourceLocale] ?? array_values($decoded)[0] ?? '';
            }
            
            // Revert button_text
            if ($slider->button_text && $this->isJson($slider->button_text)) {
                $decoded = json_decode($slider->button_text, true);
                $updates['button_text'] = $decoded[$sourceLocale] ?? array_values($decoded)[0] ?? '';
            }
            
            if (!empty($updates)) {
                DB::table('sliders')->where('id', $slider->id)->update($updates);
            }
        }
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
