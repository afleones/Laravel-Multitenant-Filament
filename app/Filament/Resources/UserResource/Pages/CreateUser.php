<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    // Define el esquema del formulario para que los campos sean visibles y requeridos
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('name')
                ->label('Name')
                ->required()
                ->placeholder('Enter user name'),

            TextInput::make('email')
                ->label('Email')
                ->required()
                ->email() // Validación de formato de email
                ->unique('users', 'email') // Asegura que el email sea único
                ->placeholder('Enter user email'),

            TextInput::make('password')
                ->label('Password')
                ->required()
                ->password() // Campo de contraseña
                ->minLength(8) // Validación de longitud mínima
                ->placeholder('Enter password'),

            Toggle::make('is_super_admin')
                ->label('Is Super Admin')
                ->default(false), // Valor por defecto
        ];
    }

    // Este método permite manipular los datos justo antes de crear el registro
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Verifica que el campo Name no esté vacío
        if (!isset($data['name']) || empty($data['name'])) {
            throw new \Exception('El campo Name es obligatorio.');
        }

        // Verifica que el campo Email no esté vacío
        if (!isset($data['email']) || empty($data['email'])) {
            throw new \Exception('El campo Email es obligatorio.');
        }

        // Verifica que el campo Password no esté vacío
        if (!isset($data['password']) || empty($data['password'])) {
            throw new \Exception('El campo Password es obligatorio.');
        }

        return $data; // Retorna los datos modificados
    }
}
