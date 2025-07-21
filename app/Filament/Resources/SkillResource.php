<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Filament\Resources\SkillResource\RelationManagers;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ColorPicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ColorColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Asset';

    protected static ?string $navigationLabel = 'Skills';

    protected static ?string $slug = 'skill';
    
    protected static ?string $label = 'Skills';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Jenis Skill')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('icon')
                    ->label('Ikon Skill')
                    ->disk('public')
                    ->directory('skill')
                    ->visibility('public')
                    ->downloadable()
                    ->required()
                    ->helperText(str('Pastikan gambar Icon memiliki **background transparan**.')->inlineMarkdown()->toHtmlString()),
                ColorPicker::make('color')
                    ->label('Warna Skill')
                    ->regex('/^#([a-f0-9]{6}|[a-f0-9]{3})\b$/')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Jenis Skill')
                    ->copyable()
                    ->copyMessage('Skill name copied')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('icon')
                    ->label('Ikon Skill'),
                ColorColumn::make('color')
                    ->label('Warna Skill')
                    ->copyable()
                    ->copyMessage('Color code copied'),
            ])->defaultSort('name', 'asc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}
