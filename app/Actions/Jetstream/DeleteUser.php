<?php

namespace App\Actions\Jetstream;

use App\Models\User;
use App\Repository\SettingsRepository;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        // Pobranie zalogowanego użytkownika
        $me = Auth::user();

        if ($me == null) {
            return redirect()->route('login');
            exit();
        } else {
            User::deleteContent();
            $settings = SettingsRepository::get();
            $settings->destroy($settings->id);
        }

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}
