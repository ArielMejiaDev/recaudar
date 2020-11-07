<?php

namespace App;

use App\Models\Role;
use App\Models\Team;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'role', 'latin_created_at',
    ];

    public function getLatinCreatedAtAttribute() {
        return $this->created_at->format('d/m/Y');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class)->using(Role::class)->as('role')->withPivot('role_name');
    }

    public function isAdmin()
    {
        return $this->roles()->whereName('admin')->exists();
    }

    public function isATeamMember(String $teamSlug)
    {
        return $this->teams()->whereSlug($teamSlug)->exists();
    }

    /**
     * @return string|null
     */
    public function getRoleAttribute()
    {
        if ($this->id === auth()->id()) {
            if($adminTeam = $this->teams()->whereName('recaudar')->first()) {
                return $adminTeam->role->role_name;
            }
        }
        if(request()->team && $team = $this->teams()->where('teams.id', request()->team->id)->first() ) {
            return ucfirst(str_replace('team_', '', $team->role->role_name));
        }
        return null;
    }
}
