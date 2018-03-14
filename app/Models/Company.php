<?php
/**
 * Created by PhpStorm.
 * User: jean-davidflament
 * Date: 14/03/2018
 * Time: 22:54
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'siret', 'address', 'phone'
    ];
}