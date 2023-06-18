<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = "service";

    protected $dates = [
        "update_at",
        "created_at",
        "deleted_at",
    ];

    protected $fillable = [
        'users_id',
        'title',
        'description',
        'delivery_time',
        'revision_limit',
        'price',
        'note',
        'updated_at',
        'created_at',
        'deleted_at'
    ];
}
