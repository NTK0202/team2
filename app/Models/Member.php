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

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getBirthDateAttribute()
    {
        if ($this->attributes['birth_date']) {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['birth_date'])->format('d/m/Y');
        }
    }

    public function setIdentityCardDateAttribute($value)
    {
        $this->attributes['identity_card_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getIdentityCardDateAttribute()
    {
        if ($this->attributes['identity_card_date']) {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['identity_card_date'])->format('d/m/Y');
        }
    }

    public function setTaxDateAttribute($value)
    {
        $this->attributes['tax_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getTaxDateAttribute()
    {
        if ($this->attributes['tax_date']) {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['tax_date'])->format('d/m/Y');
        }
    }

    public function setStartDateOfficialAttribute($value)
    {
        $this->attributes['start_date_official'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getStartDateOfficialAttribute()
    {
        if ($this->attributes['start_date_official']) {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['start_date_official'])->format('d/m/Y');
        }
    }

    public function setStartDateProbationAttribute($value)
    {
        $this->attributes['start_date_probation'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getStartDateProbationAttribute()
    {
        if ($this->attributes['start_date_probation']) {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['start_date_probation'])->format('d/m/Y');
        }
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getEndDateAttribute()
    {
        if ($this->attributes['end_date']) {
            return Carbon::createFromFormat('Y-m-d', $this->attributes['end_date'])->format('d/m/Y');
        }
    }

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
}
