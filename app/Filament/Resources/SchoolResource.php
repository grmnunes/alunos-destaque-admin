<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolResource\Pages;
use App\Models\School;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Http;

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
                    Forms\Components\Select::make('selectSchool')
                        ->reactive()
                        ->getSearchResultsUsing(fn (string $query) => self::searchSchools($query))
                        ->afterStateUpdated(fn ($state, callable $set) => self::fillSchoolData($state, $set))
                        ->required()
                        ->searchable()
                        ->label('Nome')
                        ->visible(fn ($livewire) => $livewire instanceof Pages\CreateSchool),
                    Forms\Components\TextInput::make('name')
                        ->label('Nome')
                        ->required()
                        ->maxLength(150)
                        ->visible(fn ($livewire) => $livewire instanceof Pages\EditSchool),
                    Hidden::make('name')->visible(fn ($livewire) => $livewire instanceof Pages\CreateSchool),
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
                    Forms\Components\Select::make('shifts')
                        ->relationship('shifts', 'name')
                        ->searchable()
                        ->preload()
                        ->label('Turnos')
                        ->multiple(),
                    Forms\Components\Select::make('grades')
                        ->relationship('grades', 'name')
                        ->searchable()
                        ->preload()
                        ->label('Séries')
                        ->multiple(),
                ]),
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
                    ->hidden(fn (School $record) => ! $record->map_location),
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

    public static function searchSchools(string $query): array
    {
        $response = Http::get(config('sme.escolas.api.url'), ['search' => $query]);

        if ($response->failed()) {
            return [];
        }

        $data = $response->json();

        session(['results' => $data['results']]);

        return collect($data['results'])->mapWithKeys(fn ($school) => [
            $school['codesc'] => $school['tipoesc'].' '.$school['nomesc'],
        ])->toArray();

    }

    public static function fillSchoolData($schoolId, callable $set)
    {
        if (! $schoolId) {
            return;
        }

        $schools = collect(session('results'));

        if ($schools->isNotEmpty()) {
            $school = $schools->where('codesc', $schoolId)->first();
            $set('name', $school['tipoesc'].' '.$school['nomesc'] ?? '');
            $set('address', "{$school['endereco']}, {$school['bairro']}, {$school['numero']}" ?? '');
            $set('contact', $school['email'] ?? '');
            $set('map_location', "https://www.google.com/maps?q={$school['latitude']},{$school['longitude']}" ?? '');
        }

        session()->forget('results');
    }
}
