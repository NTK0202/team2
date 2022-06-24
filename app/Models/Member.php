<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticate;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Member extends Authenticate implements JWTSubject
{
    use HasFactory, SoftDeletes, HasApiTokens, Notifiable;

    protected $table = 'members';

    protected $fillable = [
        'member_code',
        'full_name',
        'email',
        'nick_name',
        'password',
        'remember_token',
        'other_email',
        'avatar',
        'avatar_official',
        'phone',
        'skype',
        'facebook',
        'gender',
        'marital_status',
        'birth_date',
        'permanent_address',
        'temporary_address',
        'identity_number',
        'identity_card_date',
        'identity_card_place',
        'passport_number',
        'passport_expiration',
        'nationality',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_number',
        'academic_level',
        'graduate_year',
        'bank_name',
        'bank_account',
        'tax_identification',
        'tax_date',
        'tax_place',
        'insurance_number',
        'healthcare_provider',
        'start_date_official',
        'start_date_probation',
        'end_date',
        'status',
        'note'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function memberId()
    {
        return $this->hasOne(MemberRole::class, 'member_id');
    }

    public function division()
    {
        return $this->belongsToMany(Division::class,'division_member');
    }

}
