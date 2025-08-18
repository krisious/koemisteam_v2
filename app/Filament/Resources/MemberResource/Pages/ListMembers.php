<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;

class ListMembers extends ListRecords
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function mount(): void
    {
        $user = \Filament\Facades\Filament::auth()->user();

        if ($user && $user->hasRole('member') && $user->member) {
            $this->redirect(
                route('filament.admin.resources.member.edit', $user->member->id)
            );
        }
    }
}
