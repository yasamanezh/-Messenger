@section('title','Edit Ticket')
<div class="container-fluid">
    <style>
        .box1{
            border: 1px solid #eee;

            text-align: right;
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
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">edit ticket</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.tickets')}}">ticketd</a></li>
                    <li class="breadcrumb-item active" aria-current="page">edit ticket</li>
                </ol>
            </div>
            <div>
                <button  wire:click.prevent="saveInfo" class="btn btn-primary my-2 btn-icon-text" type="submit"
                         wire:loading.attr="disabled" wire:loading.remove>save
                </button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('admin.tickets')}}" class="btn btn-warning text-white"
                   data-original-title="back">
                    <i class="fa fa-backward"></i>
                </a>
            </div>
        </div>
       
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        edit ticket
                    </div>
                    <div class="card-body">
                        <div class="profile-stats">
                            <div class="profile-stats-row">
                                <div class="profile-stats page-profile-order">
                                    <div class="table-orders">
                                        <button wire:ignore class="btn btn-primary pull-right" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            answer
                                        </button>
                                        <br>
                                        <br>
                                        <div wire:ignore.self class="collapse" id="collapseExample" >
                                            <div class="form-group">
                                                <label for="inputMessage"> message</label>
                                                <textarea wire:model.defer="description" id="inputMessage" rows="12" class="form-control"></textarea>
                                                @error('description')
                                                <div class="invalid-feedback display-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="inputAttachments">attachments</label>
                                                </div>
                                                <br>
                                                <div  class="col-sm-12" >
                                                    <div  class="row" >
                                                        @foreach($inputdownload as $key => $value)
                                                        <div class="col-sm-6">
                                                            <input type="file" class="form-control" wire:model="download_file.{{ $key }}" >
                                                            <br>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <button class=" bbtn ripple btn-secondary text-white btn-icon btn-sm"
                                                                    wire:click.prevent="removeDownload({{$key}})">
                                                                <i class="fa fa-minus-circle"></i></button><br>
                                                        </div>

                                                        @endforeach
                                                        <div class=" add-input">
                                                            <div class="row">
                                                                <div class="col-md-12 text-center">
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

                                            <div id="autoAnswerSuggestions" class="well hidden"></div>
                                        </div><br>
                                        <div class="ticket-body">
                                            <div class="col-lg-12 col-md-8 col-xs-12 pull-left">
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
                                                                <label class="form-label">title:</label>
                                                                <div  class="form-control">{{$ticket->title}}</div>
                                                            </div>
                                                            <div class="col-6">
                                                                <label class="form-label">part:</label>
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
                                                        @foreach($ticket->attach as $file )
                                                        <a  href="/storage/{{$file->file}}">{{  explode('/', $file->file)[2]}}</a>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        @foreach($ticket->answers as $answer)
                                        <div class="ticket-body mt-2" style="margin-right: 20px;">
                                            <div class="col-lg-12 col-md-8 col-xs-12 pull-left">
                                                <div class="article box1">
                                                    <div class="header pull-right">
                                                        <div>
                                                            {{$answer->user->name}}
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <p class="pull-right body">

                                                        {{$answer->answer}}
                                                    </p>
                                                    @if($answer->attach)
                                                    @foreach($answer->attach as $file )
                                                    <a   href="/storage/{{$file->file}}">{{  explode('/', $file->file)[2]}}</a>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div><br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

