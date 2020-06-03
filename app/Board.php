<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{

    protected $fillable = ['name', 'visibility'];





    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'board_users');
    }
}
