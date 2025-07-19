<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Hidden;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Post';

    protected static ?string $navigationLabel = 'Blogs';

    protected static ?string $slug = 'blog';

    protected static ?string $label = 'Blogs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('id_member')
                    ->default(function () {
                        $user = Auth::user();
                        return Member::where('id_user', $user->id)->value('id');
                    })
                    ->default(fn () => optional(Member::where('id_user', Auth::id())->first())->id),
                TextInput::make('nama_penulis')
                    ->label('Penulis')
                    ->disabled()
                    ->dehydrated(false)
                    ->columnSpanFull()
                    ->default(function () {
                        $user = Auth::user();
                        return optional($user)->name;
                    })
                    ->afterStateHydrated(function (TextInput $component, $state, $record) {
                        if ($record?->member?->user) {
                            $component->state($record->member->user->name);
                        }
                    }),
                Select::make('id_category')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->columnSpanFull(),
                TextInput::make('title')
                    ->label('Judul')
                    ->required()
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
                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->disk('public')
                    ->directory('blog')
                    ->visibility('public')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Konten')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_published')
                    ->label('Status Publish')
                    ->default(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail'),
                TextColumn::make('member.name')
                    ->label('Penulis')
                    ->copyable()
                    ->copyMessage('Copied to clipboard!')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->copyable()
                    ->copyMessage('Copied to clipboard!')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->copyable()
                    ->copyMessage('Copied to clipboard!')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->copyable()
                    ->copyMessage('Copied to clipboard!')
                    ->sortable()
                    ->searchable(),
                ToggleColumn::make('is_published'),
                TextColumn::make('is_published')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state): string => match ((bool) $state) {
                        true => 'Published',
                        false => 'Draft',
                    })
                    ->color(fn ($state): string => match ((bool) $state) {
                        true => 'success',
                        false => 'warning',
                    })
                    ->sortable()
                    ->searchable(),
                TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
            ])
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

    public static function getRelations(): array
    {
        return [
            RelationManagers\TagsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
