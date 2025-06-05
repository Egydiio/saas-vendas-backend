<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantModule extends Model
{
    protected $table = 'tenant_modules';

    protected $fillable = [
        'tenant_id',
        'module_name',
        'enabled',
        'acquired_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'acquired_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
