<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ScoutsTeam extends Authenticatable
{
    use Notifiable;
    protected $table = "scouts_team";

    protected $fillable = [
        'sports_id',
        'email',
        'password',
        'club_name'
    ];

    public function videoPosts()
    {
        return $this->hasMany(VideoPosts::class, 'scouts_team_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sports_id');
    }
}
