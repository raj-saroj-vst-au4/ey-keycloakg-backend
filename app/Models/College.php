<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;
    protected $connection = 'college_master_list'; // Use the specified connection
    protected $table = 'college_list';

    public function profiles(){
        return $this->hasMany(Profile::class);
    }
}
