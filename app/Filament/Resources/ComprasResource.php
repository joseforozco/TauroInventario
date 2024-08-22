<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Compras;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Inventarios;
use Filament\Resources\Resource;
use App\Filament\Resources\ComprasResource\Pages;


class ComprasResource extends Resource
{
    protected static ?string $model = Compras::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup= 'Producción';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Datos Factura de Compra')
                    ->schema([
                        Forms\Components\DateTimePicker::make('fecha')
                            ->label('Fecha factura compra')
                            ->default(now())
                            ->date()
                            ->required(),
                        Forms\Components\Select::make('proveedores_id')
                            ->label(__('Proveedores'))
                            ->relationship('proveedores', 'nombre')
                            ->searchable()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nombre')
                                    ->label(__('Nombre'))
                                    ->placeholder('Digite el nombre del proveedor')
                                    ->required(),
                                Forms\Components\Select::make('departamentos_id')
                                    ->label(__('Departamento'))
                                    ->relationship('departamento', 'nombre')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                            ])
                            ->preload(),
                        Forms\Components\TextInput::make('numerofactura')
                            ->label(__('Factura Número'))
                            ->placeholder('Digite el número de factura de compra')
                            ->required()
                            ->maxLength(255)
                    ])->columns(3),
                Forms\Components\Section::make('Valores Factura de Compra')
                    ->schema([
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
                            ->numeric()

                    ])->columns(3),
                Forms\Components\Section::make('Items Factura de Compra')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->schema([
                                Forms\Components\Select::make('inventarios_id')
                                    ->label('Producto')
                                    ->options(Inventarios::query()->pluck('nombre', 'id'))
                                    ->searchable()
                                    ->required(),
                                Forms\Components\TextInput::make('cantidad')
                                    ->numeric()
                                    ->default(1)
                                    ->required(),
                                Forms\Components\TextInput::make('valor')
                                    ->numeric()
                                    ->default(1)
                                    ->required(),
                                Forms\Components\TextInput::make('subtotal')
                                    ->numeric()
                                    ->required()
                            ])->columns(4)
                    ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('proveedores_id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('numerofactura')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('valorfactura')
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->money()
                    ]),
                Tables\Columns\TextColumn::make('ivafactura')
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->money()
                    ]),
                Tables\Columns\TextColumn::make('totalfactura')
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->money()
                    ]),
            ])
            ->filters([
                //
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
