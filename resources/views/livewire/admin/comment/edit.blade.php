@section('title','edit comment')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">edit comment</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.comments')}}">comments</a></li>
                    <li class="breadcrumb-item active" aria-current="page">edit comment</li>
                </ol>
            </div>
            <div>
                <a data-toggle="tooltip" href="{{route('admin.comments')}}" class="btn btn-warning text-white"
                   data-original-title="back">
                    <i class="fa fa-backward"></i>
                </a>
                <button wire:click.prevent="updateInfo()" class="btn btn-primary my-2 btn-icon-text" type="submit"
                        wire:loading.attr="disabled" wire:loading.remove>save
                </button>
                <div wire:loading wire:target="updateInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                
            </div>
        </div>
        @include('livewire.admin.layouts.error')
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                       edit comment
                    </div>
                    <div class="card-body">
                        <form>
                            <div>
                                <div class="form-group row">
                                    <label class="col-md-2">name:</label>
                                    <div class="col-md-10">
                                        <input type="text" 
                                                  class="form-control @error('comment.name') is-invalid @enderror"
                                                  wire:model.defer="comment.name">
                                        @error('comment.name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                  <div class="form-group row">
                                    <label class="col-md-2">website:</label>
                                    <div class="col-md-10">
                                        <input type="text" 
                                                  class="form-control @error('comment.website') is-invalid @enderror"
                                                  wire:model.defer="comment.website">
                                        @error('comment.website')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                  <div class="form-group row">
                                    <label class="col-md-2">email:</label>
                                    <div class="col-md-10">
                                        <input type="text" 
                                                  class="form-control @error('comment.email') is-invalid @enderror"
                                                  wire:model.defer="comment.email">
                                        @error('comment.email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-2">comment:</label>
                                    <div class="col-md-10">
                                        <textarea type="text"  rows="10"
                                                  class="form-control @error('comment.content') is-invalid @enderror"
                                                  wire:model.defer="comment.content"></textarea>
                                        @error('comment.content')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-2">answer:</label>
                                    <div class="col-md-10">
                                        <textarea type="text" rows="10" 
                                                  class="form-control @error('comment.answer') is-invalid @enderror"
                                                  wire:model.defer="comment.answer"></textarea>
                                        @error('comment.answer')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">status</div>
                                    <div class="col-sm-10">
                                        <select class="form-control" wire:model="comment.status">
                                            <option value="1">enable</option>
                                            <option value="0">disable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

