<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFromRequest;

class SliderController extends Controller
{
    //Index function
    public function index(){
        $sliderData = Slider::get();
        return view('Admin.slider.index',compact('sliderData'));
    }
    //Create function
    public function create(){
        return view('Admin.slider.create');
    }

    //Store function
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
        'image' =>$validateData['image'],
        'status' =>$validateData['status'],
      ]);
      return redirect('other/slider')->with('massage','Slider added Successfully');
    }

    //edit function
    public function edit($slider_id){
         $slider = Slider::findOrFail($slider_id);
        $data = [
            'record' => $slider
        ];
        return view('Admin.slider.edit',$data);
    }

    //update slider

    public function update(SliderFromRequest $request, $id){
        $slider = Slider::findOrFail($id);
        $validateData = $request->validated();
        if($request->hasFile('image')){
          $destination = $slider->image;
          if(File::exists($destination)){
            File::delete($destination);
          }
          $file = $request->file('image');
          $ext = $file->getClientOriginalExtension();
          $filename = time() .'.'. $ext;
          $file->move('uploads/slider', $filename);
          $validateData['image'] = "uploads/slider/$filename";
        }
        $validateData['status'] = $request->status == true ? '1':'0';
        Slider::where('id',$id)->update([
          'title' =>$validateData['title'],
          'description' =>$validateData['description'],
          'image' =>$validateData['image'],
          'status' =>$validateData['status'],
        ]);
        return redirect('other/slider')->with('massage','Slider updated Successfully');
      }

      //delete function

      public function delete($id){
        $slider = Slider::findOrFail($id);
        if($slider->count() > 0){
            $destination = $slider->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $slider->delete();
        }
        return redirect('other/slider')->with('massage','Slider updated Successfully');
      }
}
