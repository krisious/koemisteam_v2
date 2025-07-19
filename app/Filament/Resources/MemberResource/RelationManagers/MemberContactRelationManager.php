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
use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;

class MemberContactRelationManager extends RelationManager
{
    protected static string $relationship = 'memberContact';
    protected static ?string $inverseRelationship = 'contactMember';
    protected static ?string $title = 'Kontak';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_contact')
                    ->label('Jenis Kontak')
                    ->options(Contact::pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('value')
                    ->label('URL')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Jenis Kontak')
                    ->sortable()
                    ->searchable()
                    ->default('N/A')
                    ->formatStateUsing(function ($state, $record) {
                        Log::info('Contact Name Debug:', [
                            'record' => $record->toArray(),
                            'contact' => $record->contact ? $record->contact->toArray() : null,
                            'state' => $state,
                            'id_contact' => $record->id_contact,
                            'contact_exists' => Contact::where('id', $record->id_contact)->exists(),
                        ]);
                        return $state ?? 'N/A';
                    }),
                Tables\Columns\TextColumn::make('pivot.value')
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
                        Forms\Components\Select::make('id_contact')
                            ->label('Jenis Kontak')
                            ->options(Contact::pluck('name', 'id'))
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('value')
                            ->label('URL')
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        Log::info('Attach Contact Data:', ['data' => $data]);
                        $member = $this->getOwnerRecord();
                        if ($member === null) {
                            Log::error('Owner Record is null');
                            throw new \Exception('Owner Record is null');
                        }
                        Log::info('Attaching contact to member:', [
                            'member_id' => $member->id,
                            'id_contact' => $data['id_contact'],
                            'value' => $data['value'],
                        ]);
                        $member->memberContact()->attach($data['id_contact'], [
                            'value' => $data['value'],
                        ]);
                    }),
                CreateAction::make()
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('Jenis Kontak')
                            ->required(),
                        Forms\Components\FileUpload::make('icon')
                            ->label('Ikon Kontak')
                            ->disk('public')
                            ->directory('contact')
                            ->visibility('public')
                            ->downloadable()
                            ->required()
                            ->multiple(false)
                            ->helperText(str('Cari ikon kontak di **fontawesome.com** agar semuanya seragam.')->inlineMarkdown()->toHtmlString()),
                    ])
                    ->action(function (array $data) {
                        Log::info('Creating new contact:', ['data' => $data]);
                        Contact::create([
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
                DeleteBulkAction::make(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('contact');
    }
}