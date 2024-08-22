<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SistemasResource\Pages;
use App\Models\Sistemas;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class SistemasResource extends Resource
{
    protected static ?string $model = Sistemas::class;

    protected static ?string $navigationIcon = 'heroicon-o-check-badge';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListSistemas::route('/'),
            'create' => Pages\CreateSistemas::route('/create'),
            'edit' => Pages\EditSistemas::route('/{record}/edit'),
        ];
    }
}
