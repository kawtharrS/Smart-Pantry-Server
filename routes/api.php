<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\HouseHoldController;
use App\Http\Controllers\User\IngredientController;
use App\Http\Controllers\User\PantryItemsController;
use App\Http\Controllers\User\RecipeController;
use App\Http\Controllers\User\RecipeIngredientcontroller;
use App\Http\Controllers\User\RecipeInstructionController;
use App\Http\Controllers\User\MealPlanController;
use App\Http\Controllers\User\ExpenseController;
use App\Http\Controllers\User\ExpenseItemController;
use App\Http\Controllers\User\ShoppingListController;
use App\Http\Controllers\User\ShoppingListItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\OpenAIController;


Route::group(["prefix"=>"v0.1", "middleware"=>"auth:api"], function()
{
    Route::group(["prefix"=>"user"], function(){
        Route::get('/', [UserController::class, "getAllUsers"]);
        Route::get('/delete/{id}',[UserController::class, "deleteUser"] );
        Route::get('/{id}',[UserController::class, "show"]  );
        Route::post('/add', [UserController::class, "createUser"]);
        Route::post('/update/{id}', [UserController::class, "updateUser"]);
    });

    Route::group(["prefix"=>"household"], function(){
        Route::get('/', [HouseHoldController::class, "getAllHouseholds"]);
        Route::get('/delete/{id}',[HouseHoldController::class, "deleteHousehold"] );
        Route::get('/{id}',[HouseHoldController::class, "show"] );
        Route::post('/add', [HouseHoldController::class, "createHousehold"]);
        Route::post('/update/{id}', [HouseHoldController::class, "updateHousehold"]);
        Route::post('/join',[HouseholdController::class, "join"]);
    });
    Route::group(["prefix"=>"pantryItem"], function(){
    Route::get('/', [PantryItemsController::class, "getAllPantryItems"]);
    Route::get('/{id}',[PantryItemsController::class, "deletePantryItem"] );
    Route::get('/{id}',[PantryItemsController::class, "show"] );
    Route::post('/add', [PantryItemsController::class, "createPantryItem"]);
    Route::post('/update/{id}', [PantryItemsController::class, "updatePantryItem"]);
});

Route::group(["prefix"=>"recipe"], function(){
    Route::get('/', [RecipeController::class, "getAllRecipes"]);
    Route::get('/delete/{id}',[RecipeController::class, "deleteRecipe"] );
    Route::get('/{id}',[RecipeController::class, "show"] );
    Route::post('/add', [RecipeController::class, "createRecipe"]);
    Route::post('/update/{id}', [RecipeController::class, "updateRecipe"]);
});

Route::group(["prefix"=>"recipeInstruction"], function(){
    Route::get('/recipeInstructions', [RecipeInstructionController::class, "getAllRecipesInstruction"]);
    Route::get('/delete/{id}',[RecipeInstructionController::class, "deleteRecipeInstruction"] );
    Route::get('/recipeInstruction/{id}',[RecipeInstructionController::class, "show"] );
    Route::post('/add', [RecipeInstructionController::class, "createRecipeInstruction"]);
    Route::post('/update/{id}', [RecipeInstructionController::class, "updateRecipeInsruction"]);
});

Route::group(["prefix"=>"recipeIngredient"], function(){
    Route::get('/recipeIngredients', [RecipeIngredientcontroller::class, "getAllRecipesIngredient"]);
    Route::get('/delete/{id}',[RecipeIngredientcontroller::class, "deleteRecipeIngredient"] );
    Route::get('/recipeIngredient/{id}',[RecipeIngredientcontroller::class, "show"] );
    Route::post('/add', [RecipeIngredientcontroller::class, "createRecipeInstruction"]);
    Route::post('/update/{id}', [RecipeIngredientcontroller::class, "updateRecipeIngredient"]);
});


Route::group(["prefix" => "mealplan"], function() {
    Route::get('/', [MealPlanController::class, "getAllMealPlans"]);
    Route::get('/day/{day}', [MealPlanController::class, "getByDay"]); 
    Route::get('/{id}', [MealPlanController::class, "show"]);
    Route::post('/add', [MealPlanController::class, "createMealPlan"]);
    Route::post('/update/{id}', [MealPlanController::class, "updateMealPlan"]);
    Route::get('/delete/{id}', [MealPlanController::class, "deleteMealPlan"]);
});

Route::group(["prefix"=>"shoppinglist"], function(){
    Route::get('/shoppinglists', [ShoppingListController::class, "getAllShoppingLists"]);
    Route::get('/delete/{id}',[ShoppingListController::class, "deleteShoppingList"] );
    Route::get('/shoppinglist/{id}',[ShoppingListController::class, "show"] );
    Route::post('/add', [ShoppingListController::class, "createShoppingList"]);
    Route::post('/update/{id}', [ShoppingListController::class, "updateShoppingList"]);
    Route::get('/shoppingList/week', [ShoppingListController::class, 'getWeeklyList']);

});

Route::group(["prefix"=>"shoppinglistitems"], function(){
    Route::get('/shoppinglistitems', [ShoppingListItemController::class, "getAllShoppingListItems"]);
    Route::get('/delete/{id}',[ShoppingListItemController::class, "deleteShoppingListItem"] );
    Route::get('/shoppinglistitem/{id}',[ShoppingListItemController::class, "show"] );
    Route::post('/add', [ShoppingListItemController::class, "createShoppingListItem"]);
    Route::post('/update/{id}', [ShoppingListItemController::class, "updateShoppingListItem"]);
});

Route::group(["prefix"=>"expenses"], function(){
    Route::get('/expenses', [ExpenseController::class, "getAllExpense"]);
    Route::get('/delete/{id}',[ExpenseController::class, "deleteExpense"] );
    Route::get('/expense/{id}',[ExpenseController::class, "show"] );
    Route::post('/add', [ExpenseController::class, "createExpense"]);
    Route::post('/update/{id}', [ExpenseController::class, "updateExpense"]);
});

Route::group(["prefix"=>"expenseItems"], function(){
    Route::get('/expenseItems', [ExpenseItemController::class, "getAllMExpenseItems"]);
    Route::get('/delete/{id}',[ExpenseItemController::class, "deleteExpenseItems"] );
    Route::get('/expenseItem/{id}',[ExpenseItemController::class, "show"] );
    Route::post('/add', [ExpenseItemController::class, "createExpenseItem"]);
    Route::post('/update/{id}', [ExpenseItemController::class, "updateExpenseItem"]);
});
    Route::group(["prefix"=>"ingredient"], function(){
        Route::get('/', [IngredientController::class, "getAllIngredients"]);
        Route::get('/delete/{id}',[IngredientController::class, "deleteIngredient"] );
        Route::get('//{id}',[IngredientController::class, "show"] );
        Route::post('/add', [IngredientController::class, "createIngredient"]);
        Route::post('/update/{id}', [IngredientController::class, "updateIngredient"]);
});

    Route::post('/api', [OpenAIController::class, 'getSuggestion']);
    Route::post('/insight', [OpenAIController::class, 'getInsight']);
    Route::post('/substitute', [OpenAIController::class, 'substituteIngredients']);

});





Route::post('/login', [AuthController::class, "login"]);
Route::post('/register', [AuthController::class, "register"]);
Route::get('/error', [AuthController::class, "displayError"])->name("login");



