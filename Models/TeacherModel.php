<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "teacher";
    protected $primaryKey = "u_id";
    public $incrementing = false;
}
