<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
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

    public function manager() {
        return $this->hasOne('App\Models\Manager');
    }

    public static function withUserFavorites($user) {
        return self::with(['favorites' => function($query) use ($user) {
            $query->where('user_id', $user->id);
        }]);
    }

    public function scopeAreaSearch($query, $area) {
        if(!empty($area)) {
            $query->where('area', $area);
        }
    }

    public function scopeGenreSearch($query, $genre) {
        if(!empty($genre)) {
            $query->where('genre', $genre);
        }
    }

    public function scopeKeywordSearch($query, $keyword) {
        if(!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    }
}
