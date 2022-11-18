<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\dishtype;
use Overtrue\LaravelFavorite\Traits\Favoriteable;

class AddDish extends Model
{
    use HasFactory, Sluggable ,Favoriteable;
    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'dishname'
            ]
        ];
    }

    public function ingredient()
    {
        return $this->hasMany(\App\Models\Ingredients::class);
    }
    public function procedure()
    {
        return $this->hasMany(\App\Models\Procedures::class);
    }
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    public function dishtype()
    {
        return $this->belongsTo(\App\Models\dishtype::class);
    }
    public function userprofile(){
        return $this->user()->profile;
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('dishname', 'Like', '%' . $search . '%');
        })
            ->when($filters['dishType'] ?? false, function ($query, $dish_type) {
                if ($dish_type === 'All') {
                    $query->get();
                } else {
                    $dish_type_id = dishtype::where('dishtype', $dish_type)->pluck('id');
                    $query->where('dishtype_id', $dish_type_id);
                }
            })
            ->when($filters['difficulty'] ?? false, function ($query, $difficulty) {
                if($difficulty === 'All'){
                    $query->get();
                }else{
                    $query->where('difficulty', $difficulty);
                }
            })
            ->when($filters['sort'] ?? false, function ($query, $sort) {

                if ($sort === 'new') {
                    $query->orderBy('created_at', 'desc');
                } else {
                    $query->orderBy('created_at', 'asc');
                }
            });
    }
}
