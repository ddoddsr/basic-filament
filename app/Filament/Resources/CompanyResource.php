<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Models\Company;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Company Name')
                    ->required()
                    ->maxLength(255),

                Select::make('organization_id')
                    ->label('Organization')
                    ->relationship('organization', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('name')->label('Name')->searchable(),
                TextColumn::make('organization.name')->label('Organization')->sortable(),
                TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->actions([
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
            'index'  => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit'   => Pages\EditCompany::route('/{record}/edit'),
        ];
    }

    public static function relationManagers(): array
    {
        return [
            new class extends RelationManager {
                protected static string $relationship = 'clients';

                public static function getTitle(Model $ownerRecord, string $pageClass): string
                {
                    return 'Clients';
                }

                public function table(Table $table): Table
                {
                    return $table
                        ->columns([
                            TextColumn::make('name')->label('Name'),
                            TextColumn::make('email')->label('Email'),
                        ]);
                }
            },
        ];
    }
}
