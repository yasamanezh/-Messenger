<div>
    @section('title',__('Edit Setting'))
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Edit Setting</h2><br>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Edit Setting</li>
                    </ol>
                </div>
                <div>
                    <a data-toggle="tooltip" href="{{route('admin.posts')}}" class="btn btn-warning text-white"  data-original-title="back">
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
            @if($success)
            <div class="alert alert-success">
                <ul>

                    <li>{{$success}}</li>

                </ul>
            </div>
            @endif
            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div>
                                <h6 class="main-content-label mb-1">Edit Setting</h6>
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
                                                <label class="form-label col-sm-3">logo: </label>
                                                <div class="col-sm-9">
                                                    @if($uploadLogo)
                                                    <img src="{{ $uploadLogo->temporaryUrl() }}"
                                                         style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                         id="picture1">
                                                    @elseif(isset($data->logo) && !empty($data->logo))
                                                    <img id="picture1"
                                                         style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                         src="/storage/{{ $data->logo}}">
                                                    @else
                                                    <img id="picture1"  style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;" src="{{ asset('admin/img/uploadicon.png')}}">

                                                    @endif
                                                    <br>
                                                    <input type="file" class="form-control " style="display:none" id="fileinput1"
                                                           wire:model.defer="uploadLogo" accept="image/*">
                                                    <span class="mt-2 text-danger" wire:loading
                                                          wire:target="uploadLogo">uploading...</span>
                                                    <br>
                                                    @error('uploadLogo')
                                                    <div class="invalid-feedback display-block">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <script>
                                                    $(function () {
                                                        $("#picture1").on('click', function () {
                                                            $("#fileinput1").trigger('click');
                                                        });
                                                    });


                                                </script>
                                            </div>
                                            <div class="form-group row">
                                                <label class="form-label col-sm-3">icon: </label>
                                                <div class="col-sm-9">
                                                    @if($uploadIcon)
                                                    <img src="{{ $uploadIcon->temporaryUrl() }}"
                                                         style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                         id="picture">
                                                    @elseif(isset($data->icon) && !empty($data->icon))
                                                    <img id="picture"
                                                         style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                         src="/storage/{{ $data->icon}}">
                                                    @else
                                                    <img id="picture"  style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;" src="{{ asset('admin/img/uploadicon.png')}}">

                                                    @endif
                                                    <br>
                                                    <input type="file" class="form-control " style="display:none" id="fileinput"
                                                           wire:model.defer="uploadIcon" accept="image/*">
                                                    <span class="mt-2 text-danger" wire:loading
                                                          wire:target="uploadIcon">uploading...</span>
                                                    <br>
                                                    @error('uploadIcon')
                                                    <div class="invalid-feedback display-block">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 form-label"> location: </label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="location" class="form-control @error('data.location') is-invalid @enderror"  wire:model.defer="data.location">
                                                    @error('data.location') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-label"> email parameter: </label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="email parameter" class="form-control @error('data.mail_parameter') is-invalid @enderror"  wire:model.defer="data.mail_parameter">
                                                    @error('data.mail_parameter') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 form-label"> email user name: </label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="email user name" class="form-control @error('data.mail_username') is-invalid @enderror"  wire:model.defer="data.mail_username">
                                                    @error('data.mail_username') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 form-label"> email password: </label>
                                                <div class="col-md-9">
                                                    <input type="text" placeholder="email password" class="form-control @error('data.mail_password') is-invalid @enderror"  wire:model.defer="data.mail_password">
                                                    @error('data.mail_password') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-3 form-label">default language:<span class="tx-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" wire:model.defer="data.daf_lang" >
                                                        <option value="">select</option>
                                                        @foreach($languages as $value)
                                                        <option @isset($value->daf_lang){{$value->id == $data->daf_lang ? 'selected' : ''}} @endisset value="{{$value->language->id}}">{{$value->language->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('data.daf_lang') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                            </div>


                                        </div>
                                        @foreach($languages as $language)
                                        <div wire:ignore.self class="tab-pane fade " id="language{{$language->id}}" role="tabpanel">

                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <label class="form-label col-sm-3">Meta description: </label>
                                                    <div class="col-sm-9">
                                                        <textarea wire:model.defer="meta_description.{{$language->language->code}}" rows="5" placeholder="Meta description" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <label class="form-label col-sm-3">Meta keywords: </label>
                                                    <div class="col-sm-9">
                                                        <textarea wire:model.defer="meta_keyword.{{$language->language->code}}"  rows="5" placeholder="Meta keywords" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row row-sm" wire:ignore>
                                                    <label class="col-sm-3 form-label">meta title:<span class="tx-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" wire:model.defer="meta_title.{{$language->language->code}}"  placeholder="meta title" class="form-control">
                                                    </div>
                                                </div>
                                                @error('meta_title')
                                                <div class="invalid-feedback display-block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
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
