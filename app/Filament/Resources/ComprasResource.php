<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComprasResource\Pages;
use App\Filament\Resources\ComprasResource\RelationManagers;
use App\Models\Compras;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComprasResource extends Resource
{
    protected static ?string $model = Compras::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup= 'Producción';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('fecha')
                    ->label(__('Fecha factura compra'))
                    ->required(),
                Forms\Components\select::make('proveedores_id')
                    ->label(__('Proveedores'))
                    ->relationship('proveedores','nombre')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre')
                            ->label(__('ciudades'))
                            ->placeholder('Digite el nombre de la Ciudad')
                            ->required(),
                        Forms\Components\select::make('departamentos_id')
                            ->label(__('Departamento'))
                            ->relationship('Departamento','nombre')
                            ->searchable()
                            ->preload()
                            ->required()]),
                Forms\Components\TextInput::make('numerofactura')
                    ->label(__('Factura Número'))
                    ->placeholder('Digite el número de factura de compra')
                    ->required()
                    ->Unique()
                    ->maxLength(255),
                Forms\Components\TextInput::make('valorfactura')
                    ->label(__('Valor Factura'))
                    ->placeholder('Digite el valor de factura de compra')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('ivafactura')
                    ->label(__('Valor I.V.A Factura'))
                    ->placeholder('Digite el valor de iva de compra')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('totalfactura')
                    ->label(__('Total Factura'))
                    ->placeholder('Total Factura')
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
                Tables\Columns\TextColumn::make('proveedores_id')
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
            'index' => Pages\ListCompras::route('/'),
            'create' => Pages\CreateCompras::route('/create'),
            'edit' => Pages\EditCompras::route('/{record}/edit'),
        ];
    }
}
