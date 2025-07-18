<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateMember extends CreateRecord
{
    protected static string $resource = MemberResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ambil form state mentah hanya untuk user
        $formState = $this->form->getRawState();

        // Buat user
        $user = User::create([
            'name' => $formState['user_name'],
            'email' => $formState['user_email'],
            'password' => bcrypt($formState['user_password']),
        ]);

        // Tambahkan id_user ke data yang akan disimpan ke Member
        $data['id_user'] = $user->id;

        // Hapus user_* dari data Member
        unset($data['user_name'], $data['user_email'], $data['user_password']);

        // Pastikan profile_picture string, bukan array
        if (isset($data['profile_picture']) && is_array($data['profile_picture'])) {
            $data['profile_picture'] = $data['profile_picture'][0] ?? null;
        }

        return $data;
    }


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
