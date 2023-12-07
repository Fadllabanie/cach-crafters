<?php

namespace App\Actions\Sources;

use App\Models\Source;

class UpdateSourceAction
{
    public function execute(Source $model, array $data): Source
    {

        $model->update($data);

        return $model;
    }
}
