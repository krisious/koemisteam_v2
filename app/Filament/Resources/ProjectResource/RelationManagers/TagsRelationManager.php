<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Illuminate\Support\Str;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;
use App\Models\Tag;

class TagsRelationManager extends RelationManager
{
    protected static string $relationship = 'tags';
    protected static ?string $inverseRelationship = 'project'; // Tentukan relasi balik
    protected static ?string $title = 'Tags';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_tag')
                    ->label('Tag')
                    ->options(\App\Models\Tag::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Tag')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect(),
                CreateAction::make()
                    ->form([
                        TextInput::make('name')
                            ->label('Tag')
                            ->required()
                            ->afterStateUpdated(fn (Set $set, $state) =>
                                $set('slug', Str::slug($state))
                            )
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->columnSpanFull(),
                            ])
                    ->action(function (array $data) {
                        Log::info('Creating new tag:', ['data' => $data]);
                        Tag::create([
                            'name' => $data['name'],
                            'slug' => $data['slug'],
                        ]);
                    }),
            ])
            ->actions([
                DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
