<?php

namespace App\Apis;
use OpenAI\Laravel\Facades\OpenAI;

class recipe_suggestions_api
{
    function suggestion()
    {
        $response = OpenAI::responses()->create([
        'model' => 'gpt-5',
        'input' => 'Hello!',
    ]);

    echo $response->outputText;
    }
}
