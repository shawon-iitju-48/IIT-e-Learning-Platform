<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "student";
    protected $primaryKey = "u_id";
    public $incrementing = false;
}
