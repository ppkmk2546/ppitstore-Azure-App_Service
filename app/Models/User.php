<?php

/* The User model extends the Authenticatable trait from Laravel's
auth package. This trait gives us a lot of functionality out of the box,
including a full-featured password reset system, as well as a unique identifier
for each user.

The User model also extends the HasFactory trait from Laravel's
database package. This trait gives us a convenient way to create
factories for our User model.

The User model also extends the HasApiTokens trait from Laravel's
Sanctum package. */

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
    //  * @var array
     */
    // protected $appends = [
    //     'profile_photo_url',
    // ];

    public function profile()
    {
        return $this->hasOne(Profile::class,'user_id');
    }
}
