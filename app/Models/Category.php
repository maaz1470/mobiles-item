<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    

    public function addedBy(){
        return $this->hasOne(Admin::class, 'id', 'added_by');
    }

    public function updateBy()
    {
        return $this->hasOne(Admin::class, 'id','Update_by');
    }
}
