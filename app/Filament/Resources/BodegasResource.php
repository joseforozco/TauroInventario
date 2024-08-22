<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BodegasResource\Pages;
use App\Filament\Resources\BodegasResource\RelationManagers;
use App\Models\Bodegas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BodegasResource extends Resource
{
    protected static ?string $model = Bodegas::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    protected static ?string $navigationGroup= 'Configuracion'; //Hace un grupo

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('nombre')
                            ->label('Bodegas')
                            ->placeholder('Nombre de la bodega')
                            ->required()
                            ->unique(Bodegas::class, 'nombre', fn (?Bodegas $record) => $record)
                            ->maxLength(25)
                            ])
                        ])
                ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListBodegas::route('/'),
            'create' => Pages\CreateBodegas::route('/create'),
            'edit' => Pages\EditBodegas::route('/{record}/edit'),
        ];
    }
}
