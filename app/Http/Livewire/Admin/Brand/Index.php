<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name , $slug , $status , $brand_id = null;
    public function rules()
    {
        return [
            'name' => 'nullable',
            'slug' => 'nullable',
            'status' => 'nullable'
        ];
    }


    public  function closeModel()
    {
        $this->reset();
    }
    public  function openModel()
    {
        $this->reset();
    }

    public function storeBrand()
    {
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
        ]);
        return redirect('other/brands')->with('massage', 'Brand Store successfully');
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
        ]);
        return redirect('other/brands')->with('massage', 'Brand Update successfully');
        $this->reset();
    }

    public function editBrand($id)
    {
        $brand = Brand::findOrFail($id);
        $this->brand_id = $id;
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
    }



    public function deleteBrand($id)
    {
        $this->brand_id = $id;
    }

    public function destroyBrand()
    {
         Brand::find($this->brand_id)->delete();
         return redirect('other/brands')->with('massage', 'Delete successfully');
    }



    public function render()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(4);
        return view('livewire.admin.brand.index', ['brands' => $brands])
            ->extends('layouts.admin')
            ->section('content');
    }
}
