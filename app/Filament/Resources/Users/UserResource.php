<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static UnitEnum|string|null $navigationGroup = '會員管理';

    protected static ?string $navigationLabel = '使用者';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->label('姓名')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(255),

            Select::make('role')
                ->label('角色')
                ->options([
                    'admin' => '管理員',
                    'user' => '一般會員',
                ])
                ->default('user')
                ->disablePlaceholderSelection(),

            TextInput::make('password')
                ->label('密碼')
                ->password()
                ->required(fn(string $context): bool => $context === 'create') // 只在新增必填
                ->same('password_confirmation') // 驗證要跟確認密碼一樣
                ->dehydrateStateUsing(fn($state) => !empty($state) ? bcrypt($state) : null) // 存入前加密
                ->dehydrated(fn($state) => filled($state)) // 避免空字串覆蓋舊密碼
                ->validationMessages([
                    'same' => '兩次輸入的密碼不一致，請重新確認。',
                ]),

            TextInput::make('password_confirmation')
                ->label('確認密碼')
                ->password()
                ->required(fn(string $context): bool => $context === 'create') // 新增時必填
                ->dehydrated(false), // 不存到資料庫
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('name')->label('姓名')->sortable()->searchable(),
                TextColumn::make('email')->label('Email')->sortable()->searchable(),
                TextColumn::make('role')->label('角色'),
            ])
            ->recordActions([
                Action::make('edit')
                    ->url(fn(User $record): string => route('filament.admin.resources.users.edit', $record)),
                Action::make('delete')
                    ->action(fn(User $record) => $record->delete()),
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
