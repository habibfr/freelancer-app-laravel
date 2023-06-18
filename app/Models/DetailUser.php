<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = "detail_user";

    protected $dates = [
        "update_at",
        "created_at",
        "deleted_at",
    ];

    protected $fillable = [
        'users_id',
        'photo',
        'role',
        'contact_number',
        'biography',
        "update_at",
        "created_at",
        "deleted_at",
    ];
}
