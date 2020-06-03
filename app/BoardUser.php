<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardUser extends Model
{
    protected $fillable = ['user_id', 'board_id'];
}
