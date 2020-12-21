<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function AllCat()
    {
        return view("admin.category.index");
    }

    public function AddCat(Request $request)
    {
        $validatedData = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:255',

            ],
            [
                'category_name.required' => 'A Category Name is required..',
                'category_name.max' => 'Must be less than 255 Characters..',

            ]
        );
    }
}
