<?php

namespace App\Filament\Resources\MemberResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Facades\Log;
use App\Models\Skill;

class MemberSkillRelationManager extends RelationManager
{
    protected static string $relationship = 'memberSkill';
    protected static ?string $inverseRelationship = 'skillMember'; // Tentukan relasi balik
    protected static ?string $title = 'Skills';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_skill')
                    ->label('Skill')
                    ->options(\App\Models\Skill::all()->pluck('name', 'id'))
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
                    ->label('Skill')
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
                        Forms\Components\TextInput::make('name')
                            ->label('Jenis Skill')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('icon')
                            ->label('Ikon Skill')
                            ->disk('public')
                            ->directory('skill')
                            ->visibility('public')
                            ->downloadable()
                            ->required()
                            ->helperText(str('Pastikan ikon skill memiliki **background transparan**.')->inlineMarkdown()->toHtmlString()),
                        Forms\Components\ColorPicker::make('color')
                            ->label('Warna Skill')
                            ->regex('/^#([a-f0-9]{6}|[a-f0-9]{3})\b$/')
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        Log::info('Creating new skill:', ['data' => $data]);
                        Skill::create([
                            'name' => $data['name'],
                            'icon' => $data['icon'],
                            'color' => $data['color'],
                        ]);
                    }),
            ])
            ->actions([
                DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
                DeleteBulkAction::make(),
            ]);
    }
}