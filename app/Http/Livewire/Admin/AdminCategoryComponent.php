<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{

    use WithPagination;

    public function thorwdelete()
    {
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        session()->flash('message', 'Category has been deleted successfully!');
        $this->dispatchBrowserEvent('hide-delete-modal');
    }

    public function thorwsubdelete()
    {
        $this->dispatchBrowserEvent('show-subdelete-modal');
    }

    public function deleteSubcategory($id)
    {
        $scategory = Subcategory::find($id);
        $scategory->delete();
        session()->flash('message', 'Subcategory has been deleted successfully!');
        $this->dispatchBrowserEvent('hide-subdelete-modal');
    }

    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.admin-category-component',['categories'=>$categories])->layout('layouts.admin-dash');
    }
}
