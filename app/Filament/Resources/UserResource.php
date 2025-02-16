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

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\Select::make('user_type')
                    ->label('User Type')
                    ->options([
                        'ADMIN'  => 'Admin',
                        'STAFF'  => 'Staff',
                        'CLIENT' => 'Client',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->password('')
                    ->required(fn($record) => $record === null)
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn($state) => bcrypt($state))
                    ->visible(fn($record) => $record === null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_type')
                    ->label('User Type')
                    ->sortable()
                    ->formatStateUsing(fn($state) => ucfirst($state->value)),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_type')
                    ->label('Filter by User Type')
                    ->options([
                        'ADMIN'  => 'Admin',
                        'STAFF'  => 'Staff',
                        'CLIENT' => 'Client',
                    ]),
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
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}