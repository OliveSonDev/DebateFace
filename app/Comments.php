<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'username', 'debateid', 'text', 'created_at', 'updated_at'
    ];

    protected $table = 'comments';
}
