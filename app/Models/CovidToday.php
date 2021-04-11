<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovidToday extends Model
{
    use HasFactory;

    protected $table = 'covid_today';
    protected $primaryKey = 'id';
    protected $fillable = ['total_covid','today_covid','today_recovered','total_recovered'];
}
