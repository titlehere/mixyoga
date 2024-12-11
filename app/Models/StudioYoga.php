<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StudioYoga extends Model
{
    use HasFactory;

    protected $table = 'studio_yoga';
    protected $primaryKey = 'studio_uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'studio_uuid',
        'owner_uuid',
        'studio_nama',
        'studio_lokasi',
        'studio_desk',
        'studio_logo', // Tambahkan ini
    ];

    public function owner()
    {
        return $this->belongsTo(OwnerStudio::class, 'owner_uuid', 'owner_uuid');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
