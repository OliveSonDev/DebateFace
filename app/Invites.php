<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invites extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'debateid', 'email', 'created_at', 'updated_at'
    ];

    protected $table = 'invites';
}
