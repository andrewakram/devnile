<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = ['category_id', 'name', 'slug','description'];

    public function MainImage(){
        return $this->hasOne(ProductImage::class,'product_id')
            ->where('type','main');
    }

    public function Category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function Images(){
        return $this->hasMany(ProductImage::class,'product_id');
    }

}
