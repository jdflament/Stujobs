<?php
/**
 * Created by PhpStorm.
 * User: jean-davidflament
 * Date: 11/04/2018
 * Time: 21:34
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestData extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'code'
    ];

    protected $table = "guest_data";
}