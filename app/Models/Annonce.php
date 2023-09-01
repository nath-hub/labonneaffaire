<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Annonce extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function categorie(){
        return $this->belongsTo(Categories::class);
    }

    public function payment(){
        return $this->hasMany(Payment::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)
        ->using(AnnonceUser::class)
        ->withPivot('state_favoris')
        ->withTimestamps();
    }
}
