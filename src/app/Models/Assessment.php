<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'shop_id',
        'evaluate',
        'count',
        'assessment_comment',
        'photo_url',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function shop() {
        return $this->belongsTo('App\Models\Shop');
    }
}
