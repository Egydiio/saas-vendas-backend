<?php

namespace App;

namespace App\Traits;
use Ramsey\Uuid\Uuid as RamsayUuid;

trait Uuid
{
    public static function bootUuid()
    {
        static::creating(function ($model) {
            $model->uuid = RamsayUuid::uuid4();
        });
    }
}
