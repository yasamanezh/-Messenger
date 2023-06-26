<?php

namespace App\Http\Livewire\Front\Order;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\ISubscripe;
use App\Traits\Translate;
use App\Helper\facade\GetApi;
use App\Models\{
    User,
    Order,
    Pack
};
use Carbon\Carbon;

class Checkout extends Component {

    use WithPagination;
    use Translate;

    protected $paginationTheme = 'bootstrap';
    public $multiLanguage = false;
    public $order;

    public function mount($id) {
       
        $user = auth()->user();
        $this->order = Order::where('user_id',$user->id)->findOrFail($id);
    }

 
    public function render() {

       
        $pack  =Pack::find($this->order->pack_id);

        return view('livewire.front.order.checkout', compact('pack'));
    }

}
