<?php

    namespace App\Actions\Sources;

use App\Models\Source;

class GetAllSourceAction
{
    public function execute()
    {
        return Source::all();
    }
}
