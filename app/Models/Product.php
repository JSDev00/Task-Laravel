<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'image',
        'category'
    ];
    public $translatable = ['name','description'];

    //realtionship one to many beetween product and category
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}
