<div>
    @section('title',__('Add Client'))
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Add Client</h2><br>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.customer.users')}}">Client</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Add Client</li>
                    </ol>
                </div>
                <div>
                    <a data-toggle="tooltip" href="{{route('admin.customer.users')}}" class="btn btn-warning text-white"  data-original-title="back">
                        <i class="fa fa-backward"></i>
                    </a>
                    <button class="btn btn-primary my-2 btn-icon-text"  form="formInfo"  wire:loading.attr="disabled"  wire:loading.remove wire:target="saveInfo"> 
                        save
                    </button>                   
                    <div wire:loading wire:target="saveInfo">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                </div>
            </div>
            @include('livewire.admin.layouts.error')
            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div>
                                <h6 class="main-content-label mb-1">Add Client</h6>
                                <p class="text-muted card-sub-title">It is necessary to fill in the fields marked with (*)</p>
                            </div>
                            <form id="formInfo" wire:submit.prevent="saveInfo()" role="form" >
                                <div id="wizard3" class="wizard clearfix vertical">
                                    <div class="steps clearfix boder-none" >
                                        <ul class="item1-links nav nav-tabs  mb-0 boder-none ">
                                            <li class="nav-item dir-ltr" >
                                                <a  wire:ignore data-target="#general" class="nav-link active  pl-0" data-toggle="tab" role="tablist">
                                                    <span class="current-info audible">current step: </span>
                                                    <span class="number">1</span> 
                                                    <span class="title">General</span>
                                                </a>
                                            </li>
                                            
                                            @foreach($languages as $key=>$language)
                                            <li class="nav-item dir-ltr">
                                                <a   wire:ignore data-target="#language{{$language->id}}" class="nav-link pl-0" data-toggle="tab" role="tablist" >
                                                    <span class="current-info audible">current step: </span>
                                                    <span class="number">{{$key+1}}</span> 
                                                    <span class="title">{{$language->language->name}}</span>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="content clearfix tab-content mh-260" id="myTabContent"> 
                                        <div  wire:ignore.self class="tab-pane fade show active" id="general" role="tabpanel">
                                            <div class="form-group row">
                                                <label class="form-label col-sm-3">image: <span class="tx-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    @if($image)
                                                    <img src="{{ $image->temporaryUrl() }}"
                                                         style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                         id="picture">
                                                    
                                                    @else
                                                        <img id="picture"  style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;" src="{{ asset('admin/img/uploadicon.png')}}">

                                                    @endif
                                                    <br>
                                                    <input type="file" class="form-control " style="display:none" id="fileinput"
                                                           wire:model.defer="image" accept="image/*">
                                                    <span class="mt-2 text-danger" wire:loading
                                                          wire:target="image">uploading...</span>
                                                    <br>
                                                    @error('image')
                                                    <div class="invalid-feedback display-block">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-label"> sort:</label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="sort" class="form-control @error('sort') is-invalid @enderror"  wire:model.defer="sort">
                                                    @error('sort') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                                </div>
                                            </div>
                                            
                                        </div>
                                        @foreach($languages as $language)
                                        <div wire:ignore.self class="tab-pane fade " id="language{{$language->id}}" role="tabpanel">
                                            
                                            <div class="form-group row">
                                                <label class="col-md-3 form-label"> name: @if($language->language->code == 'en') <span class="tx-danger">*</span> @endif</label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="name " class="form-control @error('name') is-invalid @enderror"  wire:model.defer="name.{{$language->language->code}}">
                                                    @error('name') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-label"> job:</label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="job " class="form-control @error('job') is-invalid @enderror"  wire:model.defer="job.{{$language->language->code}}">
                                                    @error('job') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-label"> title: @if($language->language->code == 'en') <span class="tx-danger">*</span> @endif</label>
                                                <div class="col-md-9">
                                                    <input placeholder="title"  class="form-control @error('title') is-invalid @enderror"  wire:model.defer="title.{{$language->language->code}}">
                                                    @error('title')  <div class="invalid-feedback"> {{ $message }}  </div> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <label class="form-label col-sm-3">message: @if($language->language->code == 'en') <span class="tx-danger">*</span> @endif </label>
                                                    <div class="col-sm-9">
                                                        <textarea wire:model.defer="short_content.{{$language->language->code}}" rows="5" placeholder="message" class="form-control"></textarea>
                                                        @error('short_content')  <div class="invalid-feedback" style="display: block"> {{ $message }}  </div> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
