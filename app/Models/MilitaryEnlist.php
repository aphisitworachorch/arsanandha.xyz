<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitaryEnlist extends Model
{
    use HasFactory;

    protected $table = 'military_enlist';
    public $incrementing = true;
    protected $primaryKey = 'military_id';
    protected $fillable = [
        'type','info'
    ];

    /**
     * @param Request $arr
     * @return bool|string
     */
    public static function MILJSON(Request $arr):bool|string
    {
        return json_encode(
            array(
                "dataType"=>$arr->dataType,
                "value"=>$arr->valueJSON,
                "active"=>$arr->activeJSON
            )
        );
    }
}
