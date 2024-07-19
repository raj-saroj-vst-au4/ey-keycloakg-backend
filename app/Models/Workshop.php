<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;
    protected $table = "workshops";

    public function wscreator(){
        return $this->belongsTo(User::class, 'wscreator');
    }

    public function wsfalic(){
        return $this->belongsTo(User::class, 'wsfalic');
    }

    public function wsclg()
    {
        return $this->belongsTo(College::class);
    }
}
