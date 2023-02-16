<div>
     @section('title',__('Tickets'))
    <livewire:front.layout.menu :lang="$multiLanguage">
        <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{__('Tickets')}}</h2>
                    <ul>
                        <li><a href="{{$multiLanguage ? route('front.home.language',app()->getlocale()) : route('front.home')}}">{{__('Home')}}</a></li>
                        <li>{{__('Tickets')}}</li>
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
                                <h3 class="title">
                                    <a href="{{$multiLanguage ? route('front.ticket.add.language',['language'=>app()->getLocale()]) : route('front.ticket.add')}}"  class="default-btn"><i class='bx bx-paper-plane'></i>Create New Ticket</a>
                                </h3>
                                <div class="payment-box">
                                    <div class="table-responsive scrollbar" id="style-1" >
                                        <table class="table dataTable no-footer dtr-inline " id="example2"
                                               role="grid" aria-describedby="example2_info">
                                            <thead >
                                                <tr>
                                                    <th class="wd-lg-20p"> <span>{{__('create date')}}</span> </th>
                                                    <th class="wd-lg-20p"> <span>{{__('subject')}}</span> </th>
                                                    <th class="wd-lg-20p"> <span>{{__('part')}}</span> </th>
                                                    <th scope="col">{{__('latest update')}}</th>
                                                    <th scope="col">{{__('status')}}</th>
                                                    <th scope="col">{{__('operation')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($tickets as $ticket)
                                                <tr>
                                                    <td>{{ $ticket->created_at }}</td>
                                                    <td>{{$ticket->title}}</td>
                                                    <td> @if(\App\Models\Part::find($ticket->part))
                                                        {{$this->getTranslate('title',\App\Models\Part::find($ticket->part))}}
                                                        @endif
                                                    </td>
                                                    <td>{{ $ticket->updated_at}}</td>
                                                    <td>{{$this->status($ticket->id)}}</td>

                                                    <td>
                                                        <a href="{{$multiLanguage ? route('front.ticket.edit.language',['language'=>app()->getLocale(),'id'=>$ticket->id]) : route('front.ticket.edit',$ticket->id)}}"  class="btn btn-sm btn-info">
                                                            <i class="fa fa-eye text-white"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{$tickets->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <livewire:front.layout.footer :language="$multiLanguage">

</div>