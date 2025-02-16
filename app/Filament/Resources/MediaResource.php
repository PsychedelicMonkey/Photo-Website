<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMedia::route('/'),
        ];
    }
}
