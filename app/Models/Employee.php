<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
  use HasFactory;

  protected $fillable = [
    'first_name',
    'last_name',
    'middle_name',
    'country_id',
    'state_id',
    'city_id',
    'address',
    'zip_code',
    'department_id',
    'birth_date',
    'hire_date',
  ];


  public function country()
  {
    return $this->belongsTo(Country::class);
  }


  public function state()
  {
    return $this->belongsTo(State::class);
  }


  public function city()
  {
    return $this->belongsTo(City::class);
  }


  public function department()
  {
    return $this->belongsTo(Department::class);
  }
}
