<?php

namespace App\Jobs\CoinbaseWebhooks;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\CoinbaseWebhookCall;
use Illuminate\Support\Facades\Mail;
use App\Repositories\Contract\{
    IUser,
    IOrder,
    ISubscripe
};

class HandleCreatedCharge implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

     public $webhookCall;
     
    public function __construct(CoinbaseWebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    
    public function handle()
    {
        $payload = json_decode($this->webhookCall->payload,true);
        
        $userData=json_decode($payload['metadata'],true);
        $order_id=$userData['order_id'];

       $webhook = app()->make(ISubscripe::class)->find($order_id);
       $order = app()->make(IOrder::class)->find($order_id);
       $order->delete();
       $now= \Carbon\Carbon::now();
       $end=$now->addMonth()->format('Y-m-d H:i:s'); 
       $webhook->update([
           'end_at'=>$end
       ]);
       $user= $order = app()->make(IUser::class)->find(auth()->user()->id);
        $Message = 'Thanks for your purchase. Your payment of $'.$payload .'has been successfully completed.';
        Mail::to($user->email)->send(new \App\Mail\SendMail($Message));
       
    }
}
