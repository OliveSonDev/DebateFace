<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'topic', 'type', 'adminkey', 'password', 'rule', 'moderator', 'debator_one', 'one_upvote', 'one_downvote', 'one_heart', 'one_sharp', 
        'debator_two', 'two_upvote', 'two_downvote', 'two_heart', 'two_sharp', 'participants'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'adminkey'
    ];

    protected $table = 'debates';
}
