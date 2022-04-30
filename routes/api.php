<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\RecipeResource;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/home', [HomeController::class, 'index']);
Route::post('/favorite', function (Request $request) {
    $user = auth()->user();
    $recipe = Recipe::find($request->recipe_id);
    $user->favorite($recipe);
    return response()->json([
        'message' => 'Recipe favorited successfully',
    ], 201);
})->middleware('auth:sanctum');

Route::get('favorite', function (Request $request) {
    $user = auth()->user();

    $recipes  =   $user->getFavoriteItems(Recipe::class)->get();

    // return $recipes;
    return response()->json([
        'message' => 'Recipes favorited successfully',
        'data' => RecipeResource::collection($recipes),
    ], 200);
})->middleware('auth:sanctum');

Route::get('/category/{category}', function (Request $request, Category $category) {
    $category->load('recipes');
    $recipes = $category->recipes()->get();
    return response()->json([
        'message' => 'Recipes fetched successfully',
        'data' => RecipeResource::collection($recipes),
    ], 200);
});

Route::get('recipe/{recipe}', function (Request $request, Recipe $recipe) {
    return response()->json([
        'message' => 'Recipe fetched successfully',
        'data' => new RecipeResource($recipe),
    ], 200);
});
