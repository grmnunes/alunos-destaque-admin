<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AwardResource\Pages;
use App\Filament\Resources\AwardResource\RelationManagers;
use App\Models\Award;
use App\Models\School;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AwardResource extends Resource
{
    protected static ?string $model = Award::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'Premiações';

    protected static ?string $modelLabel = 'premiação';

    protected static ?string $slug = 'premiações';

    protected static ?string $title = 'premiações';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Forms\Components\DatePicker::make('date')
                        ->label('Data')
                        ->required(),
                    Forms\Components\TextInput::make('title')
                        ->label('Título')
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->label('Descrição')
                        ->required(),
                    Forms\Components\Repeater::make('items')
                        ->label('Escolas e Alunos Premiados')
                        ->schema([
                            Select::make('school_id')
                                ->label('Escola')
                                ->options(fn () => School::pluck('name', 'id'))
                                ->searchable()
                                ->reactive()
                                ->preload()
                                ->afterStateUpdated(function($set, $state) {
                                    $set('students', null); 
                                }),
                            Select::make('students')
                                ->label('Alunos')
                                ->searchable()
                                ->reactive()
                                ->preload()
                                ->multiple()
                                ->options(function($get) {
                                    $schoolId = $get('school_id');
                                    
                                    if ($schoolId) {
                                        $school = School::find($schoolId);
            
                                        return $school->students->pluck('name', 'id')->toArray() ?? [];
                                    }
            
                                    return [];
                                })
                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Título')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Data')
                    ->date('d/m/Y')
                    ->sortable(),
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
            'index' => Pages\ListAwards::route('/'),
            'create' => Pages\CreateAward::route('/create'),
            'edit' => Pages\EditAward::route('/{record}/edit'),
        ];
    }
}
