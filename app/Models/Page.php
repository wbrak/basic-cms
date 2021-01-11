<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'pages';
    protected $hidden = ['created_at', 'updated_at'];

    public function user(){
    	return $this->hasOne(User::class, 'id', 'user_id');
    }
}
