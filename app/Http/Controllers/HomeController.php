<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\RecipeResource;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Category;

class HomeController extends Controller
{
    //


    public function index()
    {
        $categories = Category::all();
        $recipes = Recipe::orderBy('id', 'desc')->take(5)->get();


        return response()->json([
            'message' => 'Welcome to the Recipe API',
            'data' => [
                'categories' =>  CategoryResource::collection($categories),
                'recipes' =>     RecipeResource::collection($recipes),
            ],
        ], 200);
    }
    
}
