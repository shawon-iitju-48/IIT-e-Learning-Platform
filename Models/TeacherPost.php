<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherPost extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "posts";
    protected $primaryKey = "p_id";
    public $incrementing = false;
}
