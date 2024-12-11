<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class OwnerStudio extends Authenticatable
{
    use HasFactory;

    protected $table = 'owner_studio';
    protected $primaryKey = 'owner_uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'owner_uuid', 
        'studio_uuid', 
        'owner_nama', 
        'owner_email', 
        'owner_pass', 
        'owner_telp', 
        'owner_status'
    ];

    protected $casts = [
        'owner_status' => 'boolean',
    ];

    protected $hidden = [
        'owner_pass', 
        'remember_token',
    ];

    /**
     * Mutator untuk otomatis mengenkripsi password.
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['owner_pass'] = bcrypt($password);
    }

    /**
     * Override default getAuthPassword untuk menggunakan field `owner_pass`.
     */
    public function getAuthPassword()
    {
        return $this->owner_pass;
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