<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Support\Collection;

class ProductSearch extends Component
{
    public $search = "";

    public function render()
    {
        // Initialize as an empty collection to avoid errors
        $results = collect();

        // Search logic only when input length is 1 or more characters
        if (strlen($this->search) >= 1) {
            $results = Product::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('category', 'like', '%' . $this->search . '%') // Add condition for category
            ->limit(5)
            ->get();
        }

        return view('livewire.product-search', ['products' => $results]);
    }
}




    // public $searchTerm = '';

    // protected $queryString = ['searchTerm'];

    // public function updatedSearchTerm()
    // {
    //     $this->resetPage(); // Reset pagination when search term changes
    // }

    // public function render()
    // {
    //     $products = Product::query()
    //         ->when(!empty($this->searchTerm), function ($query) {
    //             $query->where('name', 'like', '%' . $this->searchTerm . '%')
    //                 ->orWhere('description', 'like', '%' . $this->searchTerm . '%')
    //                 ->orWhere('brand', 'like', '%' . $this->searchTerm . '%')
    //                 ->orWhere('category', 'like', '%' . $this->searchTerm . '%');
    //         })
    //         ->paginate(9);

    //     return view('livewire.product-search', ['products' => $products]);
    // }

