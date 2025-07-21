<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use Illuminate\Support\Facades\Auth;
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
use App\Models\Member;

class CollaboratorRelationManager extends RelationManager
{
    protected static string $relationship = 'collaborator';
    protected static ?string $inverseRelationship = 'collabProject'; // Tentukan relasi balik
    protected static ?string $title = 'Collaborator';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_member')
                    ->label('Member')
                    ->options(
                        \App\Models\Member::with('user')->get()->mapWithKeys(function ($member) {
                            return [$member->id => $member->user?->name ?? 'Tanpa Nama'];
                        })
                    )
                    ->required()
                    ->searchable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            // ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\ImageColumn::make('profile_picture')
                    ->label('Foto Profil'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama')
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
                Forms\Components\Select::make('recordId')
                    ->label('Pilih Member')
                    ->options(
                        \App\Models\Member::with('user')
                        ->whereHas('user', fn ($query) =>
                            $query->where('id', '!=', Auth::id())
                        )
                        ->get()
                        ->mapWithKeys(fn ($member) => [
                            $member->id => $member->user?->name ?? 'Tanpa Nama',
                        ])
                    )
                    ->searchable()
                    ->required(),
        ]),
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

    public static function getRecordTitle(\App\Models\Member $record): string
    {
        return $record->user?->name ?? '-';
    }
}
