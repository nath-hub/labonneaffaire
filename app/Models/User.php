<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable 
{
    use HasFactory, HasApiTokens, Notifiable, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

      /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

      /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function annonce(){
        return $this->hasMany(Annonce::class);
    }

    public function payment(){
        return $this->hasMany(Payment::class);
    }

    public function annonces(){
        return $this->belongsToMany(Annonce::class)
        ->using(AnnonceUser::class)
        ->withPivot('state_favoris')
        ->withTimestamps();
    }
    

     /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */


     /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Methods
    |--------------------------------------------------------------------------
    */
}
