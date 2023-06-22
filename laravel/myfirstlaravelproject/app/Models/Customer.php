<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'table_customers';
    protected $primaryKey = 'id';

    // this function set[dataname]Attribute($value) modify the row data that goes to the table

    public function setUserNameAttribute($value)
    {
        $this->attributes['user_name'] = ucwords($value);
    }

    public function getDob($value)
    {
        $this->where();
        return strtotime($value);
    }

    
}