<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollegeModel extends Model
{
    protected $connection = 'college_master_list'; // Use the specified connection
    protected $table = 'college_list';
}
