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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->placeholder('Enter user name'),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email() // Validación de formato de email
                    ->unique('users', 'email') // Asegura que el email sea único
                    ->placeholder('Enter user email'),

                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->required()
                    ->password() // Campo de contraseña
                    ->minLength(8) // Validación de longitud mínima
                    ->placeholder('Enter password'),

                Forms\Components\Toggle::make('is_super_admin')
                    ->label('Is Super Admin')
                    ->default(false), // Valor por defecto
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable(), // Permite ordenar por este campo
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable(), // Permite ordenar por este campo
                Tables\Columns\TextColumn::make('is_super_admin')
                    ->label('Is Super Admin')
                    ->formatStateUsing(fn($state) => $state ? 'Sí' : 'No'), // Muestra "Sí" o "No"
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(), // Muestra como fecha y hora
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime(), // Muestra como fecha y hora
            ])
            ->filters([
                // Aquí puedes agregar filtros si es necesario
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Acción para editar registros
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), // Acción para eliminar múltiples registros
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Aquí puedes agregar relaciones si es necesario
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
