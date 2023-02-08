<div>
    @section('title',__('Edit Footer'))
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Edit Footer</h2><br>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Edit Footer</li>
                    </ol>
                </div>
                <div>
                   
                    <button class="btn btn-primary my-2 btn-icon-text"  form="formInfo"  wire:loading.attr="disabled"  wire:loading.remove wire:target="saveInfo"> 
                        save
                    </button>                   
                    <div wire:loading wire:target="saveInfo">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                </div>
            </div>
            @include('livewire.admin.layouts.error')
            @include('livewire.admin.layouts.message')
            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div>
                                <h6 class="main-content-label mb-1">Edit Footer</h6>
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
                                                <label class="col-sm-2 control-label">Company links:</label>
                                                <div class="col-sm-10">
                                                    <div class="well well-sm scrollbar" id="style-1"
                                                         style="height: 150px; overflow: auto;background-color: #f5f5f5;;padding: 20px">

                                                        @foreach($menus as $menu)
                                                        <div class="checkbox">
                                                            <label>
                                                                <input wire:model.defer="Company_links" type="checkbox" value="{{$menu->id}}"> {{$menu->currentTranslate()->title}}
                                                            </label>
                                                        </div>
                                                        @endforeach

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label ">Support links :</label>
                                                <div class="col-sm-10">
                                                    <div class="well well-sm scrollbar" id="style-1" style="height: 150px; overflow: auto;background-color: #f5f5f5;;padding: 20px">

                                                        @foreach($menus as $menu)
                                                        <div class="checkbox">
                                                            <label> 
                                                                <input wire:model.defer="Support_links" type="checkbox"  value="{{$menu->id}}"> {{$menu->currentTranslate()->title}}
                                                            </label>
                                                        </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Useful links:</label>
                                                <div class="col-sm-10">
                                                    <div class="well well-sm scrollbar" id="style-1"
                                                         style="height: 150px; overflow: auto;background-color: #f5f5f5;;padding: 20px">

                                                        @foreach($menus as $menu)
                                                        <div class="checkbox">
                                                            <label> 
                                                                <input wire:model.defer="Useful" type="checkbox" value="{{$menu->id}}"> {{$menu->currentTranslate()->title}}
                                                            </label>
                                                        </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        @foreach($languages as $language)
                                        <div wire:ignore.self class="tab-pane fade " id="language{{$language->id}}" role="tabpanel">
                                            <div class="form-group row">
                                                <label class="col-md-3 form-label"> title right:  @if($language->language->code == 'en') <span class="tx-danger">*</span> @endif</label>
                                                <div class="col-md-9">
                                                    <input placeholder="title right"  class="form-control @error('title_right') is-invalid @enderror"  wire:model.defer="title_right.{{$language->language->code}}">
                                                    @error('title_right')  <div class="invalid-feedback"> {{ $message }}  </div> @enderror
                                                </div>
                                            </div>
                                             <div class="form-group row">
                                                <label class="col-md-3 form-label"> title left:  @if($language->language->code == 'en') <span class="tx-danger">*</span> @endif</label>
                                                <div class="col-md-9">
                                                    <input placeholder="title left"  class="form-control @error('title_left') is-invalid @enderror"  wire:model.defer="title_left.{{$language->language->code}}">
                                                    @error('title_left')  <div class="invalid-feedback"> {{ $message }}  </div> @enderror
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-md-3 form-label"> description right:  @if($language->language->code == 'en') <span class="tx-danger">*</span> @endif</label>
                                                <div class="col-md-9">
                                                    <textarea  rows="5" type="description right" placeholder="see more buttom text " class="form-control @error('content_right') is-invalid @enderror"  wire:model.defer="content_right.{{$language->language->code}}"> </textarea>
                                                    @error('content_right') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                                </div>
                                            </div>
                                                <div class="form-group row">
                                                <label class="col-md-3 form-label"> description left:  @if($language->language->code == 'en') <span class="tx-danger">*</span> @endif</label>
                                                <div class="col-md-9">
                                                    <textarea  rows="5" type="description left" placeholder="see more buttom text " class="form-control @error('content_left') is-invalid @enderror"  wire:model.defer="content_left.{{$language->language->code}}"> </textarea>
                                                    @error('content_left') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <label class="form-label col-sm-3">Useful Links text:  @if($language->language->code == 'en') <span class="tx-danger">*</span> @endif</label>
                                                    <div class="col-sm-9">
                                                        <input row="5" wire:model.defer="Useful_Links_text.{{$language->language->code}}"placeholder="Useful Links text" class="form-control">
                                                        @error('Useful_Links_text')  <div class="invalid-feedback" style="display: block"> {{ $message }}  </div> @enderror

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <label class="form-label col-sm-3">company text:  @if($language->language->code == 'en') <span class="tx-danger">*</span> @endif</label>
                                                    <div class="col-sm-9">
                                                        <input wire:model.defer="company.{{$language->language->code}}" placeholder="company text" class="form-control">
                                                        @error('company')  <div class="invalid-feedback" style="display: block"> {{ $message }}  </div> @enderror

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <label class="form-label col-sm-3">support text:  @if($language->language->code == 'en') <span class="tx-danger">*</span> @endif</label>
                                                    <div class="col-sm-9">
                                                        <input wire:model.defer="support.{{$language->language->code}}" placeholder="support text" class="form-control">
                                                        @error('support')  <div class="invalid-feedback" style="display: block"> {{ $message }}  </div> @enderror

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
