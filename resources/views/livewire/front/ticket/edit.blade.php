
<div >
    <livewire:front.layout.menu :lang="$multiLanguage">
        <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>view tickets</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li>view tickets</li>
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
            <div class="banner-shape1"><img src="assets/img/shape/shape9.png" alt="image"></div>
        </div>
        <!-- End Page Title Area -->


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

        <div class="container-fluid mt-2">
            <div class="py-12 p-3">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="col-lg-12">
                            <div class="card custom-card " style="padding: 20px">

                                <div class="card-body">

                                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

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
                                                <div class="row p-1 bg-light">
                                                    <div class="col-lg-3 col-md-3 col-xs-6">
                                                        <div class="row center">
                                                            <strong>created date:</strong>&nbsp;﻿ {{$ticket->created_at->format('d M  ,Y h:i A')}}
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-md-3 col-xs-6">
                                                        <div class="row center">
                                                            <strong>last updated:</strong>&nbsp; {{$ticket->updated_at->format('d M  ,Y h:i A')}}
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-md-3 col-xs-6">
                                                        <div class="row center">
                                                            <strong>status:</strong>&nbsp;<span style="color:#888888">{{$status}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3 col-md-3 col-xs-6">
                                                        <div class="row center">
                                                            <strong>part:</strong>&nbsp;
                                                            @if(\App\Models\Part::find($ticket->part))
                                                            {{\App\Models\Part::find($ticket->part)->currentTranslate()->title}}
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="card-body">
                                                    <div class="profile-stats">
                                                        <div class="profile-stats-row">
                                                            <div class="profile-stats page-profile-order">
                                                                <div class="table-orders">
                                                                    <div class="accordion" id="accordionExample">
                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header" id="headingOne">
                                                                                <button wire:ignore class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                                    answer
                                                                                </button>
                                                                            </h2>
                                                                            <div wire:ignore.self  id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                                                <div class="accordion-body">
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
                                                                                        <div  wire:loading wire:target='saveInfo'  class="spinner-border text-danger" role="status">
                                                                                            <span class="visually-hidden">Loading...</span>
                                                                                        </div>
                                                                                        <button wire:loading.remove wire:target='saveInfo' class="btn btn-primary" wire:click.prevent='saveInfo()'>save</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                    </div>

                                                                    <div >


                                                                    </div><br>

                                                                    @foreach($ticket->answers()->orderBy('created_at','DESC')->get() as $answer)
                                                                    <div class="ticket-body mt-2" style="margin-right: 20px;">
                                                                        <div class="col-lg-12 col-md-8 col-xs-12">
                                                                            <div class="article box1 ">
                                                                                <div class=" pull-right {{$answer->user->role == 'admin' ? 'header2 text-white' : 'header'}}">
                                                                                    <div>

                                                                                        {{$answer->user->name}}
                                                                                        <br>
                                                                                        {{$answer->user->role}}
                                                                                        <i class="fa fa-user"></i>
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
                        </div>
                    </div>
                </div>
            </div>



        </div>
</div>

