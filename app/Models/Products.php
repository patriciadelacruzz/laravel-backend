<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    //useDefaultDateTimeFormat;
    protected $table = 'products';

    public function product(){
        return $this->hasOne(ProductCategory::class, 'id', 'type_id');
    }

    public function getOthers(){
        return this->where(['is_other'=>4])->orderBy('id', 'DESC')->limit(3)->get();
    }

    public function getDrinkware(){
        return this->where(['type_id'=>5])->orderBy('id', 'DESC')->limit(3)->get();
    }

    public function getRecent(){
        return $this->limit(5)->orderBy('id', 'DESC')->get();
    }
}
