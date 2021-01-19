<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Support\Carbon;

class AboutController extends Controller
{
    public function HomeAbout(){

        $homeabout = HomeAbout::latest()->get();
        return view('admin.about.index', compact('homeabout'));
    }

    public function AddAbout(){

        $homeabout = HomeAbout::latest()->get();
        return view('admin.about.create', compact('homeabout'));
    }

    public function StoreAbout(Request $request){

        HomeAbout::insert([
            'title' => $request->title,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.about')->with("success", "Data Inserted Successfully");
    }

    public function EditAbout($id){

        $homeabout = HomeAbout::find($id);
        return view('admin.about.edit', compact('homeabout'));
    }

    public function UpdateAbout(Request $request,$id){

        $update = HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
        ]);

        return Redirect()->route('home.about')->with("success", "Data Updated Successfully");
    }

    public function DeleteAbout($id){

        $delete = HomeAbout::find($id)->Delete();
        return Redirect()->back()->with("success", "Data Deleted Successfully");
    }

    public function Portfolio(){

        $images = Multipic::all();
        return view('pages.portfolio',compact('images'));
    }

}
