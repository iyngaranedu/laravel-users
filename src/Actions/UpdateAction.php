<?php


namespace Iyngaran\User\Actions;

use Iyngaran\User\DTO\UserData;

class UpdateAction
{
    public function execute(UserData $data, $user)
    {
        $user->update(
            $data->only(
                'name',
                'email',
                'company_name',
                'address',
                'city',
                'state',
                'country',
                'mobile',
                'phone'
            )
                ->toArray()
        );

        $user
            ->profile()
            ->update(
                $data->only(
                    'profile_picture',
                    'website_address',
                    'social_media_links',
                    'location_lat',
                    'location_lon',
                    'extra_fields'
                )
                    ->toArray()
            );

        if ($password = $data->only('password')->toArray()) {
             dd($password)
            $user->update($password);
        }

        if ($is_active = $data->only('is_active')->toArray()) {
            $user->update($is_active);
        }

        if ($roles = $data->only('roles')->toArray()) {
            $user->syncRoles($roles);
        }

        if ($permissions = $data->only('permissions')->toArray()) {
            foreach ($permissions as $permission) {
                $user->syncPermissions($permission);
            }
        }

        return getUserModel()::with('profile')->find($user->id);
    }
}
