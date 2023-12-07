<?php

namespace App\Actions\Sources;

use App\Models\Source;

class DeleteSourceAction
{
    public function execute(Source $model): bool
    {

        return $model->delete();
    }
}
