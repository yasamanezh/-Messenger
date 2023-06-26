@section('title','create ticket')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">create ticket</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.tickets')}}">tickets</a></li>
                    <li class="breadcrumb-item active" aria-current="page">create ticket</li>
                </ol>
            </div>
            <div>
                <a data-toggle="tooltip" href="{{route('admin.tickets')}}" class="btn btn-warning text-white"
                   data-original-title="back">
                    <i class="fa fa-backward"></i>
                </a>
                <button wire:click.prevent="saveInfo" class="btn btn-primary my-2 btn-icon-text" type="submit"
                        wire:loading.attr="disabled" wire:loading.remove>save
                </button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>

            </div>
        </div>
        @include('livewire.admin.layouts.error')
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        create ticket
                    </div>
                    <div class="card-body">
                        <div class="profile-stats">
                            <div class="profile-stats-row">
                                <div class="profile-stats page-profile-order">
                                    <div class="table-orders">
                                        <div >

                                            <div class="row">
                                                <div class="form-group col-sm-4">
                                                    <label for="inputSubject">subject</label>
                                                    <input type="text" wire:model.defer="title" placeholder="Subject" value="" class="form-control">
                                                    @error('title')
                                                    <div class="invalid-feedback display-block">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label for="inputDepartment">part</label>
                                                    <select id="inputDepartment" class="form-control" wire:model.defer="part">
                                                        <option value="">select</option>
                                                        @foreach($parts as $part)
                                                        <option value="{{$part->id}}">{{$part->currentTranslate()->title}}  </option>
                                                        @endforeach
                                                    </select>
                                                    @error('part')
                                                    <div class="invalid-feedback display-block">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label for="inputDepartment">user</label>
                                                    <select   id="inputDepartment" class="form-control" wire:model="user">
                                                        <option value="">select</option>
                                                        @foreach($users as $user)
                                                        <option value="{{$user->id}}" >
                                                            {{$user->name}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('part')
                                                    <div class="invalid-feedback display-block">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputMessage"> message</label>
                                                <textarea wire:model="description" id="inputMessage" rows="12" class="form-control"></textarea>
                                                @error('description')
                                                <div class="invalid-feedback display-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="inputAttachments">attachments</label> </div>
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

