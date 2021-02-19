<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Thankful extends Model
{
    use HasFactory, LaravelVueDatatableTrait;

    protected $table = "thankful";
    protected $primaryKey = "id";
    protected $fillable = ['name_surname','faculty_id','message_to','in_mind','received'];
    protected $dataTableColumns = [
        'id' => [
            'searchable' => false,
        ],
        'name_surname' => [
            'searchable' => true,
        ],
        'message_to' => [
            'searchable' => true,
        ],
        'received' => [
            'searchable' => true,
        ],
        'in_mind' => [
            'searchable' => false
        ],
        'url_id' => [
            'searchable' => false
        ]
    ];

    public function haveFaculty(){
        return $this->hasOne(Faculty::class,'faculty_id','faculty_id');
    }
}
