<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFromRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(){
        $sliderData = Slider::get();
        return view('Admin.slider.index',compact('sliderData'));
    }
    public function create(){
        return view('Admin.slider.create');
    }
    public function store(SliderFromRequest $request){
      $validateData = $request->validated();
      if($request->hasFile('image')){
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = time() .'.'. $ext;
        $file->move('uploads/slider', $filename);
        $validateData['image'] = "uploads/slider/$filename";
      }
      $validateData['status'] = $request->status == true ? '1':'0';
      Slider::create([
        'title' =>$validateData['title'],
        'description' =>$validateData['description'],
        'status' =>$validateData['status'],
      ]);
      return redirect('other/slider')->with('massage','Slider added Successfully');
    }
}
