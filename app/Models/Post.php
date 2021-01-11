<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'posts';
    protected $hidden = ['created_at', 'updated_at'];

    public function cat(){
    	return $this->hasOne(Category::class, 'id', 'category');
    }

    public function user(){
    	return $this->hasOne(User::class, 'id', 'user_id');
    }
}
