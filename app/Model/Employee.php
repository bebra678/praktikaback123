<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   use HasFactory;
   public $timestamps = false;
   protected $fillable = [
       'id ',
       'first_name',
       'name',
       'second_name',
       'sex',
       'date',
       'address',
       'id_subdivision ',
       'id_position ',
    ];
}
