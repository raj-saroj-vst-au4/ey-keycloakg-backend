<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'college_id', 'department_id', 'designation_id', 'address', 'pincode', 'user_id', 'team_id', 'is_teamlead', 'is_admin'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function college()
    {
        return $this->belongsTo(College::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
}
