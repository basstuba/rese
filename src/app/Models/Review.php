<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'shop_id',
        'evaluate',
        'review_comment',
        'posted_on',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function shop() {
        return $this->belongsTo('App\Models\Shop');
    }
}
