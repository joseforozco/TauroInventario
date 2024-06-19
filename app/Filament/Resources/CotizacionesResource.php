<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CotizacionesResource\Pages;
use App\Filament\Resources\CotizacionesResource\RelationManagers;
use App\Models\Cotizaciones;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CotizacionesResource extends Resource
{
    protected static ?string $model = Cotizaciones::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup= 'Producción';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('fecha')
                    ->required(),
                Forms\Components\TextInput::make('clientes_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('numerofactura')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('valorfactura')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('ivafactura')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('totalfactura')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fecha')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('clientes_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('numerofactura')
                    ->searchable(),
                Tables\Columns\TextColumn::make('valorfactura')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ivafactura')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('totalfactura')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListCotizaciones::route('/'),
            'create' => Pages\CreateCotizaciones::route('/create'),
            'edit' => Pages\EditCotizaciones::route('/{record}/edit'),
        ];
    }
}
