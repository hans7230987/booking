<?php

namespace App\Filament\Resources\Bookings;

use App\Filament\Resources\Bookings\Pages\CreateBooking;
use App\Filament\Resources\Bookings\Pages\EditBooking;
use App\Filament\Resources\Bookings\Pages\ListBookings;
use App\Filament\Resources\Bookings\Schemas\BookingForm;
use App\Filament\Resources\Bookings\Tables\BookingsTable;
use App\Models\Booking;
use App\Models\Court;
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
use Filament\Forms\Components\DateTimePicker;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static UnitEnum|string|null $navigationGroup = '預約管理';
   
    protected static ?string $navigationLabel = '預約';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('user_id')
                ->label('使用者')
                ->relationship('user', 'name')
                ->required(),
            Select::make('court_id')
                ->label('球場')
                ->relationship('court', 'name')
                ->required(),
            DateTimePicker::make('start_time')
                ->label('開始時間')
                ->required(),
            DateTimePicker::make('end_time')
                ->label('結束時間')
                ->required(),
            Select::make('status')
                ->label('狀態')
                ->options([
                    'pending' => '待確認',
                    'confirmed' => '已確認',
                    'canceled' => '已取消',
                ])
                ->default('pending'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('user.name')->label('使用者')->sortable(),
                TextColumn::make('court.name')->label('球場'),
                TextColumn::make('start_time')->label('開始時間')->dateTime(),
                TextColumn::make('end_time')->label('結束時間')->dateTime(),
                TextColumn::make('status')->label('狀態'),
            ])
            ->recordActions([
                Action::make('edit')
                    ->url(fn (Booking $record): string => route('filament.admin.resources.bookings.edit', $record)),
                Action::make('delete')
                    ->action(fn (Booking $record) => $record->delete()),
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
            'index' => ListBookings::route('/'),
            'create' => CreateBooking::route('/create'),
            'edit' => EditBooking::route('/{record}/edit'),
        ];
    }
}
