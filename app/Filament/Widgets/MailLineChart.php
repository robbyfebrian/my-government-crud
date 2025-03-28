<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class MailLineChart extends ChartWidget
{
    protected static ?string $heading = 'Akumulasi Surat per Tahun';

    protected function getData(): array
    {
        $data = \App\Models\Mail::selectRaw('MONTH(received_at) as month, COUNT(*) as count')
            ->whereYear('received_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $dataset = [];

        for ($i = 1; $i <= 12; $i++) {
            $dataset[] = $data[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Akumulasi Surat per Tahun',
                    'data' => $dataset,
                    'fill' => false,
                    'borderColor' => 'rgba(75, 192, 192, 0.8)',
                    'tension' => 0.2
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
