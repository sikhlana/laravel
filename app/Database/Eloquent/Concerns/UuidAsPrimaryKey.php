<?php

namespace App\Database\Eloquent\Concerns;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait UuidAsPrimaryKey
{
    protected function initializeUuidAsPrimaryKey()
    {
        $this->keyType = 'string';
        $this->incrementing = false;
    }

    protected static function bootUuidAsPrimaryKey()
    {
        static::creating(function (Model $model) {
            if (is_null($model->getKey())) {
                $model->setAttribute(
                    $model->getKeyName(), (string) Str::orderedUuid()
                );
            }
        });
    }
}
