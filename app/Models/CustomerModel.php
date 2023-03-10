<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{

    use  HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = "customer";

    protected $primaryKey = 'cid';

    protected $fillable = [
        'cid',
        'cus_code', 
        'cus_name',
        'cus_address',
        'cus_contact',
        'created_at', 
        'updated_at', 
        'created_by'
    ];



}
