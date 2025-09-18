<?php

namespace App\Filament\Resources\Bookings;

use App\Filament\Resources\Bookings\Pages\CreateBooking;
use App\Filament\Resources\Bookings\Pages\EditBooking;
use App\Filament\Resources\Bookings\Pages\ListBookings;
use App\Models\Booking;
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
                ->required()
                ->disablePlaceholderSelection(),
            Select::make('court_id')
                ->label('球場')
                ->relationship('court', 'name')
                ->required()
                ->disablePlaceholderSelection(),
            DateTimePicker::make('start_time')
                ->label('開始時間')
                ->minutesStep(30) // 每格 30 分鐘
                ->displayFormat('m-d H:i')
                ->required(),
            DateTimePicker::make('end_time')
                ->label('結束時間')
                ->minutesStep(30) // 每格 30 分鐘
                ->displayFormat('m-d H:i')
                ->required(),
            Select::make('status')
                ->label('狀態')
                ->options([
                    'pending' => '待確認',
                    'confirmed' => '已確認',
                    'canceled' => '已取消',
                ])
                ->default('pending')
                ->disablePlaceholderSelection(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('user.name')->label('使用者')->sortable(),
                TextColumn::make('court.name')->label('球場'),
                TextColumn::make('start_time')
                    ->label('開始時間')
                    ->dateTime('m-d H:i'), // 只顯示到分鐘
                TextColumn::make('end_time')
                    ->label('結束時間')
                    ->dateTime('m-d H:i'), // 只顯示到分鐘
                TextColumn::make('status')
                    ->label('狀態')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'pending' => '待確認',
                            'confirmed' => '已確認',
                            'canceled' => '已取消',
                            default => $state,
                        };
                    }),
            ])
            ->recordActions([
                Action::make('confirm')
                    ->label('確認')
                    ->visible(fn(Booking $record) => $record->status === 'pending')
                    ->action(function (Booking $record) {
                        $record->status = 'confirmed';
                        $record->save();
                    })
                    ->requiresConfirmation()
                    ->color('success'),
                Action::make('編輯')
                    ->url(fn(Booking $record): string => route('filament.admin.resources.bookings.edit', $record)),
                Action::make('刪除')
                    ->action(fn(Booking $record) => $record->delete()),
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
