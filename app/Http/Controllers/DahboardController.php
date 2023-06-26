<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contract\{
    IPack,
    IOrder,
    ISubscripe
};
use Illuminate\Support\Facades\Mail;
use App\Models\{Order,Pack};
use App\Helper\facade\GetApi;
use Carbon\Carbon;

class DahboardController extends Controller {

    public function index() {

        $user = auth()->user()->role;
        if ($user == 'user') {
            return redirect(route('front.home'));
        } else {
            return redirect(route('Dashboard'));
        }
    }

    public function test(Request $request) {

        // \Illuminate\Support\Facades\Artisan::call('down --secret="demo"');
    }

    public function addToOrder($order) {

        $this->subError = false;
        $this->packError = false;
    
        if (!auth()->user()) {
            return redirect(route('login'));
        }

        if (!$order) {
            return redirect(route('front.home'));
        }

        $pack = app()->make(IPack::class)->findEnable($order->pack_id);
        
        if (!$pack) {
            return $this->packError = true;
        }
 
       
    }

   

    public function checkout2($id) {
        $order = Order::find($id);

        $this->addToOrder($order);
        
        $pack = app()->make(IPack::class)->findEnable($order->pack_id);

//اگر رایگان بود
        if ($pack->is_free == 1) {
            $order->status = 'success';
            $order->end_at = Carbon::now()->addMonth()->format('Y-m-d H:i:s');
            $order->payload = json_encode(['data' => 'free']);
            $order->pack_title = $pack->customTranslate('en')->title;
            $order->price = 0;
            $order->save();
            return redirect(route('front.order.language', app()->getlocale()));
        }

        if ($order) {
            $payload = json_decode($order->payload, true);
            if (isset($payload['data']['timeline'])) {
                $timelines = $payload['data']['timeline'];
                $status = 'pending';
                $charge_id = $payload['data']['code'];
                $method = 'charges/' . $charge_id;
                $response = GetApi::get_result($method);
                if ($response) {
                    $amountPay = $response['data']['pricing']['local']['amount'];
                    $amount = $pack->price;
                    if (!empty($response['data']['payments'])) {
                        if ($amountPay == $amount) {
                            $status = 'success';
                            $order->status = 'success';
                            $order->end_at = $response['data']['created_at']->addMonth()->format('Y-m-d H:i:s');
                        } else {
                            $status = 'success';
                            $order->status = 'notcomplate';
                        }
                        $order->payload = json_encode($response);
                        $order->save();
                    }
                       $Newtimelines = $response['data']['timeline'];
                      foreach ($Newtimelines as $timelines) {
                    if ($timelines['status'] == 'EXPIRED') {
                        $status = 'cancell';
                        $order->status = 'cancell';
                        $order->save();
                    }
                }
                    
                }

                foreach ($timelines as $timeline) {
                    if ($timeline['status'] == 'EXPIRED') {
                        $status = 'cancell';
                        $order->status = 'cancell';
                        $order->save();
                    }
                }
                if ($status == 'pending') {
                    if ($this->multiLanguage) {
                        return redirect(route('front.checkout.language', app()->getlocale()));
                    } else {
                        return redirect(route('front.checkout'));
                    }
                }
            } 
                $method = 'charges';
                $post = '';
                $post = array(
                    "name" => $pack->customTranslate('en')->title,
                    "description" => $pack->customTranslate('en')->title,
                    "local_price" => array(
                        'amount' => $pack->price,
                        'currency' => 'USD'
                    ),
                    "pricing_type" => "fixed_price",
                    "metadata" => array(
                        'customer_id' => auth()->user()->id,
                        'name' => auth()->user()->name,
                        'order_id' => $order->id
                    ),
  
                );

                $response = GetApi::get_result($method, $post);

                if ($response) {
                    $order->payload = json_encode($response);
                    $order->price = $pack->price;
                    $order->status = 'pending';
                    $order->code = $response['data']['code'];
                    $order->pack_title = $pack->customTranslate('en')->title;
                    $order->save();
                    return redirect($response['data']['hosted_url']);
                };
            
        }
    }

}
