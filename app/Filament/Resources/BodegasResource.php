<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BodegasResource\Pages;
use App\Models\Bodegas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


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
                            ->maxLength(25),
                        Forms\Components\TextInput::make('direccion')
                            ->label("Dirección")
                            ->required()
                            ->extraAttributes(['oninput' => 'this.value = this.value.toUpperCase()'])
                            ->maxLength(255),
                        Forms\Components\select::make('departamentos_id')
                            ->label("Departamento")
                            ->relationship('Departamentos','nombre')
                            ->preload(),
                        Forms\Components\select::make('ciudades_id')
                            ->label("Ciudad")
                            ->relationship('Ciudades','nombre')
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nombre')
                                    ->label('Ciudades')
                                    ->placeholder('Digite el nombre de la Ciudad')
                                    ->required(),
                                Forms\Components\select::make('departamentos_id')
                                    ->label("Departamento")
                                    ->relationship('Departamentos','nombre')
                                    ->preload(),
                                    ]),
                        ])->columns(2)
                    ])
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('direccion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ciudades_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('departamentos_id')
                    ->searchable()

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
            'index' => Pages\ListBodegas::route('/'),
            'create' => Pages\CreateBodegas::route('/create'),
            'edit' => Pages\EditBodegas::route('/{record}/edit'),
        ];
    }
}
