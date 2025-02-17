<?php

namespace App\Filament\Resources\General;

use App\Filament\Resources\General\MediaResource\Pages;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $label = 'Uploads';

    protected static ?string $slug = 'uploads';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('custom_properties.caption')
                    ->maxLength(255),

                Forms\Components\Checkbox::make('custom_properties.explicit')
                    ->helperText('Contains explicit content'),

                Forms\Components\SpatieTagsInput::make('tags')
                    ->type('photo'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\ImageColumn::make('image')
                        ->getStateUsing(fn (Media $record) => $record->getUrl())
                        ->height('100%')
                        ->width('100%'),

                    Tables\Columns\Layout\Stack::make([
                        Tables\Columns\TextColumn::make('collection_name')
                            ->weight(FontWeight::Bold)
                            ->formatStateUsing(fn (string $state) => Str::headline($state)),
                    ]),
                ])->space(3),

                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\SpatieTagsColumn::make('tags'),
                ])->collapsible(),
            ])
            ->filters([
                //
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->paginated([
                18,
                36,
                72,
                'all',
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->groups([
                Tables\Grouping\Group::make('created_at')
                    ->collapsible()
                    ->date()
                    ->label('Uploaded date'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Split::make([
                    Components\ImageEntry::make('image')
                        ->getStateUsing(fn (Media $record) => $record->getUrl())
                        ->grow(false)
                        ->hiddenLabel(),

                    Components\Tabs::make('Tabs')
                        ->tabs([
                            Components\Tabs\Tab::make('Details')
                                ->schema([
                                    Components\TextEntry::make('name')
                                        ->label('Original file name'),

                                    Components\TextEntry::make('file_name'),

                                    Components\TextEntry::make('mime_type'),

                                    Components\TextEntry::make('created_at')
                                        ->date(),

                                    Components\TextEntry::make('updated_at')
                                        ->date()
                                        ->label('Last modified at'),
                                ]),

                            Components\Tabs\Tab::make('Properties')
                                ->schema([
                                    Components\TextEntry::make('custom_properties.caption')
                                        ->label('Caption'),

                                    Components\IconEntry::make('custom_properties.explicit')
                                        ->boolean()
                                        ->default(false)
                                        ->label('Contains explicit content'),

                                    Components\SpatieTagsEntry::make('tags'),
                                ]),

                            Components\Tabs\Tab::make('Conversions')
                                ->schema([
                                    Components\KeyValueEntry::make('generated_conversions'),

                                    Components\ImageEntry::make('icon')
                                        ->getStateUsing(fn (Media $record): string => $record->getUrl('icon'))
                                        ->width(80)
                                        ->height(80),
                                ]),
                        ]),
                ])->from('lg'),
            ])
            ->columns(1)
            ->inlineLabel();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMedia::route('/'),
        ];
    }
}
