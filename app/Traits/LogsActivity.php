<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

/**
 * @method static void created(callable $callback)
 * @method static void updated(callable $callable)
 * @method static void deleted(callable $callable)
 */
trait LogsActivity
{
    public static function bootLogsActivity()
    {
        static::created(function ($model) {
            self::logAction('CREATE', $model);
        });

        static::updated(function ($model) {
            self::logAction('UPDATE', $model);
        });

        static::deleted(function ($model) {
            self::logAction('DELETE', $model);
        });
    }

    public static function logAction($action, $model)
    {
        if ($model instanceof AuditLog) {
            return;
        }

        AuditLog::create([
            'user_id'     => Auth::id(),
            'action'      => $action . ' - ' . class_basename($model),
            'description' => 'The record with ID ' . $model->id . ' was ' . strtolower($action),
            'ip_address'  => Request::ip(),
        ]);
    }
}