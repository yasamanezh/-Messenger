<div>
    @section('title',__('Edit Top Page Module'))
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Edit Top Page Module</h2><br>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.modules')}}">Modules</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Edit Top Page Module</li>
                    </ol>
                </div>
                <div>
                    <a data-toggle="tooltip" href="{{route('admin.modules')}}" class="btn btn-warning text-white"  data-original-title="back">
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
                                <h6 class="main-content-label mb-1">Edit Top Page Module</h6>
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
                                                    <span class="number">{{$key+2}}</span> 
                                                    <span class="title">{{$language->language->name}}</span>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="content clearfix tab-content mh-260" id="myTabContent"> 
                                        <div  wire:ignore.self class="tab-pane fade show active" id="general" role="tabpanel">
                                            <div class="form-group row">
                                                <label class="form-label col-sm-2">banner: <span class="tx-danger">*</span></label>
                                                <div class="col-sm-10">
                                                    @if($upload)
                                                    <img src="{{ $upload->temporaryUrl() }}"
                                                         style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                         id="picture">
                                                    @elseif($image)
                                                    <img id="picture"
                                                         style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                         src="/storage/{{ $image}}">
                                                    @else()
                                                        <img id="picture"  style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;" src="{{ asset('admin/img/uploadicon.png')}}">

                                                    @endif
                                                    <br>
                                                    <input type="file" class="form-control " style="display:none" id="fileinput"
                                                           wire:model.defer="upload" accept="image/*">
                                                    <span class="mt-2 text-danger" wire:loading
                                                          wire:target="upload">uploading...</span>
                                                    <br>
                                                    @error('uploadImage')
                                                    <div class="invalid-feedback display-block">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="form-label col-sm-2">app file: <span class="tx-danger">*</span></label>
                                                <div class="col-sm-10">
                                                     <input type="file" class="form-control "wire:model.defer="uploadFile" >
                                                     <span class="mt-2 text-danger" wire:loading
                                                          wire:target="uploadFile">uploading...</span>
                                                </div>
                                            </div>
                                             <div class="row">
                                            @foreach($inputImage as $key => $value)
                                                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mt-2"
                                                     style="position: relative">
                                                    <a>
                                                        @if(isset($uploadImage[$key]))
                                                        <img id="picture{{$key}}" class="pic" src="{{$uploadImage[$key]->temporaryUrl()}}" style="width: 200px;height: 200px"/>
                                                        @elseif(isset($product_img[$key]))
                                                           <img id="picture{{$key}}" class="pic"  src="/storage/{{$product_img[$key]}}" style="width: 200px;height: 200px"/>
                                                        @else
                                                            <img id="picture{{$key}}" class="pic"  src="{{ asset('admin/img/uploadicon.png')}}" style="width: 200px;height: 200px"/>
                                                        @endif

                                                    </a>
                                                    <input id="fileinput{{$key}}" type="file" wire:model.defer="uploadImage.{{ $key }}" style="display:none">
                                                    <span class="mt-2 text-danger" wire:loading  wire:target="uploadImage.{{ $key }}">uploading...</span>
                                                    <a style="color: red;position: absolute;top:10px;right: 10px"
                                                       wire:click.prevent="removeImage({{$key}})">
                                                        <i class="fa fa-minus-circle"></i>
                                                    </a>
                                                </div>
                                                <script>
                                                    $(function () {
                                                        $("#picture{{$key}}").on('click', function () {
                                                            $("#fileinput{{$key}}").trigger('click');
                                                        });
                                                    });
                                                </script>
                                            @endforeach
                                             </div>
                                        <br>
                                        <br>
                                        <hr>
                                        <div class=" add-input" style="display: block;width: 200px;float:left">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button class="btn ripple btn-primary text-white btn-icon btn-xs"  wire:click.prevent.prefetch="AddImage({{$j}})">
                                                        <i class="fa fa-plus-circle"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        @foreach($languages as $language)
                                        <div wire:ignore.self class="tab-pane fade " id="language{{$language->id}}" role="tabpanel">
                                            <div class="form-group row">
                                                <label class="col-md-3 form-label"> title:  @if($language->language->code == 'en') <span class="tx-danger">*</span> @endif</label>
                                                <div class="col-md-9">
                                                    <input placeholder="title"  class="form-control @error('title') is-invalid @enderror"  wire:model.defer="title.{{$language->language->code}}">
                                                    @error('title')  <div class="invalid-feedback"> {{ $message }}  </div> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <label class="form-label col-sm-3">short description: @if($language->language->code == 'en') <span class="tx-danger">*</span> @endif </label>
                                                    <div class="col-sm-9">
                                                        <textarea wire:model.defer="short_content.{{$language->language->code}}" rows="5" placeholder="short description" class="form-control"></textarea>
                                                        @error('short_content')  <div class="invalid-feedback" style="display: block"> {{ $message }}  </div> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <label class="form-label col-sm-3">description:  @if($language->language->code == 'en') <span class="tx-danger">*</span> @endif </label>
                                                    <div class="col-sm-9">
                                                        <textarea wire:model.defer="content.{{$language->language->code}}" rows="5" placeholder="description" class="form-control"></textarea>
                                                        @error('content')  <div class="invalid-feedback" style="display: block"> {{ $message }}  </div> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <label class="form-label col-sm-3"> used this App text:  </label>
                                                    <div class="col-sm-9">
                                                        <input wire:model.defer="count_use.{{$language->language->code}}" placeholder="description" class="form-control">
                                                        @error('count_use')  <div class="invalid-feedback" style="display: block"> {{ $message }}  </div> @enderror
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
