<div>
     @section('title',__('Orders'))
    <livewire:front.layout.menu :lang="$multiLanguage">
        <!-- Start Page Title Area -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>{{__('Orders')}}</h2>
                <ul>
                    <li><a href="{{$multiLanguage ? route('front.home.language',app()->getlocale()) : route('front.home')}}">{{__('Home')}}</a></li>
                    <li>{{__('Orders')}}</li>
                </ul>
            </div>
        </div>
        <div class="divider"></div>
        <div class="lines">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
            <div class="banner-shape1"><img src="{{asset('front/ltr/assets/img/shape/shape9.png')}}" alt="{{__('Tickets')}}"></div>
        </div>
        <!-- End Page Title Area -->

        <div class="checkout-area ptb-100">
            <div class="container">
                <form>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="order-details">
                                
                                <div class="payment-box">
                                    <div class="table-responsive scrollbar" id="style-1" >
                                        <table class="table dataTable no-footer dtr-inline " id="example2"
                                               role="grid" aria-describedby="example2_info">
                                            <thead >
                                                <tr>
                                                    <th class="wd-lg-20p"> <span>{{__('Create date')}}</span> </th>
                                                    <th class="wd-lg-20p"> <span>{{__('Subject')}}</span> </th>
                                                    <th class="wd-lg-20p"> <span>{{__('Code')}}</span> </th>
                                                    <th class="wd-lg-20p"> <span>{{__('Price')}}</span> </th>
                                                    <th scope="col">{{__('Expiration date')}}</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                <tr>
                                                    <td>{{ $order->created_at }}</td>
                                                    <td>{{$order->pack_title}}</td>
                                                    <td>$ {{$order->code}}</td>
                                                    <td>$ {{$order->price}}</td>
                                                    <td>{{ $order->end_at}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{$orders->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <livewire:front.layout.footer :language="$multiLanguage">
</div>