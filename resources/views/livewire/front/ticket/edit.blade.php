
<div >
     @section('title',__('view ticket'))
    <livewire:front.layout.menu :lang="$multiLanguage">
        <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{__('view ticket')}}</h2>
                    <ul>
                        <li><a href="{{$multiLanguage ? route('front.home.language',app()->getlocale()) : route('front.home')}}">{{__('Home')}}</a></li>
                        <li>{{__('view ticket')}}</li>
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
            <div class="banner-shape1"><img src="{{asset('front/ltr/assets/img/shape/shape9.png')}}" alt="{{__('view ticket')}}"></div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Checkout Area -->
        <div class="checkout-area ptb-100">
            <div class="container">

                @include('livewire.admin.layouts.error')
                @if($success)
                <div class="alert alert-success">
                    <ul>
                        <li>{{__('success')}}</li>
                    </ul>
                </div>
                @endif
                <form>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="order-details">
                                <h3 class="title">{{__('Answer')}}</h3>

                                <div class="user-actions">

                                    <div class="row p-1 bg-light">
                                        <div class="col-lg-3 col-md-3 col-xs-6">
                                            <div class="row center">
                                                <strong>{{__('create date')}}:</strong>{{$ticket->created_at->format('d M  ,Y h:i A')}}
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-xs-6">
                                            <div class="row center">
                                                <strong>{{__('latest update')}}:</strong>{{$ticket->updated_at->format('d M  ,Y h:i A')}}
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-xs-6">
                                            <div class="row center">
                                                <strong>{{__('subject')}}:</strong><span style="color:#888888">{{$ticket->title}}</span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-3 col-xs-6">
                                            <div class="row center">
                                                <strong>{{__('part')}}:</strong>
                                                @if(\App\Models\Part::find($ticket->part))
                                                {{$this->getTranslate('title',\App\Models\Part::find($ticket->part))}}
                                                @endif
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="payment-box">
                                    <div class="payment-method">
                                        <div class="form-group">
                                            <label for="inputMessage"> {{__('message')}}</label>
                                            <textarea wire:model.defer="message" id="inputMessage" rows="12" class="form-control"></textarea>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 mt-2 mb-2">
                                                <label for="inputAttachments">{{__('attachments')}}</label>

                                            </div>
                                            
                                            <br>
                                            <div  class="col-sm-12" >
                                                <div  class="row" >
                                                    @foreach($inputdownload as $key => $value)
                                                    <div class="col-sm-6">
                                                        <input type="file" class="form-control" wire:model="download_file.{{ $key }}" style="padding: 14px 20px;" >
                                                        <br>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <button class=" bbtn ripple btn-secondary text-white btn-icon btn-sm mt-2"
                                                                wire:click.prevent="removeDownload({{$key}})">
                                                            <i class="fa fa-minus-circle"></i></button><br>
                                                    </div>

                                                    @endforeach
                                                    <div class=" add-input">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <button class="btn ripple btn-primary text-white btn-icon btn-xs"
                                                                        wire:click.prevent="AddDownload({{$l}})"><i
                                                                        class="fa fa-plus-circle"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                        </div>
                                    </div>
                                    <div  wire:loading wire:target="saveInfo"  class="spinner-border text-danger" role="status">
                                        <span class="visually-hidden">{{__('Loading')}}...</span>
                                    </div>
                                    <button wire:click.prevent="saveInfo()" class="default-btn"><i class='bx bx-paper-plane'></i>{{__('Send')}}</button>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        @include('livewire.admin.layouts.error')
                                        @if($success)
                                        <div class="alert alert-success">
                                            <ul>
                                                <li>{{$success}}</li>
                                            </ul>
                                        </div>
                                        @endif
                                        <div class="card-body">
                                            <div class="profile-stats">
                                                <div class="profile-stats-row">
                                                    <div class="profile-stats page-profile-order">
                                                        <div class="table-orders">
                                                            @foreach($ticket->answers()->orderBy('created_at','DESC')->get() as $answer)
                                                            <div class="{{$answer->user->role != 'user' ? 'user-actions' :''}}">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        {{$answer->user->name}}
                                                                        <br>
                                                                        {{$answer->user->role}}
                                                                        <i class="fa fa-user"></i>
                                                                    </div>
                                                                    <div class="col-10">
                                                                        {{$answer->answer}}
                                                                    </div>
                                                                </div>
                                                                <br>

                                                                @if($answer->attach)
                                                                @foreach($answer->attach as $file )
                                                                <a   href="/storage/{{$file->file}}">{{  explode('/', $file->file)[2]}}</a>
                                                                @endforeach
                                                                @endif
                                                            </div>

                                                            @endforeach
                                                            <div class="ticket-body">
                                                                <div class="col-lg-12 col-md-8 col-xs-12">
                                                                    <div class="article box1 p">
                                                                        <div class="header pull-right">
                                                                            <div>
                                                                                {{$ticket->user->name}}
                                                                            </div>
                                                                        </div>
                                                                        <br>
                                                                        <div class="pull-right body">
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <label class="form-label">{{__('title')}}:</label>
                                                                                    <div  class="form-control">{{$ticket->title}}</div>
                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <label class="form-label">{{__('part')}}:</label>
                                                                                    @if(\App\Models\Part::find($ticket->part))
                                                                                    <div  class="form-control">{{\App\Models\Part::find($ticket->part)->currentTranslate()->title}}</div>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <div class="form-control mt-2">
                                                                                        {{$ticket->description}}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <br>

                                                                            @if($ticket->attach)
                                                                            @foreach($ticket->attach()->get() as $file )
                                                                            <a  href="/storage/{{$file->file}}">{{  explode('/', $file->file)[2]}}</a>
                                                                            @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <livewire:front.layout.footer :language="$multiLanguage">


            <style>
                .box1{
                    border: 1px solid #eee;


                    display: block;
                    float: right;
                    width: 100%;
                }
                .box1 .header{
                    display: block;
                    width: 100%;
                    background: aliceblue;
                    padding:15px 20px;
                }

                .header2{
                    display: block;
                    width: 100%;
                    background: blue;
                    padding:15px 20px; 
                }

                .box1 .body{
                    display: block;
                    width: 100%;
                    padding: 20px;
                }
                .ticket-body{
                    display: block;
                    width: 100%;
                    height: 100%;
                    float: right;

                }
            </style>
</div>



