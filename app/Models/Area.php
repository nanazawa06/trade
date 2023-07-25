<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;

class Area extends Model
{
    use HasFactory;
    
    public function users()
    {
        return $this->hasMany(User::class);   
    }
    
}
