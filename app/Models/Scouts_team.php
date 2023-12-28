<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scouts_team extends Model
{
    use HasFactory;
    protected $table = "scouts_team";

    protected $fillable = [
        'sports_id',
        'email',
        'password',
        'club_name'
    ];

    public function videoPosts()
    {
        return $this->hasMany(Video_posts::class, 'scouts_team_id');
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class, 'sports_id');
    }
}
