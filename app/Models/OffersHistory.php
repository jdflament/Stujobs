<?php
/**
 * Created by PhpStorm.
 * User: jean-davidflament
 * Date: 03/06/2018
 * Time: 17:06
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OffersHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offer_id', 'user_id', 'column_change', 'column_value'
    ];

    protected $table = "offers_history";

}