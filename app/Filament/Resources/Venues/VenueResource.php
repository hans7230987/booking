<?php

namespace App\Filament\Resources\Venues;

use App\Filament\Resources\Venues\Pages;
use App\Models\Venue;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use UnitEnum;
use BackedEnum;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class VenueResource extends Resource
{
    protected static ?string $model = Venue::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-building-office';

    protected static UnitEnum|string|null $navigationGroup = '場館管理';

    protected static ?string $navigationLabel = '場館';

    /**
     * 控制側邊選單是否顯示
     */
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->isAdmin() ?? false; // 只有 admin 可以看到
    }

    /**
     * 控制資源列表是否可訪問
     */
    public static function canViewAny(): bool
    {
        return auth()->user()?->isAdmin() ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->label('場館名稱')
                ->required()
                ->maxLength(255),
            TextInput::make('address')
                ->label('地址')
                ->required()
                ->maxLength(255),
            TextInput::make('phone')
                ->label('電話')
                ->required(),
            Textarea::make('description')
                ->label('描述')
                ->maxLength(1000),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('name')->label('名稱')->sortable()->searchable(),
                TextColumn::make('address')->label('地址'),
                TextColumn::make('phone')->label('電話'),
                TextColumn::make('description')->label('描述')->limit(50),
            ])
            ->recordActions([
                Action::make('edit')
                    ->url(fn(Venue $record): string => route('filament.admin.resources.venues.edit', $record)),
                Action::make('delete')
                    ->action(fn(Venue $record) => $record->delete()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVenues::route('/'),
            'create' => Pages\CreateVenue::route('/create'),
            'edit' => Pages\EditVenue::route('/{record}/edit'),
        ];
    }
}
