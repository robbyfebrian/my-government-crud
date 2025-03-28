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
use Filament\Tables\Columns\IconColumn;
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
                ->prefix('62'),

                DatePicker::make('received_at')
                ->label('Tanggal Masuk')
                ->required(),

                TextInput::make('reference_number')
                ->label('Nomor Surat')
                ->required()
                ->unique(),

                DatePicker::make('letter_date')
                ->label('Tanggal Surat')
                ->required(),

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

                IconColumn::make('completed')
                ->label('Status')
                ->sortable()
                ->boolean()
                ->trueColor('info')
                ->falseColor('danger')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->searchable(),
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
                    ]);

                    $record->update(['completed' => true]);

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
