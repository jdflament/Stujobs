<?php
/**
 * Created by PhpStorm.
 * User: jean-davidflament
 * Date: 11/04/2018
 * Time: 21:34
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offer_id', 'firstname', 'lastname', 'email', 'phone', 'cv_filename', 'cv_size', 'subject', 'message'
    ];
}