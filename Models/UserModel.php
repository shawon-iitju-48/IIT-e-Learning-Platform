<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "user";
    protected $primaryKey = "u_id";
    public $incrementing = false;
}
class StudyMaterials extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "study_material";
    protected $primaryKey = "u_id,batch";
    public $incrementing = false;
}
