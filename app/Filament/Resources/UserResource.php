<?php

namespace App\Filament\Resources;

use App\Enums\UserTypeEnum;
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
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\Select::make('user_type')
                    ->label('User Type')
                    ->options([
                        UserTypeEnum::ADMIN->value  => 'Admin',
                        UserTypeEnum::STAFF->value  => 'Staff',
                        UserTypeEnum::CLIENT->value => 'Client',
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
                    ->badge()
                    ->color(fn($state) => match ($state->value) {
                        UserTypeEnum::ADMIN->value => 'danger',
                        UserTypeEnum::STAFF->value => 'warning',
                        UserTypeEnum::CLIENT->value => 'success',
                    })
                    ->formatStateUsing(fn($state) => ucfirst($state->value)),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable(),
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
                Tables\Filters\SelectFilter::make('user_type')
                    ->label('Filter by User Type')
                    ->options([
                        UserTypeEnum::ADMIN->value  => 'Admin',
                        UserTypeEnum::STAFF->value  => 'Staff',
                        UserTypeEnum::CLIENT->value => 'Client',
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
