<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Support\Facades\Setting;

class FrontendController extends Controller
{
    /**
     * Retrieves the view for the index page of the frontend.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Ambil statistik dari model Stat, urutkan berdasarkan sort_order
        $statsFromModel = Stat::where('is_active', true)->sorted()->get();
        
        // Siapkan default stats
        $defaultStats = [
            ['value' => '12+', 'label' => __('Tahun pengalaman')],
            ['value' => '150+', 'label' => __('Proyek berhasil diselesaikan')],
            ['value' => '98%', 'label' => __('Pelanggan yang kembali bekerja bersama')],
        ];
        
        // Jika tidak ada data dari model, gunakan default
        if($statsFromModel->count() > 0) {
            $stats = $statsFromModel->map(function ($stat) {
                return [
                    'value' => $stat->value,
                    'label' => app()->getLocale() === 'en' ? ($stat->label_en ?: $stat->label) : $stat->label,
                ];
            });
        } else {
            $stats = collect(range(1, 3))->map(function ($index) use ($defaultStats) {
                $value = setting("home_stat_{$index}_value");
                $label = setting("home_stat_{$index}_label");

                return [
                    'value' => $value ?: $defaultStats[$index - 1]['value'],
                    'label' => $label ?: $defaultStats[$index - 1]['label'],
                ];
            });
        }
        
        return view('frontend.index', compact('stats'));
    }
}
