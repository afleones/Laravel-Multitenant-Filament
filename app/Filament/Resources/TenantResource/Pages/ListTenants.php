<?php

namespace App\Filament\Resources\TenantResource\Pages;

use App\Filament\Resources\TenantResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;

class ListTenants extends ListRecords
{
    protected static string $resource = TenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTable(): Tables\Table
    {
        return parent::getTable()
            ->columns([
                Tables\Columns\TextColumn::make('subdomain')
                    ->label('Subdomain')
                    ->sortable(), // Permite ordenar por este campo
                Tables\Columns\TextColumn::make('database_name')
                    ->label('Database Name')
                    ->sortable(), // Permite ordenar por este campo
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(), // Muestra como fecha y hora
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime(), // Muestra como fecha y hora
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
}
