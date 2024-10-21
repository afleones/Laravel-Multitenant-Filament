<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;

class CreateTenant extends CreateRecord
{
    protected static string $resource = TenantResource::class;

    // Define el esquema del formulario para que los campos sean visibles y requeridos
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('subdomain')
                ->label('Subdomain')
                ->required()
                ->placeholder('Enter subdomain'),

            TextInput::make('database_name')
                ->label('Database Name')
                ->required()
                ->placeholder('Enter database name'),
        ];
    }

    // Este método permite manipular los datos justo antes de crear el registro
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Verifica que el campo Subdomain no esté vacío
        if (!isset($data['subdomain']) || empty($data['subdomain'])) {
            throw new \Exception('El campo Subdomain es obligatorio.');
        }

        // Verifica que el campo Database Name no esté vacío
        if (!isset($data['database_name']) || empty($data['database_name'])) {
            throw new \Exception('El campo Database Name es obligatorio.');
        }

        // Concatenar 'db_' al nombre de la base de datos
        $data['database_name'] = 'db_' . $data['database_name'];

        return $data; // Retorna los datos modificados
    }
}
