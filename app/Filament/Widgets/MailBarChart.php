<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class MailBarChart extends ChartWidget
{
    protected static ?string $heading = 'Klasifikasi Surat per Kategori';

    protected function getData(): array
    {
        $data = \App\Models\Mail::selectRaw('categories.name as category, COUNT(*) as count')
            ->join('categories', 'mails.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->pluck('count', 'category')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Surat',
                    'data' => array_values($data),
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(75, 192, 192, 0.8)',
                      ],
                      'borderColor' => [
                        'rgba(75, 192, 192, 0.8)',
                      ],
                      'borderWidth' => 1
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
