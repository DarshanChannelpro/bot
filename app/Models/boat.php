<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class boat extends Model
{
    use HasFactory;

    protected $table = 'boats'; // If the table name is different from 'boats'

    protected $fillable = ['boat_name'];
}
