<?php

namespace App\Models;

use App\Traits\Uuid;
use Database\Factories\TenantFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    /** @use HasFactory<TenantFactory> */
    use HasFactory, Uuid;

    protected $table = 'tenants';
    protected $fillable =[
        'name',
        'create_at',
        'update_at',
        'delete_at',
    ];
}
