<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded=['id'];
    protected $fillable=[
        'name',
        'area',
        'genre',
        'comment',
        'img_url',
    ];

    public function reservations() {
        return $this->hasMany('App\Models\Reservation');
    }

    public function favorites() {
        return $this->hasMany('App\Models\Favorite');
    }
}
