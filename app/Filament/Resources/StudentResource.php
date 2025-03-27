<?php

namespace App\Filament\Resources;

use App\Enums\SchoolSessions;
use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\School;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Alunos';

    protected static ?string $modelLabel = 'aluno';

    protected static ?string $slug = 'alunos';

    protected static ?string $title = 'alunos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make([
                    Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required()
                    ->maxLength(150),
                Forms\Components\TextInput::make('registration_number')
                    ->label('Matrícula')
                    ->required()
                    ->maxLength(12),
                Forms\Components\Select::make('school_id')
                    ->label('Escola')
                    ->relationship('school', 'name')
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->afterStateUpdated(function($set, $state) {
                        $set('session', null);
                        $set('grade', null); 
                    })
                    ->required(),
                Forms\Components\Select::make('shift_id')
                    ->label('Turno')
                    ->options(function($get) {
                        $schoolId = $get('school_id');
                        
                        if ($schoolId) {
                            $school = School::find($schoolId);

                            return $school->shifts->pluck('name', 'id')->toArray() ?? [];
                        }

                        return [];
                    })
                    ->required(),
                Forms\Components\Select::make('grade_id')
                    ->label('Série')
                    ->required()
                    ->options(function($get) {
                        $schoolId = $get('school_id');
                        
                        if ($schoolId) {
                            $school = School::find($schoolId);
                            
                            return $school->grades->pluck('name', 'id')->toArray() ?? [];
                        }

                        return [];
                    }),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('registration_number')
                    ->label('Matrícula')
                    ->searchable(),
                Tables\Columns\TextColumn::make('school.name')
                    ->label('Escola')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('shift.name')
                    ->label('Turno')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('grade.name')
                    ->label('Série')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
