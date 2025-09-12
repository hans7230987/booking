<?php

namespace App\Filament\Resources\Courts;

use App\Filament\Resources\Courts\Pages\CreateCourt;
use App\Filament\Resources\Courts\Pages\EditCourt;
use App\Filament\Resources\Courts\Pages\ListCourts;
use App\Filament\Resources\Courts\Schemas\CourtForm;
use App\Filament\Resources\Courts\Tables\CourtsTable;
use App\Models\Court;
use App\Models\Venue;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;


class CourtResource extends Resource
{
    protected static ?string $model = Court::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static UnitEnum|string|null $navigationGroup = '場館管理';

    protected static ?string $navigationLabel = '球場';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('venue_id')
                ->label('場館')
                ->relationship('venue', 'name')
                ->required(),
            TextInput::make('name')
                ->label('球場名稱')
                ->required()
                ->maxLength(255),
            TextInput::make('type')
                ->label('球場類型')
                ->placeholder('例如：羽球、籃球')
                ->maxLength(100),
            Select::make('status')
                ->label('狀態')
                ->options([
                    'available' => '可預約',
                    'closed' => '維護中',
                    'reserved' => '已預約',
                ])
                ->default('available')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('venue.name')->label('場館')->sortable()->searchable(),
                TextColumn::make('name')->label('名稱')->sortable()->searchable(),
                TextColumn::make('type')->label('類型')->searchable(),
                TextColumn::make('status')
                    ->label('狀態')
                    ->sortable()
                    ->colors([
                        'success' => 'available',
                        'warning' => 'reserved',
                        'danger' => 'closed',
                    ]),
            ])
            ->recordActions([
                Action::make('edit')
                    ->url(fn(Court $record): string => route('filament.admin.resources.courts.edit', $record)),
                Action::make('delete')
                    ->action(fn(Court $record) => $record->delete()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListCourts::route('/'),
            'create' => CreateCourt::route('/create'),
            'edit' => EditCourt::route('/{record}/edit'),
        ];
    }
}
