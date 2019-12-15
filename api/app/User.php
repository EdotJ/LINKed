<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use Notifiable;
    use \Illuminate\Auth\Passwords\CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'description', 'birthday'
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

    public function jobForms()
    {
        return $this->hasMany(JobForm::class);
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function isJobFormOwner($id)
    {
        return in_array($id, $this->jobForms()->pluck('id')->all());
    }

    public function isPostOwner($id)
    {
        return in_array($id, $this->posts()->pluck('id')->all());
    }

    public function forms()
    {
        return $this->belongsToMany(User::class,'filled_job_form_user','user_id', 'filled_job_form_id');
    }
}
