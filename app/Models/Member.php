<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Member extends Authenticatable
{
    use HasFactory;

    protected $table = 'member';
    protected $primaryKey = 'member_uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'member_uuid', 
        'member_nama', 
        'member_email', 
        'member_pass', 
        'member_telp', 
        'member_status'
    ];

    protected $casts = [
        'member_status' => 'boolean',
    ];

    protected $hidden = [
        'member_pass', 
        'remember_token',
    ];

    /**
     * Mutator untuk otomatis mengenkripsi password.
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['member_pass'] = bcrypt($password);
    }

    /**
     * Override default getAuthPassword untuk menggunakan field `member_pass`.
     */
    public function getAuthPassword()
    {
        return $this->member_pass;
    }

    /**
     * Generate UUID saat model dibuat.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}