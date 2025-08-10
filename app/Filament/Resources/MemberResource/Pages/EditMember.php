<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Spatie\Permission\Models\Role;

class EditMember extends EditRecord
{
    protected static string $resource = MemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $formState = $this->form->getRawState(); // Ambil semua state form

        // Update data User terlebih dahulu
        $user = $this->record->user;
        
        if ($user) {
            $user->update([
                'name' => $formState['user_name'],
                'email' => $formState['user_email'],
            ]);

            if (!empty($formState['user_password'])) {
                $user->update([
                    'password' => bcrypt($formState['user_password']),
                ]);
            }
        }

        // Masukkan id_user ke dalam data Siswa
        $data['id_user'] = $user->id;

        // Hilangkan field yang tidak ada di tabel `siswas`
        unset($data['user_name'], $data['user_email'], $data['user_password'], $data['roles']);

        if (isset($data['profile_picture']) && is_array($data['profile_picture'])) {
            $data['profile_picture'] = $data['profile_picture'][0] ?? null;
        }

        return $data;
    }

    protected function afterSave(): void
    {
        $user = $this->record->user;
        $formState = $this->form->getRawState();

        if ($user) {
            $roles = $formState['roles'] ?? [];

            if (!empty($roles)) {
                $user->syncRoles($roles);
            } else {
                // Jika roles tidak dipilih, pastikan tetap memiliki role "member"
                $defaultRole = Role::where('name', 'member')->first();
                if ($defaultRole) {
                $user->syncRoles([$defaultRole->id]);
                }
            }
        }
    }
}
