<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobHistory extends Model
{
    use HasFactory;

    protected $table = "job_history";
    protected $fillable = [
        "company","job_title","start","end","company_color","logo","backdrop"
    ];
}
