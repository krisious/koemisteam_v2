<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Illuminate\Support\Str;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
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
use App\Models\Link;

class LinkRelationManager extends RelationManager
{
    protected static string $relationship = 'link';
    protected static ?string $inverseRelationship = 'project';
    protected static ?string $title = 'Project Link';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_link')
                    ->label('Jenis Kontak')
                    ->options(Link::pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                TextInput::make('url')
                    ->label('URL')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Jenis Link')
                    ->sortable()
                    ->searchable()
                    ->default('N/A')
                    ->formatStateUsing(function ($state, $record) {
                        Log::info('Link Name Debug:', [
                            'record' => $record->toArray(),
                            'link' => $record->link ? $record->link->toArray() : null,
                            'state' => $state,
                            'id_link' => $record->id_link,
                            'link_exists' => Link::where('id', $record->id_link)->exists(),
                        ]);
                        return $state ?? 'N/A';
                    }),
                Tables\Columns\TextColumn::make('pivot.url')
                    ->label('URL')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        Select::make('id_link')
                            ->label('Jenis Link')
                            ->options(Link::pluck('name', 'id'))
                            ->required()
                            ->searchable(),
                        TextInput::make('url')
                            ->label('URL')
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        Log::info('Attach Link Data:', ['data' => $data]);
                        $project = $this->getOwnerRecord();
                        if ($project === null) {
                            Log::error('Owner Record is null');
                            throw new \Exception('Owner Record is null');
                        }
                        Log::info('Attaching link to project:', [
                            'project_id' => $project->id,
                            'id_link' => $data['id_link'],
                            'url' => $data['url'],
                        ]);
                        $project->link()->attach($data['id_link'], [
                            'url' => $data['url'],
                        ]);
                    }),
                CreateAction::make()
                    ->form([
                        TextInput::make('name')
                            ->label('Jenis Link')
                            ->required(),
                        Forms\Components\FileUpload::make('icon')
                            ->label('Ikon Link')
                            ->disk('public')
                            ->directory('link')
                            ->visibility('public')
                            ->downloadable()
                            ->required()
                            ->multiple(false)
                            ->helperText(str('Pastikan gambar Icon memiliki **background transparan**.')->inlineMarkdown()->toHtmlString()),
                    ])
                    ->action(function (array $data) {
                        Log::info('Creating new link:', ['data' => $data]);
                        link::create([
                            'name' => $data['name'],
                            'icon' => $data['icon'],
                        ]);
                    }),
            ])
            ->actions([
                EditAction::make(),
                DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\DetachBulkAction::make(),
                ]),
            ]);
    }
}
