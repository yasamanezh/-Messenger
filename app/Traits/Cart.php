<?php

namespace App\Traits;

use App\Repositories\Contract\{
    IPack,
    IOrder,
    ISubscripe
};
use App\Models\Order;
use Carbon\Carbon;
use App\Helper\facade\GetApi;

trait Cart {

    public function addToCart($id) {

        $this->subError = false;
        $this->packError = false;
        if (!auth()->user()) {
            return redirect(route('login'));
        }

        $pack = app()->make(IPack::class)->findEnable($id);
        $order = Order::where('pack_id', $pack->id)->where('status', 'pending')->first();



        if (!$pack) {
            return $this->packError = true;
        }
        $data = [
            'user_id' => auth()->user()->id,
            'status' => 'pending',
            'pack_title' => $pack->customTranslate('en')->title,
            'end_at' => '1',
            'pack_id' => $id
        ];

        if ($order) {
            $payload = json_decode($order->payload, true);
            if (isset($payload['data']['timeline'])) {
                
                $timelines = $payload['data']['timeline'];
                $status = 'pending';

                foreach ($timelines as $timelines) {
                    if ($timelines['status'] == 'EXPIRED') {
                        $status = 'cancell';
                        $order->status = 'cancell';
                        $order->save();
                    }
                }
                
                
                if ($status == 'pending') {
                    return redirect(route('front.checkout',$order->id));
                    
                }
               
            }else{
                return redirect(route('front.checkout',$order->id));
            }
        }

        $order_id =app()->make(IOrder::class)->create($data);
     
            return redirect(route('front.checkout', $order_id));
       
    }

}
