<?php

namespace App\Http\Livewire\Product;

use App\Http\Livewire\Base\BaseLive;
use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductList extends BaseLive
{

    use WithFileUploads;

    public $searchTerm;
    public $name;
    public $code;
    public $parent_id;
    public $category_id;
    public $price;
    public $discount_price;
    public $image;
    public $description;
    public $status;
    public $product_id;
    public $oldImage;
    public $iteration;
    public $updateMode = false;


    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['saveData'];

    protected $rules = [
        'name' => 'required|min:6',
        // 'code' => 'required',
        'parent_id' => 'nullable',
        'category_id' => 'nullable',
        'price' => 'required|numeric',
        'discount_price'=> 'nullable|numeric',
        'image' => 'image|max:1024',
        'description' => 'nullable|max:5000',
        'status' => 'nullable'
    ];

    public function render()
    {
        $query = Product::query();
        if($this->searchTerm)
        {
            $query = $query->where('name','like','%'.$this->searchTerm.'%')
            ->orwhere('code','like','%'.$this->searchTerm.'%')
            ;
        }
        $listCategories = ProductCategory::query()->get();
        $getListProducts = $query->orderBy('created_at','desc')->paginate($this->perPage);
        return view('livewire.product.product-list',['data' => $getListProducts,'listCategories' => $listCategories]);
    }

    public function resetSearch()
    {
        $this->search = "";
    }

    public function resetInputFields()
    {
         $this->reset();
    }

    public function saveData()
    {
        
        if($this->updateMode == false)
        {
            $validateData = $this->validate();
            $validateData['name'] = $this->name;
            $validateData['code'] = $this->code;
            $validateData['parent_id'] = $this->parent_id;
            $validateData['category_id'] = $this->category_id;
            $validateData['price'] = $this->price;
            $validateData['discount_price'] = $this->discount_price;
            $validateData['image'] = $this->image->store('public');
            $validateData['description'] = $this->description;
            $validateData['status'] = $this->status;

            // dd($validateData);
            Product::create($validateData);
    
            session()->flash('message', 'Tạo mới sản phẩm thành công');
            $this->resetInputFields();
        }
        else{
            Product::where('id',$this->product_id)->update([
                'name' => $this->name,
                'code' => $this->code,
                'parent_id' => $this->parent_id,
                'category_id' => $this->category_id,
                'price' => $this->price,
                'discount_price' => $this->discount_price,
                'image' => $this->image ? $this->image->store('public') : $this->oldImage,
                'description' => $this->description,
                'status' => $this->status
            ]);

            
            session()->flash('message', 'Chỉnh sửa sản phẩm thành công');
            $this->resetInputFields();
        }

        $this->emit('close-edit-modal');
    }

    public function edit($product_id)
    {
        $this->updateMode = true;
        $getProduct = Product::findOrFail($product_id);
        if($getProduct)
        {
            $this->product_id = $getProduct->id;
            $this->name = $getProduct->name;
            $this->code = $getProduct->code;
            $this->parent_id = $getProduct->parent_id;
            $this->category_id = $getProduct->category_id;
            $this->price = $getProduct->price;
            $this->discount_price = $getProduct->discount_price;
            $this->description = $getProduct->description;
            $this->oldImage = $getProduct->image;
            $this->status = $getProduct->status;
        }
        else{
            return redirect()->route('product');
        }
    }

    public function closeModal()
    {
        $this->resetInputFields();
        $this->image = null;
        $this->iteration++;
    }

    public function openCreateModal()
    {
        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function deleteId($id)
    {
        $this->deleted_id = $id;
    }

    public function delete()
    {
        try {
            $deletedUser = User::find($this->deleted_id);
    
            $deletedUser->delete();
    
            $this->emit('close-delete-modal');
    
            session()->flash('message', 'Xóa người dùng thành công');
        } catch (\Throwable $th) {
            session()->flash('message', 'Xóa người dùng thất bại');
        }
    }
}
