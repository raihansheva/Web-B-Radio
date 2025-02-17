<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingPlayerStreamResource\Pages;
use App\Filament\Resources\SettingPlayerStreamResource\RelationManagers;
use App\Models\SettingPlayerStream;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingPlayerStreamResource extends Resource
{
    protected static ?string $model = SettingPlayerStream::class;

    protected static ?string $navigationLabel = 'SettingPlayerStream';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    Select::make('active_player')
                        ->label('Pilih Player untuk di posisi depan')
                        ->options([
                            'video' => 'Video Player',
                            'audio' => 'Audio Player',
                        ])
                        ->default(SettingPlayerStream::first()?->active_player ?? 'video') // Ambil dari DB
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(function ($state) {
                            SettingPlayerStream::first()->update(['active_player' => $state]);
                        }),
                ])
                ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('active_player')->label('Player Di Posisi Depan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSettingPlayerStreams::route('/'),
            'create' => Pages\CreateSettingPlayerStream::route('/create'),
            'edit' => Pages\EditSettingPlayerStream::route('/{record}/edit'),
        ];
    }
}
