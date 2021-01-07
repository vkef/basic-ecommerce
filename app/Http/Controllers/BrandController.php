<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use Auth;
use Image;


class BrandController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    
    public function AllBrand(){

        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));

    }

    public function StoreBrand(Request $request){

        $validatedData = $request->validate(
            [
                'brand_name' => 'required|unique:brands|min:4',
                'brand_name' => 'required|unique:brands|max:25',
                'brand_image' => 'required|mimes:jpg,jpeg,png',
            ],
            [
                'brand_name.required' => 'The name is required..',
                'brand_image.required' => 'The image is required..',
            ]
        );

        $brand_image = $request->file('brand_image');
        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image ->move($up_location,$img_name);

        // Image Intervention Package
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);

        $last_img = 'image/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with("success", "Brand Inserted Successfully");
    }


    public function Edit($id){

        $brands=Brand::find($id);
        return view('admin.brand.edit',compact('brands'));

    }


    public function Update(Request $request,$id){

        $validatedData = $request->validate(
            [
                'brand_name' => 'required|min:4',
                'brand_name' => 'required|max:25',
                
            ],
            [
                'brand_name.required' => 'The name is required..',
                'brand_image.required' => 'The image is required..',
            ]
        );

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        // If statement for name change without changing image
        if($brand_image){

        //  $name_gen = hexdec(uniqid());
        //  $img_ext = strtolower($brand_image->getClientOriginalExtension());
        //  $img_name = $name_gen.'.'.$img_ext;
        //  $up_location = 'image/brand/';
        //  $last_img = $up_location.$img_name;
        //  $brand_image ->move($up_location,$img_name);

        // Image Intervention Package
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);
        $last_img = 'image/brand/'.$name_gen;

        unlink($old_image);


        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with("success", "Brand Updated Successfully.");

        }
        else{

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);
    
            return Redirect()->back()->with("success", "Brand Image Name Updated Successfully.");
    
        }

    }


    public function Delete($id){

        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);

        Brand::find($id)->delete();
        return Redirect()->back()->with('success','Brand Deleted Successfully.');

    }



    // Multiple Images Section All Methods

    public function Multipic(){

        $images = Multipic::all();
        return view('admin.multipic.index',compact('images'));
    }


    public function StoreImg(Request $request){

        $validatedData = $request->validate(
            [
            
                'image' => 'required',
                'image.*' => 'image|mimes:jpeg,png,jpg|max:2048'
            ]
        );
        $image = $request->file('image');

        foreach($image as $multi_img){
        
        // Image Intervention Package
        $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
        Image::make($multi_img)->resize(300,200)->save('image/multi/'.$name_gen);

        $last_img = 'image/multi/'.$name_gen;

        Multipic::insert([
            
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        }//end foreach

        return Redirect()->back()->with("success", "Images Inserted Successfully");
    }


    public function Logout(){

        Auth::logout();
        return Redirect()->route('login')->with('success','User Logout');
    }



}
