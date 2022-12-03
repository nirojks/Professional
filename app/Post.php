<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
	
class Post extends Model
{
    protected $fillable=[
        'title','slug','body','listing_id','user_id','image','number'
    ];

    public function listing(){
        return $this->belongsTo(Listing::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
