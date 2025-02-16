<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function sale_detail()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
