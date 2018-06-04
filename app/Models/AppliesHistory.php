<?php
/**
 * Created by PhpStorm.
 * User: jean-davidflament
 * Date: 04/06/2018
 * Time: 22:00
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppliesHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'apply_id', 'user_id', 'column_change', 'column_value'
    ];

    protected $table = "applies_history";

}