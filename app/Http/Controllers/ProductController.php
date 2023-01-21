<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductColor;
use Illuminate\Console\View\Components\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'Products' => Product::all(),
        ];
        return view('Admin.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = [
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'colors' => Color::where('status', '0')->get(),
        ];
        return view('Admin.products.create', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData =  $request->validated();
        $category = Category::findOrFail($validatedData['category_id']);
        $product = $category->products()->create([
            'category_id' => $validatedData['category_id'],
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['slug']),
            'brand' => $validatedData['brand'],
            'small_description' => $validatedData['small_description'],
            'description' => $validatedData['description'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $validatedData['selling_price'],
            'quantity' => $validatedData['quantity'],
            'trending' => $request->trending == true ? '1' : '0',
            'status' => $request->status == true ? '1' : '0',
            'meta_title' => $validatedData['meta_title'],
            'meta_keyword' => $validatedData['meta_keyword'],
            'meta_description' => $validatedData['meta_description'],
        ]);

        if ($request->hasFile('image')) {
            $uploadPath = 'upload/products/';
            $i = 1;
            foreach ($request->file('image') as $imageFile) {
                $ext = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $ext;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath . '' . $filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }

        if ($request->colors) {
            foreach ($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorQuantity[$key] ?? 0
                ]);
            }
        }
        return redirect('/other/products')->with('massage', 'Product added success!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $ProductId = $product->id;
        // $product_color = $ProductId->productColors->pluck('color_id')->toArray();
        $product_color = $product->productColors->pluck('color_id')->toArray();
        $data = [
            'categories' => Category::all(),
            'brands' => Brand::all(),
            'product' => $product,
            'product_color' => $product->productColors->pluck('color_id')->toArray(),
            'colors' => Color::whereNOtIn('id', $product_color)->get(),
        ];
        return view('Admin.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();
        // $pro = Category::findOrFail($validatedData['category_id'])->products()->where('id',$product->id)->first();
        if ($product) {
            $product->update([
                'category_id' => $validatedData['category_id'],
                'name' => $validatedData['name'],
                'slug' => Str::slug($validatedData['slug']),
                'brand' => $validatedData['brand'],
                'small_description' => $validatedData['small_description'],
                'description' => $validatedData['description'],
                'original_price' => $validatedData['original_price'],
                'selling_price' => $validatedData['selling_price'],
                'quantity' => $validatedData['quantity'],
                'trending' => $request->trending == true ? '1' : '0',
                'status' => $request->status == true ? '1' : '0',
                'meta_title' => $validatedData['meta_title'],
                'meta_keyword' => $validatedData['meta_keyword'],
                'meta_description' => $validatedData['meta_description'],
            ]);

            if ($request->hasFile('image')) {
                $uploadPath = 'upload/products/';
                $i = 1;
                foreach ($request->file('image') as $imageFile) {
                    $ext = $imageFile->getClientOriginalExtension();
                    $filename = time() . $i++ . '.' . $ext;
                    $imageFile->move($uploadPath, $filename);
                    $finalImagePathName = $uploadPath . '' . $filename;

                    $product->productImages()->create([
                        'product_id' => $product->id,
                        'image' => $finalImagePathName,
                    ]);
                }
            }
            return redirect('/other/products')->with('massage', 'Product Update success!!');
        } else {
            return redirect('/other/products')->with('massage', 'No such Product Id Found!!');
        }
    }


    public function destroyImage($product_image_id)
    {
        $productImage = ProductImage::findOrFail($product_image_id);
        if (File::exists($productImage->image)) {
            File::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message', 'Product Image Deleted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        $product = product::findOrFail($product_id);
        if ($product->productImages) {
            foreach ($product->productImages() as $image) {
                if (File::exists($image->image)) {
                    File::delete($image->$image);
                }
            }
        }
        $product->delete();
        return redirect()->back()->with('message', 'Product Deleted With All Its Image!!');
    }

    public function updateProductColorQty(Request $request, $prod_color_id)
    {
        $productColorData = Product::findOrFail($request->product_id)->productColors()->where('id',$prod_color_id)->first();
        $productColorData->update([
            'quantity' => $request->qty
        ]);
        return response()->json(['message' => 'Product Color Qty update']);
    }
    public function destroyProductColor($prod_color_id){
        $productColor = ProductColor::findOrFail($prod_color_id);
        $productColor->delete();
        return response()->json(['message' => 'Product Color Delete']);
    }
}
