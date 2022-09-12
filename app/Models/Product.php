<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category',
        'quantity',
        'price',
        'photo',
        'description',
        'category_id',
        'user_id'
    ];
    public $timestamps = false;
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function cart(){
        return $this->hasMany(Cart::class);
    }
}