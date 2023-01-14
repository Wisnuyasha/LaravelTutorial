<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use App\Models\About;
use Image;

class HomeSliderController extends Controller
{
    public function HomeSlide()
    {
        $homeslide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all', compact('homeslide'));
    }

    public function UpdateSlide(Request $request)
    {
        $slide_id = $request->id;
        if($request->file('home_slide')) {
            $image = $request->file('home_slide');
            $name_gen = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
            // 12314123.png
            Image::make($image)->resize(636,852)->save('upload/home_slide/' . $name_gen);
            $save_url = 'upload/home_slide/' . $name_gen;

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'home_slide' => $save_url,
            ]);

            $notification = array (
                'message' => 'Home Slide Update W/ Image Successfully',
                'alert_type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
            ]);

            $notification = array (
                'message' => 'Home Slide Update W/O Image Successfully',
                'alert_type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function HomeAbout()
    {
        $homeabout = About::find(1);
        return view('admin.home_slide.home_about_all', compact('homeabout'));
    }

    public function UpdateAbout(Request $request)
    {
        $slide_id = $request->id;
        if($request->file('about_image')) {
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
            Image::make($image)->resize(523,605)->save('upload/home_about/' . $name_gen);
            $save_url = 'upload/home_about/' . $name_gen;

            About::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url,
            ]);

            $notification = array (
                'message' => 'Home About Update W/ Image Successfully',
                'alert_type' => 'success'
            );
            return redirect()->back()->with($notification);

        } else {
            About::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]);

            $notification = array (
                'message' => 'Home About Update W/O Image Successfully',
                'alert_type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
}
