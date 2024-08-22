<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Inventarios;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use App\Filament\Resources\InventariosResource\Pages;


class InventariosResource extends Resource
{
    protected static ?string $model = Inventarios::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $navigationGroup= 'Terceros';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Datos Principales')
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->label(__('Descripción'))
                    ->placeholder('Descripción del articulo o producto')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('codigo')
                    ->label(__('Código Interno'))
                    ->placeholder('Código del articulo o producto')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('barra')
                    ->label(__('Código de Barras'))
                    ->placeholder('Leer codigo con lector de codigo de barras')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('medidas_id')
                    ->label(__('Unidad de Medida'))
                    ->relationship('medidas', 'nombre')
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre')
                            ->label(__('Unidad de Medida'))
                            ->placeholder('Digite el nombre medida')
                            ->unique()
                            ->required()
                    ]),
            ])->columns(4),
            Forms\Components\Section::make('Datos relevantes')
            ->schema([
                Forms\Components\TextInput::make('existencias')
                    ->label(__('Cantidad'))
                    ->placeholder('Existencia')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('valor')
                    ->label(__('Valor Unitario'))
                    ->prefix('$')
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->numeric()
                    ->placeholder('Valor Unitario')
                    ->required(),
                Forms\Components\TextInput::make('total')
                    ->label(__('Valor total'))
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->prefix('$')
                    ->numeric(),
                Forms\Components\TextInput::make('minimo')
                    ->label(__('Cantidad Minima'))
                    ->placeholder('Cantidad minima requerida')
                    ->required()
                    ->default(5)
                    ->numeric(),
            ])->columns(4),

            Forms\Components\Section::make('Ubicación y caracteristicas')
            ->schema([
                Forms\Components\Select::make('categorias_id')
                    ->label(__('Categorias'))
                    ->relationship('categorias', 'nombre')
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre')
                            ->label(__('Categorias'))
                            ->placeholder('Digite el nombre de categoria')
                            ->unique()
                            ->required()
                    ]),
                Forms\Components\Select::make('marcas_id')
                    ->label(__('Marcas'))
                    ->relationship('marcas', 'nombre')
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre')
                            ->label(__('Marcas'))
                            ->placeholder('Digite el nombre de la marca')
                            ->unique()
                            ->required()
                    ]),
                Forms\Components\Select::make('bodegas_id')
                    ->label(__('Bodegas / Ubicación'))
                    ->relationship('bodegas', 'nombre')
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre')
                            ->label(__('Bodegas'))
                            ->placeholder('Digite el nombre de la bodega')
                            ->unique()
                            ->required()
                    ]),
                Forms\Components\Select::make('proveedores_id')
                    ->label(__('Proveedor'))
                    ->relationship('proveedores', 'nombre')
                    ->preload()
                    ->required()
            ])->columns(4),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('existencias')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('valor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('minimo')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('categorias_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('marcas_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bodegas_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('proveedores_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('users_id')
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
            'index' => Pages\ListInventarios::route('/'),
            'create' => Pages\CreateInventarios::route('/create'),
            'edit' => Pages\EditInventarios::route('/{record}/edit'),
        ];
    }
}
