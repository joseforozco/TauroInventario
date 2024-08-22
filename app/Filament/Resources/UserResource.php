<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Usuarios';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label("Correo electrónico")
                    ->email()
                    ->unique(User::class, 'email', fn (?User $record) => $record)
                    ->minLength(15)
                    ->extraAttributes(['oninput' => 'this.value = this.value.tolowerCase()'])
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('email_verified_at')
                    ->label("Correo electrónico verificaciòn")
                    ->email()
                    ->unique(User::class, 'email', fn (?User $record) => $record)
                    ->minLength(15)
                    ->extraAttributes(['oninput' => 'this.value = this.value.tolowerCase()'])
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('password')
                    ->label("Contraseña")
                    ->password()
                    ->revealable(),
                Forms\Components\FileUpload::make('profile_photo_path')
                    ->label("foto")
                    ->directory('form-attachments')
                    ->visibility('private')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo electrónico')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo electrónico')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label('Correo electrónico verificación')
                    ->searchable(),
                Tables\Columns\TextColumn::make('profile_photo_path')
                    ->label('Foto'),
                //
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
