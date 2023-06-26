
<div>
<livewire:front.layout.menu :lang="$multiLanguage">
    <!-- Start Page Title Area -->
    <div class="page-title-area">
        <div class="container">
            <div class="page-title-content">
                <h2>{{__('Checkout')}}</h2>
                <ul>
                    <li><a href="{{$multiLanguage ? route('front.home.language',app()->getlocale()) : route('front.home')}}">{{__('Home')}}</a></li>
                    <li>{{__('Checkout')}}</li>
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
        <div class="banner-shape1">
            <img src="{{asset('front/ltr/assets/img/shape/shape9.png')}}" ></div>
    </div>
   
    <div class="checkout-area ptb-100">
            <div class="container">
                <form role="form" action="{{$multiLanguage ? route('front.checkout2.language',app()->getlocale()) : route('front.checkout2')}}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="billing-details">
                                <h3 class="title">{{__('Your Order')}}</h3>
                                <div class="order-table table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="product-name"><a href="products-details.html">Laptop Blue Background</a></td>
                                                <td class="product-total">
                                                    <span class="subtotal-amount">$250.00</span>
                                                </td>
                                            </tr>
                                           
                                            <tr>
                                                <td class="total-price"><span>Order Total</span></td>
                                                <td class="product-subtotal">
                                                    <span class="subtotal-amount">$750.00</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="order-details">
                                <h3 class="title">{{__('Payment')}}</h3>
                                
                                <div class="payment-box">
                                    <div class="payment-method">
                                        <p>
                                            <input type="radio" id="direct-bank-transfer" name="radio-group" checked="">
                                            <label for="direct-bank-transfer">{{__('CryptoCurrancy')}}</label>
                                        </p>
                                        
                                    </div>
                                    <button type="submit" class="default-btn"><i class="bx bx-paper-plane"></i> {{__('Place Order')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
<livewire:front.layout.footer :language="$multiLanguage">
</div>

