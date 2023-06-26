<?php

namespace App\Http\Livewire\Front\Checkout;

use Livewire\Component;
use Illuminate\Http\Request; 
class Error extends Component
{
    public function mount(Request $request) {
        
        dd($request->all());
        
    }
    
    public function render()
    {
        return view('livewire.front.checkout.error');
    }
}
