<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{
    public function AllCat()
    {
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);
        return view("admin.category.index",compact('categories','trashCat'));
    }

    public function AddCat(Request $request)
    {
        $validatedData = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:25',
                

            ],
            [
                'category_name.required' => 'A category name is required..',
                

            ]
        );


        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);


        //$category = new Category;
        //$category->category_name = $request->category_name;
        //$category->user_id = Auth::user()->id;
        //$category->save();

        //$data = array();
        //$data['category_name'] = $request->category_name;
        //$data['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($data);

        return Redirect()->back()->with("success", "Category Inserted Successfully");
    }



    public function Edit($id){

        $categories=Category::find($id);
        return view('admin.category.edit',compact('categories'));

    }

    public function Update(Request $request,$id){

        $update = Category::find($id)->update([
            'category_name'=> $request->category_name,
            'user_id'=> Auth::user()->id    
            ]);

        return Redirect()->route ('all.category')->with('success','Category Updated Succesfully.');

    }

    public function Remove($id){

        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category moved to Trash.');

    }

    public function Restore($id){

        $delete = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Category Restored Succesfully.');

    }

    public function Delete($id){

        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Category Permanently Deleted.');

    }
}
