<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'category_id',
        'description',
        'amount',
        'type',
        'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
