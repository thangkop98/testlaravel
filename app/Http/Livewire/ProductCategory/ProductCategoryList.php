<?php

namespace App\Http\Livewire\ProductCategory;

use App\Models\ProductCategory;
use Livewire\Component;
use App\Http\Livewire\Base\BaseLive;

class ProductCategoryList extends BaseLive
{
    public $searchTerm;
    public $name;
    public $slug;
    public $description;
    public $category_id;
    public $status;
    public $updateMode = false;
    public $iteration;
    public $deleted_id;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['saveData'];

    protected $rules = [
        'name' => 'required|min:6',
        'slug' => 'required',
        'description' => 'nullable|max:250',
        'status' => 'nullable'
    ];

    public function render()
    {
        $query = ProductCategory::query();
        if($this->searchTerm)
        {
            $query = $query->where('name','like','%'.$this->searchTerm.'%')
            ->orwhere('slug','like','%'.$this->searchTerm.'%')
            ;
        }

        $getListCategories = $query->orderBy('created_at','desc')->paginate($this->perPage);
        return view('livewire.product-category.product-category-list',[
            'data' => $getListCategories
        ]);
    }

    public function resetSearch()
    {
        $this->searchTerm = "";
    }

    public function openCreateModal()
    {
        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function closeModal()
    {
        $this->resetInputFields();
        $this->iteration++;
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
            $validateData['description'] = $this->description;
            $validateData['slug'] = $this->slug;
            $validateData['status'] = $this->status;

            ProductCategory::create($validateData);
    
            session()->flash('message', 'Tạo mới danh mục sản phẩm thành công');
            $this->resetInputFields();
        }
        else{
            ProductCategory::where('id',$this->category_id)->update([
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
                'status' => $this->status
            ]);

            
            session()->flash('message', 'Chỉnh sửa danh mục sản phẩm thành công');
            $this->resetInputFields();
        }

        $this->emit('close-edit-modal');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $this->category_id = $id;
        $editCategory = ProductCategory::findOrFail($this->category_id);

        if($editCategory)
        {

            $this->name = $editCategory->name;
            $this->slug = $editCategory->slug;
            $this->description = $editCategory->description;
            $this->status = $editCategory->status;
        }

    }

    public function deletedId($id)
    {
        $this->deleted_id = $id;
    }

    public function delete()
    {
        try {
            $deleteCategory = ProductCategory::find($this->deleted_id);
            $deleteCategory->delete();
    
            $this->emit('close-delete-modal');
        
            session()->flash('message', 'Xóa danh mục thành công');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function openModalChangeStatus()
    {
        
    }
    
}
