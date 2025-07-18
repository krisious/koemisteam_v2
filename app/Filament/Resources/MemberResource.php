<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn; 
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'User';

    protected static ?string $navigationLabel = 'Members';

    protected static ?string $slug = 'member';

    protected static ?string $label = 'Members';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('id_user'),
                FileUpload::make('profile_picture')
                    ->label('Foto Profil')
                    ->disk('public')
                    ->directory('profil')
                    ->visibility('public')
                    ->downloadable()
                    ->required()
                    ->dehydrated()
                    ->helperText(str('Pastikan foto memiliki **background transparan**.')->inlineMarkdown()->toHtmlString()),

                TextInput::make('user_name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->dehydrated(false) // Jangan simpan ke model siswa
                    ->afterStateHydrated(function (TextInput $component, $state, $record) {
                        if ($record?->user) {
                            $component->state($record->user->name);
                        }
                    })
                    ->columnSpanFull()
                    ->afterStateUpdated(fn (Set $set, $state) =>
                        $set('slug', Str::slug($state))
                    ),

                TextInput::make('slug')
                    ->label('Slug')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->columnSpanFull(),

                TextInput::make('user_email')
                    ->label('Email')
                    ->dehydrated(false)
                    ->afterStateHydrated(function (TextInput $component, $state, $record) {
                        if ($record?->user) {
                            $component->state($record->user->email);
                        }
                    })
                    ->email()
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('user_password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->maxLength(16)
                    ->rules(['min:8', 'max:16'])
                    ->validationMessages([
                        'min' => 'Password minimal harus :min karakter.',
                        'max' => 'Password maksimal :max karakter.',
                    ])
                    ->required(fn (string $context) => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state))
                    ->visibleOn(['create', 'edit'])
                    ->helperText(fn (string $context) => $context === 'edit' 
                        ? 'Kosongkan jika tidak ingin mengganti password' 
                        : null)
                    ->columnSpanFull(),
                    
                RichEditor::make('bio')
                    ->label('Bio')
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Lengkap')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable(),
            ])->defaultSort('user.name', 'desc')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MemberSkillRelationManager::class,
            RelationManagers\MemberContactRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
