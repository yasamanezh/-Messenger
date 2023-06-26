<?php

namespace App\Http\Livewire\Front\Order;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\IOrder;
use App\Traits\Translate;
use App\Helper\facade\GetApi;
use App\Models\{
    User,
    Order
};
use Carbon\Carbon;

class Index extends Component {

    use WithPagination;
    use Translate;

    protected $paginationTheme = 'bootstrap';
    public $multiLanguage = false;

    public function mount($language = null) {
        $language ? $this->multiLanguage = true : $this->multiLanguage = false;
        $user = auth()->user();
        $NotComplateOrders = Order::where('user_id', $user->id)->where('status', 'pending')->get();


        foreach ($NotComplateOrders as $item) {
            $meta = json_decode($item->payload, true);
			
			if(isset($meta['data']['code'])){
            
            $charge_id = $meta['data']['code'];
            $method = 'charges/' . $charge_id;
            $response = GetApi::get_result($method);
            if ($response) {
                $amountPay = $response['data']['pricing']['local']['amount'];
                $amount = $item->price;
                if (!empty($response['data']['payments'])) {
                    if ($amountPay == $amount) {
                        $item->status = 'success';
                        $item->end_at = $response['data']['created_at']->addMonth()->format('Y-m-d H:i:s');
                    } else{
                        $item->status = 'notcomplate';
                    }
                    $item->payload = json_encode($response);
                    $item->save();
                }
            }
        
		}}
    }

    public function status($id) {
        $nown = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $order = app()->make(IOrder::class)->find($id);
        if ($order->end_at < $nown) {
            return 'exired';
        } else {
            return $order->end_at;
        }
    }

    public function render() {

        $orders = Order::where('user_id', auth()->user()->id)->where('status','success')
               
                ->paginate(12);

        return view('livewire.front.order.index', compact('orders'));
    }

}
