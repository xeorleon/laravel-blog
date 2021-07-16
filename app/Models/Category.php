<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function articleCount(){
        return  $this->hasMany(Article::class,'category_id','id')->whereStatus(1)->count();
    }
}
