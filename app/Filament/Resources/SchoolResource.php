<?php

namespace App\Filament\Resources;

use App\Enums\SchoolGrade;
use App\Enums\SchoolSessions;
use App\Filament\Resources\SchoolResource\Pages;
use App\Filament\Resources\SchoolResource\RelationManagers;
use App\Models\School;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Escolas';

    protected static ?string $modelLabel = 'escola';

    protected static ?string $slug = 'escolas';

    protected static ?string $title = 'escolas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->label('Nome')
                        ->maxLength(150),
                    Forms\Components\TextInput::make('address')
                        ->label('Endereço')
                        ->required()
                        ->maxLength(150),
                    Forms\Components\TextInput::make('map_location')
                        ->label('Localização')
                        ->hint('Link de localização do Google Maps')
                        ->url()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('contact')
                        ->label('Contato')
                        ->maxLength(100),
                    Forms\Components\Select::make('sessions')
                        ->label('Turnos')
                        ->multiple()
                        ->options(SchoolSessions::options()),
                    Forms\Components\Select::make('grades')
                        ->label('Séries')
                        ->multiple()
                        ->options(SchoolGrade::options()),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Endereço')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact')
                    ->label('Contato')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Ver no mapa')
                    ->label('Ver no mapa')
                    ->icon('heroicon-o-map')
                    ->color('success')
                    ->button()
                    ->url(fn (School $record): string => $record->map_location)
                    ->openUrlInNewTab()
                    ->hidden(fn (School $record) => !$record->map_location),
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
            'index' => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchool::route('/create'),
            'edit' => Pages\EditSchool::route('/{record}/edit'),
        ];
    }
}
