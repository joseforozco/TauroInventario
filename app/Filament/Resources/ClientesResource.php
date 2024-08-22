<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use App\Models\Ciudades;
use App\Models\Clientes;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use App\Filament\Resources\ClientesResource\Pages;

class ClientesResource extends Resource
{
    protected static ?string $model = Clientes::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup= 'Terceros';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('documento')
                    ->label("Número de documento")
                    ->required()
                    ->unique(Clientes::class, 'documento', fn (?Clientes $record) => $record)
                    ->minLength(5)
                    ->maxLength(15)
                    ->numeric(),
                Forms\Components\TextInput::make('nombre')
                    ->label("Nombre completo")
                    ->required()
                    ->unique(Clientes::class, 'nombre', fn (?Clientes $record) => $record)
                    ->extraAttributes(['oninput' => 'this.value = this.value.toUpperCase()'])
                    ->maxLength(255),
                Forms\Components\TextInput::make('direccion')
                    ->label("Dirección")
                    ->required()
                    ->extraAttributes(['oninput' => 'this.value = this.value.toUpperCase()'])
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label("Correo electrónico")
                    ->email()
                    ->unique(Clientes::class, 'email', fn (?Clientes $record) => $record)
                    ->minLength(15)
                    ->extraAttributes(['oninput' => 'this.value = this.value.tolowerCase()'])
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('telefono')
                    ->label("Teléfono / Celular")
                    ->tel()
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->length(10)
                    ->unique(Clientes::class, 'telefono', fn (?Clientes $record) => $record)
                    ->required(),
                Forms\Components\select::make('departamentos_id')
                    ->label("Departamento")
                    ->relationship('Departamentos','nombre')
                    ->preload(),
                Forms\Components\select::make('ciudades_id')
                    ->label("Ciudad")
                    ->options(fn (Get $get): Collection=> Ciudades::query()
                        ->where('departamentos_id', $get("departamentos_id"))
                        ->pluck('nombre','id'))
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre')
                            ->label('Ciudades')
                            ->placeholder('Digite el nombre de la Ciudad')
                            ->required()
                            ->required(),
                        Forms\Components\select::make('departamentos_id')
                            ->label("Departamento")
                            ->relationship('Departamentos','nombre')
                            ->preload()
                            ])
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
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateClientes::route('/create'),
            'edit' => Pages\EditClientes::route('/{record}/edit'),
        ];
    }
}
