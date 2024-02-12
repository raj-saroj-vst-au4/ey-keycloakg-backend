<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $table = "designations";
    public function profiles()
    {
        return $this->hasMany(Profile::class);
    }
}
