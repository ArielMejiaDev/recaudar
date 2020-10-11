<?php namespace App\Services;

use App\Exceptions\UserCannotBeAttachedException;
use App\Models\Team;
use App\Notifications\ExistingUserTeamInvitation;
use App\Notifications\NewUserTeamInvitation;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class TeamAttachment
{
    /**
     * @param Team $team
     * @throws UserCannotBeAttachedException
     */
    public static function addUserTo(Team $team)
    {
        if($user = User::whereEmail(request()->email)->first()) {
           return static::addExistingUser($user, $team);
        }
        return static::addNewUser($team);
    }

    public static function addExistingUser(User $user, Team $team)
    {
        try {
            DB::transaction(function () use ($user, $team) {
                $user->teams()->attach($team, ['role_name' => request()->role]);

                try {
                    $user->notify(new ExistingUserTeamInvitation($user->email, $team->name));
                }catch (\Exception $exception) {
                    \Log::error('ExistingUserTeamInvitation Notification fail.');
                }

            });
        } catch (\Throwable $exception) {
            throw new UserCannotBeAttachedException();
        }
    }

    public static function addNewUser(Team $team)
    {
        try {
            DB::transaction(function () use ($team) {
                $user = User::create([
                    'name' => request()->name,
                    'email' => request()->email,
                    'password' => bcrypt($generatedPassword = uniqid()),
                    'email_verified_at' => now(),
                ]);
                $user->teams()->attach($team, ['role_name' => request()->role]);
                try {
                    $user->notify(new NewUserTeamInvitation($user->email, $team->name, $generatedPassword));
                }catch (\Exception $exception) {
                    \Log::error('NewUserTeamInvitation Notification fail.');
                }
            });
        } catch (\Throwable $exception) {
            throw new UserCannotBeAttachedException();
        }
    }
}
