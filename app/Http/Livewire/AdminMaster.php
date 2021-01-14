<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminMaster extends Component
{
    public function render()
    {
        return view('livewire.admin-master');
    }

    public function admin()
    {
        return view('livewire.admin-master');
    }

    public function categories()
    {
        return redirect()->to('/admin/categories/0');
    }
}
