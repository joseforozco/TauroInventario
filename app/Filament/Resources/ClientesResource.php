<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientesResource\Pages;
use App\Filament\Resources\ClientesResource\RelationManagers;
use App\Models\Clientes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                    ->minLength(8)
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
                    ->maxLength(255),
                Forms\Components\TextInput::make('telefono')
                    ->label("Teléfono / Celular")
                    ->tel()
                    ->minLength(10)
                    ->unique(Clientes::class, 'telefono', fn (?Clientes $record) => $record)
                    ->required()
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('departamentos_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('ciudades_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateClientes::route('/create'),
            'edit' => Pages\EditClientes::route('/{record}/edit'),
        ];
    }
}
