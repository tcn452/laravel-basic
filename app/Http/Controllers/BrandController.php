<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Multipicture;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller



{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
{
    $this->middleware('auth');
}
    public function AllBrands()
    {
        $brands = Brand::latest()->paginate(10);
        return view('admin.brand.index', compact('brands'));
    }
    public function AddBrand(Request $request){
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4|max:255',
            'brand_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
    [
        'brand_name.required' => 'Please enter brand name',
        'brand_name.unique' => 'Brand name already exists',
        'brand_name.min' => 'Brand name must be at least 4 characters',
        'brand_name.max' => 'Brand name must be less than 255 characters',
        'brand_image.required' => 'Please upload brand image',
        'brand_image.image' => 'Please upload valid image type',
    ]);

        $brand_image  = $request->file('brand_image');
        // $image_name = hexdec(uniqid()).'.'.strtolower($brand_image->getClientOriginalExtension());
        // $up_location = 'images/brands/';
        // $last_img = $up_location.$image_name;
        // $brand_image->move($up_location, $image_name);

        $image_name = hexdec(uniqid()).'.'.strtolower($brand_image->getClientOriginalExtension());

        Image::make($brand_image)->resize(300, 200)->save('images/brands/'.$image_name);

        $last_img = 'images/brands/'.$image_name;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_At' => now(),
        ]);

        return Redirect()->back()->with('success', 'Brand added successfully');


    }

    public function edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|min:4|max:255',
        ],
    [
        'brand_name.min' => 'Brand name must be at least 4 characters',
        'brand_name.max' => 'Brand name must be less than 255 characters',
    ]);

            if ($request->hasFile('brand_image')) {
                $brand_image  = $request->file('brand_image');
                $image_name = hexdec(uniqid()).'.'.strtolower($brand_image->getClientOriginalExtension());
                $up_location = 'images/brands/';
                $last_img = $up_location.$image_name;
                unlink($request->old_image);
                $brand_image->move($up_location, $image_name);
            } else {
                $last_img = $request->old_image;
            }

            if ($request->brand_name) {
                $brand_name = $request->brand_name;
            } else {
                $brand_name = Brand::find($id)->brand_name;
            }


        $update = Brand::find($id)->update([
            'brand_name' => $brand_name,
            'brand_image'=> $last_img
        ]);
        return Redirect()->route('all.brands')->with('success', $last_img.' updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        unlink($brand->brand_image);
        $brand->delete();
        return Redirect()->back()->with('success', 'Brand was deleted');
    }

// Multiple Image All Method

public function Multipic(){
    $images = Multipicture::all();
    return view('admin.multipic.index', compact('images'));
}

public function StoreImage(Request $request){
//     $validatedData = $request->validate([
//         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//     ],
// [
//     'image.required' => 'Please upload brand image',
//     'image.image' => 'Please upload valid image type',
// ]);

    $images  = $request->file('image');

    foreach ($images as $image) {
        $image_name = hexdec(uniqid()).'.'.strtolower($image->getClientOriginalExtension());

        Image::make($image)->resize(300, 200)->save('images/multi/'.$image_name);

        $last_img = 'images/multi/'.$image_name;

        Multipicture::insert([
            'image' => $last_img,
            'created_At' => now(),
        ]);

    }
    //End of For Loop


    return Redirect()->back()->with('success', 'Images added successfully');

}


}

