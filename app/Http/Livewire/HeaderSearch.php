<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class HeaderSearch extends Component
{
    public $search;
    public $category_name;

    public function mount()
    {
        $this->category_name = 'All Categories';
    }

    public function products()
    {
        $search = '%' . $this->search . '%';
        if (strlen($this->search) > 0) {
            return Product::where('name', 'like', $search)->get();
        } else {
            return Product::all();
        }
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.header-search', [
            'categories' => $categories,
            // 'products' => $this->products()
        ]);
    }
}
