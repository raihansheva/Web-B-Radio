<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfoResource\Pages;
use App\Models\Info;
use App\Models\TagInfo;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Forms\Components\TrixEditor;

class InfoResource extends Resource
{
    protected static ?string $model = Info::class;

    protected static ?string $navigationGroup = 'Info';

    protected static ?string $navigationLabel = 'Info';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('judul_info')->label('Judul Info :')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, string $state, Forms\Set $set) {
                                $set('slug', Str::slug($state));
                                $set('meta_title', $state);
                            })
                            ->required(),
                        // Select::make('tag_info_id')
                        //     ->label('Tag Info')
                        //     ->relationship('tagInfo', 'nama_tag') // Menggunakan nama tag
                        //     ->required(),
                        Select::make('kategori_id')
                            ->label('Kategori Info :')
                            ->options(TagInfo::all()->pluck('nama_kategori', 'id')) // Mengambil data kategori
                            ->required(),
                        TagsInput::make('tag_info')
                            ->label('Tag Info')
                            ->required(),
                        FileUpload::make('image_info')
                            ->label('Info Image :')
                            ->directory('uploads/images_info')
                            ->disk('public')
                            ->preserveFilenames()
                            ->rules(['required', 'image', 'dimensions:width=256,height=165']) // Ubah format ke array
                            ->validationAttribute('Image Event')
                            ->helperText('The image must be 256x165 pixels.'),
                        DatePicker::make('date_info')
                            ->label('Info Date :')
                            ->required()
                            ->displayFormat('Y-m-d') // Format tampilan tanggal
                            ->firstDayOfWeek(1), // Menentukan hari pertama minggu (1 = Senin)
                        TextInput::make('slug')
                            ->label('Slug :')
                            ->readOnly() // Menonaktifkan input manual karena slug dibuat otomatis
                            ->required(),
                        Grid::make(2) // Membuat Grid dengan 2 kolom
                            ->schema([
                                Toggle::make('top_news')
                                    ->label('Top News')
                                    ->onColor('success') // Optional: Mengatur warna saat toggle aktif
                                    ->offColor('danger') // Optional: Mengatur warna saat toggle tidak aktif
                                    ->default(false), // Default: tidak aktif
                                Toggle::make('trending')
                                    ->label('Trending')
                                    ->onColor('success') // Optional: Mengatur warna saat toggle aktif
                                    ->offColor('danger') // Optional: Mengatur warna saat toggle tidak aktif
                                    ->default(false), // Default: tidak aktif
                            ]),
                        RichEditor::make('deskripsi_info')
                            ->label('Deskripsi Info :')
                            ->fileAttachmentsDisk('public') // Menyimpan file di disk 'public'
                            ->fileAttachmentsDirectory('info') // File akan disimpan di folder 'info' dalam 'public'
                            ->fileAttachmentsVisibility('public')
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('meta_title')
                            ->label('Title Info :')
                            ->placeholder('Masukan meta title') // Menambahkan placeholder untuk panduan input
                            ->maxLength(100)
                            ->required(),
                        Textarea::make('meta_description')
                            ->label('Description Info :')
                            ->placeholder('Masukan meta description')
                            ->required(),
                        TextInput::make('meta_keywords')
                            ->label('Keyword :')
                            ->placeholder('Masukan meta keyword')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul_info')->searchable(),
                TextColumn::make('tagInfo.nama_kategori')->label('Kategori'),
                TextColumn::make('tag_info')->label('Tag Info'),
                TextColumn::make('deskripsi_info')
                    ->formatStateUsing(function ($state) {
                        return strip_tags($state); // Menghapus tag HTML
                    }),
                ImageColumn::make('image_info'),
                TextColumn::make('date_info'),
                TextColumn::make('slug'),
                TextColumn::make('top_news')
                    ->label('Top News')
                    ->getStateUsing(function ($record) {
                        return $record->top_news ? 'Top-News' : '-';
                    }),
                TextColumn::make('trending')
                    ->label('Trending')
                    ->getStateUsing(function ($record) {
                        return $record->trending ? 'Trending' : '-';
                    }),
                TextColumn::make('meta_title'),
                TextColumn::make('meta_description'),
                TextColumn::make('meta_keywords'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListInfos::route('/'),
            'create' => Pages\CreateInfo::route('/create'),
            'edit' => Pages\EditInfo::route('/{record}/edit'),
        ];
    }
}
