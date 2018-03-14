<?php
/**
 * Created by PhpStorm.
 * User: jean-davidflament
 * Date: 15/03/2018
 * Time: 00:04
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'firstname', 'lastname', 'phone', 'office'
    ];
}