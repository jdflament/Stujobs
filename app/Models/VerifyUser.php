<?php
/**
 * Created by PhpStorm.
 * User: jean-davidflament
 * Date: 03/04/2018
 * Time: 22:31
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}