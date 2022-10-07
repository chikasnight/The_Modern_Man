<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'image',
        'upload_successful',
        'disk',
        
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getImagesAttribute()
    {
        return [
            "thumbnail" => $this->getImagePath("thumbnail"),
            "original" => $this->getImagePath("original"),
            "large" => $this->getImagePath("large"),
        ];
    }
    
    public function getImagePath($size)
    {
        return Storage::disk($this->disk)->url("uploads/products/{$size}/" . $this->image);
    }
}
