<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Image;
use Auth;

class HomeController extends Controller
{
    public function HomeSlider(){

        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider(){

        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request){
        
        $validatedData = $request->validate(
            [
                'image' => 'required|mimes:jpg,jpeg,png',
                'title' => 'required|unique:sliders|max:20'
            ]
        );

        $slider_image = $request->file('image');

        // Image Intervention Package
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);

        $last_img = 'image/slider/'.$name_gen;

        slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.slider')->with("success", "Slider Inserted Successfully");

    }

    public function DeleteSlider($id){

        $image = Slider::find($id);
        $old_image = $image->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return Redirect()->back()->with('success','Slider Deleted Successfully.');

    }


    public function EditSlider($id){

        $sliders=Slider::find($id);
        return view('admin.slider.edit',compact('sliders'));

    }

    public function UpdateSlider(Request $request,$id){

        $validatedData = $request->validate(
            [
                'title' => 'max:20',
                'description' => 'max:300',
                
            ],
            [
                
                'image.required' => 'The image is required..',
            ]
        );

        $old_image = $request->old_image;

        $image = $request->file('image');
        $description =$request->file('description');

        // If statement for change without changing image
        if($image){

        // Image Intervention Package
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1920,1088)->save('image/slider/'.$name_gen);
        $last_img = 'image/slider/'.$name_gen;

        unlink($old_image);


        Slider::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with("success", "Slider Updated Successfully.");

        }
        else{

            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => Carbon::now()
            ]);
    
            return Redirect()->back()->with("success", "Slider D  Updated Successfully.");
    
        }

    }

}
