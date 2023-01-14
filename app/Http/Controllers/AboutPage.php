<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Illuminate\Support\Carbon;
use Image;


class AboutPage extends Controller
{
    public function AboutPage()
    {
        $aboutpage = About::find(1);
        return view('frontend.about_all.about_page',compact('aboutpage'));
    }
    
    public function AboutMulti()
    {
        return view('admin.home_slide.about_multi');
    }

    public function StoreMulti(Request $request)
    {
        $image = $request->file('multi_image');

        foreach($image as $multi_image)
        {
            $name_gen = hexdec(uniqid()).'.'. $multi_image->getClientOriginalExtension();

            Image::make($multi_image)->resize(220,220)->save('upload/multi/' . $name_gen);
            $save_url = 'upload/multi/' . $name_gen;

            MultiImage::insert([
                'multi_image' => $save_url,
                'created_at' => Carbon::now()
            ]);
        }
            $notification = array (
                'message' => 'Multi Image Inserted Successfully',
                'alert_type' => 'success'
            );
            return redirect()->back()->with($notification);
    }

    public function AllMulti() 
    {
        $allMulti = MultiImage::all();
        return view('admin.home_slide.all_multi', compact('allMulti'));    
    }
}
