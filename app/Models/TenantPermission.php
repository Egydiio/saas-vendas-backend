<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantPermission extends Model
{
    protected $table = 'tenant_permissions';

    protected $fillable = [
        'tenant_id',
        'permission_id',
        'enabled',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
