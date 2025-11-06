<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Stat;

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
        $stats = $statsFromModel->count() > 0
            ? $statsFromModel->map(function ($stat) {
                return [
                    'value' => $stat->value,
                    'label' => app()->getLocale() === 'en' ? ($stat->label_en ?: $stat->label) : $stat->label,
                ];
            })
            : collect($defaultStats);
        
        return view('frontend.index', compact('stats'));
    }
}
