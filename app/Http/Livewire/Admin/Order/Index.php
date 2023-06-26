<?php

namespace App\Http\Livewire\Admin\Order;

use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contract\IOrder;
use App\Traits\Translate;
use \App\Helper\facade\GetApi;
use App\Models\{
    Order
};
use Carbon\Carbon;

class Index extends Component {

    use WithPagination;
    use Translate;

    protected $paginationTheme = 'bootstrap';
    public $multiLanguage = false;
        public $readyToLoad = false;
    public $search;
    public $mulitiSelect = [];
    public $count_data = 10;
    protected $queryString = ['search'];
    public $IdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    public $SelectPage = false;
    public $typePage = 'roles';

    public function mount() {

        $NotComplateOrders = Order::where('status', 'pending')->get();

        foreach ($NotComplateOrders as $item) {
            $meta = json_decode($item->payload, true);
            if(isset($meta['data']['pricing']['local']['amount'])){
            $amountPay = $meta['data']['pricing']['local']['amount'];
            $amount = $item->price;
            $charge_id = $meta['data']['code'];
            $method = 'charges/' . $charge_id;
            $response = GetApi::get_result($method);
            if ($response) {
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
        }
        }
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

        $orders = Order::where('status','success')
                ->where('code', 'LIKE', "%{$this->search}%")
                ->paginate(12);
        return view('livewire.admin.order.index', compact('orders'))->layout('layouts.admin');
    }

}
