<?php
/**
 * Created by Seth8277
 */

namespace App\Services;

use App\Contracts\Setting as SettingContract;
use App\Models\Setting;
use phpDocumentor\Reflection\Types\Boolean;

class SettingService implements SettingContract
{

    public function can(String $key): bool
    {
        return self::get($key, self::CANNOT) == self::CAN;
    }

    function get(String $key, $default)
    {
        return Setting::find($key, ['value'])->value ?? $default;
    }

    function set(String $key, $value): bool
    {
        if ($value instanceof Boolean)
            $value = $value ? self::CAN : self::CANNOT;

        return (Boolean)Setting::updateOrInsert(['key' => $key], ['value' => $value]);
    }

    function drop(String $key): bool
    {
        $model = Setting::find($key);

        if ($model->exists)
            return $model->delete();
        else
            return true;
    }
}