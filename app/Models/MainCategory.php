<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;

    protected $table = 'main_category';
    protected $fillable = [
        'name_ar',
        'name_en',
        'active',
        'created_at',
        'updated_at	'
    ];

    public function scopeSelection($query)
    {
        return $query->select('id' , 'name_'.app()->getLocale().' as name', 'active');
    }
}
