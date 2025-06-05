<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRule extends Model
{
    protected $table = 'user_rules';

    protected $fillable = [
        'user_id',
        'rule_id',
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
