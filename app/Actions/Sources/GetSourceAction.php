<?php

    namespace App\Actions\Sources;

use App\Models\Source;

class GetSourceAction
{
    public function execute(int $id): ?Source
    {
        return Source::find($id);
    }
}
