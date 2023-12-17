<?php

namespace App\Services;

use Illuminate\Support\Facades\App;

trait Translatable
{
    public function __get($key)
    {
        if (isset($this->translatedAttributes) && in_array($key, $this->translatedAttributes)) {
            $key = $key . '_' . App::getLocale();
        }

        return parent::__get($key);
    }
}
