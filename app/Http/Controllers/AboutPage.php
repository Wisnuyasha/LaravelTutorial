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
            return redirect()->route('all.multi.image')->with($notification);
    }

    public function AllMulti() 
    {
        $allMulti = MultiImage::all();
        return view('admin.home_slide.all_multi', compact('allMulti'));    
    }

    public function EditMulti($id)
    {
        $multiImage = MultiImage::findOrFail($id);
        return view('admin.home_slide.edit_multi', compact('multiImage'));
    }

    public function UpdateMulti(Request $request)
    {
        $multi_image_id = $request->id;

        if ($request->file('multi_image')) {
            $image = $request->file('multi_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  // 3434343443.jpg

            Image::make($image)->resize(220,220)->save('upload/multi/'.$name_gen);
            $save_url = 'upload/multi/'.$name_gen;

            MultiImage::findOrFail($multi_image_id)->update([

                'multi_image' => $save_url,

            ]); 
            $notification = array(
            'message' => 'Multi Image Updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('all.multi.image')->with($notification);
        }
    }

    public function DeleteMulti($id)
    {
        $multi = MultiImage::findOrFail($id);
        $img = $multi->multi_image;
        unlink($img);

        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Multi Image Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
     }
}
