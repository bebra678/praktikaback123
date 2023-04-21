<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   use HasFactory;
   public $timestamps = false;
   protected $fillable = [
   'id_employee',
   'first_name',
   'name',
   'second_name',
   'sex',
   'date',
   'adres', 
];
}
