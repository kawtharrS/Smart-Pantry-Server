<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\OpenAIService;

class OpenAIController extends Controller
{
    protected OpenAIService $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function getSuggestion(Request $request)
    {
        $request->validate([
            'ingredients' => 'required|array|min:1',
            'ingredients.*' => 'string',
        ]);

        $ingredients = $request->input('ingredients');

        $recipe = $this->openAIService->suggestion($ingredients);

        return response()->json(['recipe' => $recipe]);
    }

     public function getInsight(Request $request)
    {
        $mealplans = $request->input('mealplans');
        
        if (!$mealplans || !is_array($mealplans)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Meal plans are required and should be an array'
            ], 400);
        }
        
        try {
            $insights = $this->openAIService->insight($mealplans); 
            return response()->json([
                'status' => 'success',
                'insights' => $insights
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to generate insights: ' . $e->getMessage()
            ], 500);
        }
    }

    public function substituteIngredients(Request $request)
    {
        $request->validate([
            'ingredients' => 'required|array',
            'missing_ingredients' => 'required|array',
            'recipe' => 'required|string',
        ]);

        $ingredients = $request->input('ingredients');
        $missingIng = $request->input('missing_ingredients');
        $recipe = $request->input('recipe');

        try {
            $response = $this->openAIService->substitute($ingredients, $missingIng, $recipe);

            return response()->json([
                'status' => 'success',
                'substitution' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
