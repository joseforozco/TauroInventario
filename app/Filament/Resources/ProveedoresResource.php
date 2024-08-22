<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProveedoresResource\Pages;
use App\Models\Proveedores;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProveedoresResource extends Resource
{
    protected static ?string $model = Proveedores::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup= 'Terceros';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('documento')
                    ->label("Número de documento")
                    ->required()
                    ->unique(Proveedores::class, 'documento', fn (?Proveedores $record) => $record)
                    ->minLength(5)
                    ->maxLength(15)
                    ->numeric(),
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->unique(Proveedores::class, 'nombre', fn (?Proveedores $record) => $record)
                    ->extraAttributes(['oninput' => 'this.value = this.value.toUpperCase()'])
                    ->maxLength(255),
                Forms\Components\TextInput::make('direccion')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(Proveedores::class, 'email', fn (?Proveedores $record) => $record)
                    ->extraAttributes(['oninput' => 'this.value = this.value.toLowerCase()'])
                    ->maxLength(255),
                Forms\Components\TextInput::make('telefono')
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->length(10)
                    ->required()
                    ->unique(Proveedores::class, 'telefono', fn (?Proveedores $record) => $record),
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
                            ->preload()])
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('documento')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('direccion')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefono')
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
            'index' => Pages\ListProveedores::route('/'),
            'create' => Pages\CreateProveedores::route('/create'),
            'edit' => Pages\EditProveedores::route('/{record}/edit'),
        ];
    }
}
