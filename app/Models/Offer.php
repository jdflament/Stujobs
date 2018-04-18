<?php
/**
 * Created by PhpStorm.
 * User: jean-davidflament
 * Date: 13/03/2018
 * Time: 21:53
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'title', 'description', 'contract_type', 'duration', 'remuneration', 'valid', 'complete', 'contact_email', 'contact_phone', 'city', 'sector'
    ];
}