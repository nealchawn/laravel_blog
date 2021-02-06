<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
    	'body',
    	// 'user_id'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function owned_by(User $user){
        return ($this->user_id == $user->id);
    }

    public function liked_by(User $user){
        
        return $this->likes->contains('user_id',$user->id); // look at a collection at a key & value
    }

    public function likes(){
    	return $this->hasMany(PostRating::class)->where('status', '=', "like");
    }
}
