<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\UserTest;
use Filament\Forms\Form;
use Filament\Tables\Table;
// use Filament\Actions\Action;
use Filament\Forms\Components\Actions\Action ;
use Filament\Resources\Resource;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserTestResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserTestResource\RelationManagers;

class UserTestResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationLabel = 'Test User';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
       return $form->schema(static::formSchema());
    }

    public static function formSchema(): array
    {
        return [
            Split::make([
                // Left Side
                Section::make([
                    Forms\Components\TextInput::make('name')
                ])
                ->footerActions([
                    Action::make('previous_action')->action(logger('previous_action')),
                    Action::make('next_action')->action(logger('next_action')),
                ])
                ->key('data.test-section')
            ])
        ];
    }





    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
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
            'index' => Pages\ListUserTests::route('/'),
            'create' => Pages\CreateUserTest::route('/create'),
            'edit' => Pages\EditUserTest::route('/{record}/edit'),
        ];
    }
}
