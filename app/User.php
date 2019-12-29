<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The primary-key attribute.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Table name attribute.
     *
     * @var string
     */
    public $tableName = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cover', 'cover_thumb',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user photo (cover) path
     *
     * @return string
     */
    public function getUrlCoverAttribute(): string
    {
        return !empty($this->cover) ? $this->cover : '';
    }

    /**
     * Get the user thumb (cover_thumb) path
     *
     * @return string
     */
    public function getUrlCoverThumbAttribute(): string
    {
        return !empty($this->cover_thumb) ? $this->cover_thumb : '';
    }

    /**
     * Mutator "password"
     *
     * @param string $password
     * @return void
     * @throws \Exception
     */
    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
