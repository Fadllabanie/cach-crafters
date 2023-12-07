<?php

namespace App\Actions\Sources;

use App\Models\Source;

class CreateSourceAction
{
    public function execute(array $data): Source
    {
        // Validate and create a new Source
        // TODO: Add your validation and creation logic here

        return Source::create($data);
    }
}
