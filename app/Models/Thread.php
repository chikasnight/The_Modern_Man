<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'post',
        
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comment(){
        return $this->hasMany(comment::class);
    }
}
