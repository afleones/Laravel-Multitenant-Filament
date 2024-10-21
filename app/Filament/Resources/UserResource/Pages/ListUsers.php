<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

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
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Correo'),
                Tables\Columns\TextColumn::make('is_super_admin') // Asegúrate de usar el nombre correcto del campo
                    ->label('Super Admin')
                    ->formatStateUsing(fn ($state) => $state ? 'Sí' : 'No'), // Muestra "Sí" o "No"
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de Creacion')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Ultima Actualizacion')
                    ->dateTime(),
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
    }
