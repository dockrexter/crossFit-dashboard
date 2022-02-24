<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'dob',
        'picture',
        'codice_fiscale',
        'status',
        'social_login',
        'social_uid',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function plans()
    {
        return $this->hasMany(UserMemberShipPlan::class)->select(['id', 'name']);
    }

    public function reservations()
    {
        return $this->hasMany(UserReservation::class)->select(['id', 'user_id','workouts_of_day_id']);
    }

    public static function InsertImage($image){
        $image_path = '/user_pictures';
        $path = public_path() . $image_path;
        $imagename = time().'_'.rand(000 ,999).'.'.$image->getClientOriginalExtension();
        $image->move($path, $imagename);
        return $imagename;
    }

    public static function InsertCodiceFiscale($file){
        $file_path = '/user_codice_fiscales';
        $path = public_path() . $file_path;
        $filename = time().'_'.rand(000 ,999).'.'.$file->getClientOriginalExtension();
        $file->move($path, $filename);
        return $filename;
    }
}
