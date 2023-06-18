<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExperienceUser extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = "experience_user";

    protected $dates = [
        "update_at",
        "created_at",
        "deleted_at",
    ];

    protected $fillable = [
        'detail_user_id',
        'experience',
        "update_at",
        "created_at",
        "deleted_at",
    ];
}
