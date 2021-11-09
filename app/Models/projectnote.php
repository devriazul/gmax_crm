<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectnote extends Model
{
    use HasFactory;

    public function admindata()
	{
        return  $this->belongsto(User::class, 'admin', 'id');
        
    }
}
