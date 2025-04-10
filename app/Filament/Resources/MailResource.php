<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MailResource\Pages;
use App\Models\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MailResource extends Resource
{
    protected static ?string $model = Mail::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Nama')
                ->required(),

                Select ::make('category_id')
                ->label('Perihal')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->required(),

                Textarea::make('description')
                ->label('Keterangan')
                ->required(),

                TextInput::make('phone_number')
                ->label('No. Telepon')
                ->required()
                ->tel()
                ->prefix('+62'),

                DatePicker::make('received_at')
                ->label('Tanggal Masuk')
                ->required(),

                TextInput::make('reference_number')
                ->label('Nomor Surat'),

                DatePicker::make('letter_date')
                ->label('Tanggal Surat'),

                Select::make('completed')
                ->label('Status')
                ->options([
                    false => 'Not Completed',
                    true => 'Completed',
                ])
                ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Nama')
                ->sortable()
                ->searchable(),

                TextColumn::make('category.name')
                ->label('Perihal')
                ->sortable()
                ->searchable(),

                TextColumn::make('description')
                ->label('Keterangan')
                ->searchable(),

                TextColumn::make('phone_number')
                ->label('No. Telepon')
                ->sortable()
                ->prefix('+62')
                ->searchable(),

                TextColumn::make('received_at')
                ->label('Tanggal Masuk')
                ->sortable()
                ->date(),

                TextColumn::make('reference_number')
                ->label('Nomor Surat')
                ->sortable()
                ->searchable(),

                TextColumn::make('letter_date')
                ->label('Tanggal Surat')
                ->sortable()
                ->date(),

                TextColumn::make('completed')
                ->label('Status')
                ->formatStateUsing(fn (bool $state): string => $state ? 'Selesai' : 'Proses')
                ->color(fn (bool $state): string => $state ? 'success' : 'warning')
                ->searchable()
                ->extraAttributes(fn (bool $state): array => [
                    'style' => $state ? 'background-color: #d1e7dd; border-radius: 4px; padding-inline: 10px; padding-block: 2px;' : 'background-color: #fff3cd; border-radius: 4px; padding-inline: 10px; padding-block: 2px;',
                ]),
            ])
            ->filters([
                Filter::make('completed')->query(fn (Builder $query): Builder => $query->where('completed', true)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('downloadPdf')
                  ->label('Download PDF')
                  ->icon('heroicon-c-document-arrow-down')
                  ->color('warning')
                  ->action(function (Mail $record) {
                    $pdf = Pdf::loadView('pdf.mail', [
                        'mail' => $record,
                        'currentDate' => now()->translatedFormat('d F Y'),
                        'letterDate' => \Carbon\Carbon::parse($record->letter_date)->translatedFormat('d F Y'),
                        'receivedAt' => \Carbon\Carbon::parse($record->received_at)->translatedFormat('d F Y'),
                    ]);

                    Notification::make()
                    ->title('Surat Berhasil Terunduh')
                    ->body('Surat milik ' . strtolower($record->name) . ' telah diproses.')
                    ->success()
                    ->send();


                    return response()->streamDownload(
                        fn () => print($pdf->output()),
                        "surat-tanda-terima-" . strtolower($record->name) . ".pdf"
                    );
                }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMails::route('/'),
            'create' => Pages\CreateMail::route('/create'),
            'edit' => Pages\EditMail::route('/{record}/edit'),
        ];
    }
}
