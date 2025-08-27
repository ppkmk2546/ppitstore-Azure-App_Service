<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class AdminEditProductComponent extends Component
{
    use WithFileUploads;
    public $image;
    public $name;
    public $short_description;
    public $description;
    public $slug;
    public $regular_price;
    public $sale_price;
    public $SKU;
    public $featured;
    public $quantity;
    public $category_id;
    public $newimage;
    public $product_id;
    public $images;
    public $newimages;
    public $scategory_id;

    public function mount($product_slug)
    {
        $product = Product::where('slug',$product_slug)->first();
        $this->image = $product->image;
        $this->name = $product->name;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->slug = $product->slug;
        $this->regular_price = $product->regular_price;
        $this->sale_price = $product->sale_price;
        $this->SKU = $product->SKU;
        $this->featured = $product->featured;
        $this->quantity = $product->quantity;
        $this->category_id = $product->category_id;
        $this->scategory_id = $product->subcategory_id;
        // $this->newimage = $product->newimage;
        $this->images = explode(",",$product->images);
        $this->product_id = $product->id;
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name,'-');
    }

    public  function updated($fields)
    {
        $this->validateOnly($fields, [
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'SKU' => 'required',
            'quantity' => 'required|numeric',
            'category_id' => 'required'
        ]);
        if($this->newimage)
        {
            $this->validateOnly($fields, [
                'newimage' => 'required|mimes:jpeg,png,jpg'
            ]);
        }
    }

    public function updateProduct()
    {
        $this->validate([
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'SKU' => 'required',
            'quantity' => 'required|numeric',
            'category_id' => 'required'
        ]);
        if($this->newimage)
        {
            $this->validateOnly([
                'newimage' => 'required|mimes:jpeg,png,jpg'
            ]);
        }

        $product = Product::find($this->product_id);
        if($this->newimage)
        {
            unlink('assets/images/products'.'/'.$product->image);
            $imageName = Carbon::now()->timestamp. '.' . $this->image->extension();
            $this->image->storeAs('products',$imageName);
            $product->image = $imageName;
        }
        $product->name = $this->name;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->slug = $this->slug;
        $product->regular_price = $this->regular_price;
        $product->sale_price = $this->sale_price;
        $product->SKU = $this->SKU;
        $product->featured = $this->featured;
        $product->quantity = $this->quantity;

        if($this->newimages)
        {
            if($product->images)
            {
                $images = explode(",",$product->images);
                foreach($images as $image)
                {
                    if($image)
                    {
                        unlink('assets/images/products'.'/'.$image);
                    }
                }
            }

            $imagesname ='';
            foreach($this->newimages as $key=>$image)
            {
                $imgName = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $image->storeAs('products',$imgName);
                $imagesname = $imagesname .',' . $imgName;

            }
            $product->images = $imagesname;
        }
        $product->category_id = $this->category_id;
        if($this->scategory_id)
        {
            $product->subcategory_id = $this->scategory_id;
        }
        $product->save();
        session()->flash('message','Product has been updated successfully!');
    }

    public function changeSubcategory()
    {
        $this->scategory_id = 0;
    }

    public function render()
    {
        $categories = Category::all();
        $scategories = Subcategory::where('category_id',$this->category_id)->get();
        return view('livewire.admin.admin-edit-product-component',['categories'=>$categories,'scategories'=>$scategories])->layout('layouts.admin-dash');
    }
}
