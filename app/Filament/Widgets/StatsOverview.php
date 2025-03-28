<?php

namespace App\Filament\Widgets;

use App\Models\Mail;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

FilamentColor::register([
    'info' => Color::rgb('rgb(75, 192, 192)'),
]);

class StatsOverview extends BaseWidget
{

    protected function getStats(): array
    {
        $belumDiproses = Mail::where('completed', false)->count();
        $sudahDiproses = Mail::where('completed', true)->count();
        $totalSurat = Mail::count();

        return [
            Stat::make('Total Surat', $totalSurat)
            ->description('Surat Masuk ke BPKPAD')
            ->descriptionIcon('heroicon-o-paper-airplane')
            ->descriptionColor('info'),
            Stat::make('Belum Diproses', $belumDiproses)
            ->descriptionIcon('heroicon-o-x-circle')
            ->description('Surat yang belum terproses')
            ->descriptionColor('danger'),
            Stat::make('Selesai Diproses', $sudahDiproses)
            ->description('Surat yang sudah diproses')
            ->descriptionIcon('heroicon-o-check-circle')
            ->descriptionColor('info'),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }
}
