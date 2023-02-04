<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class tbl_item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ItemName',
        'ItemPrice',
        'ItemUOM',
        'BrandID',
        'MinStock',
        'ReorderQty',
        'IsActive',
    ];

    public function brand(){
        return $this->hasOne(Brand::class, 'BrandID', 'BrandID');
    }
}
