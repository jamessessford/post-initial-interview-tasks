<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Parental\HasChildren;

class User extends Authenticatable
{
    use HasApiTokens, HasChildren, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

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
        'email_verified_at' => 'datetime',
    ];

    // set the ability of a user to create and update complaints
    protected $canCreateComplaint = true;
    protected $canUpdateUnresolvedComplaint = true;
    protected $canUpdateResolvedComplaint = false;
    protected $canUpdateNotes = false;

    public function getCanCreateComplaint() : bool
    {
        return $this->canCreateComplaint;
    }

    public function getCanUpdateUnresolvedComplaint() : bool
    {
        return $this->canUpdateUnresolvedComplaint;
    }

    public function getCanUpdateResolvedComplaint() : bool
    {
        return $this->canUpdateResolvedComplaint;
    }

    public function getCanUpdateNotes() : bool
    {
        return $this->canUpdateNotes;
    }
}
