<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase extends Model
{
    /** @use HasFactory<\Database\Factories\PurchaseFactory> */
    use HasFactory;
    protected $fillable = ['supplier_id', 'purchase_date', 'total'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function purchase_details()
    {
        return $this->hasMany(purchase_detail::class);
    }
}
