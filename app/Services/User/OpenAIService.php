<?php

namespace App\Services\User;

use OpenAI\Laravel\Facades\OpenAI;

class OpenAIService
{
    public function suggestion(array $ingredients)
    {   
        $ingredientList = implode(', ', $ingredients);
        
        $prompt = "You are an AI chef. Suggest a recipe using the following ingredients: $ingredientList. 
        Include recipe name, ingredients list, step-by-step instructions, and approximate calories per serving.
        Format your response clearly with sections.";

        try {
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo', 
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a creative chef who makes delicious recipes from available ingredients.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'max_tokens' => 600,
                'temperature' => 0.8,
            ]);
            
            return $response->choices[0]->message->content;
        } catch (\Exception $e) {
            throw new \Exception('OpenAI API error: ' . $e->getMessage());
        }
    }

    public function insight(array $mealplans)
    {   
        $mealplanList = implode(', ', $mealplans);
        
        $prompt = "You are an AI chef. Analyze this weekly meal plan: $mealplanList. 
        Provide nutritional insights, balance assessment, and suggestions for improvements.
        Format your response with clear sections.";

        try {
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo', 
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a professional nutritionist and chef.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'max_tokens' => 500,
                'temperature' => 0.7,
            ]);
            
            return $response->choices[0]->message->content;
        } catch (\Exception $e) {
            throw new \Exception('OpenAI API error: ' . $e->getMessage());
        }
    }


   public function substitute(array $ingredients,array $missingIng,  $recipe)
    {   
        $ingredients = implode(', ', $ingredients);
        $missingIng = implode(', ', $missingIng);
        $prompt = "You are an AI chef. Give an alternative ingredient for a specific recipe from the ingredients available: $missingIng for .$recipe the availale ingredients are .$ingredients
        Format your response with clear sections.";

        try {
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo', 
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a professional nutritionist and chef.'],
                    ['role' => 'user', 'content' => $prompt]
                ],
                'max_tokens' => 500,
                'temperature' => 0.7,
            ]);
            
            return $response->choices[0]->message->content;
        } catch (\Exception $e) {
            throw new \Exception('OpenAI API error: ' . $e->getMessage());
        }
    }
}