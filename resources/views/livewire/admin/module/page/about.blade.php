<div>
    @section('title',__('Edit about page'))
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Edit about page</h2><br>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.pages')}}" >pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Edit about page</li>
                    </ol>
                </div>
                <div>
                    <a data-toggle="tooltip" href="{{route('admin.pages')}}" class="btn btn-warning text-white"  data-original-title="back">
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
            @include('livewire.admin.layouts.message')
            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div>
                                <h6 class="main-content-label mb-1">Edit about page</h6>
                                <p class="text-muted card-sub-title">It is necessary to fill in the fields marked with (*)</p>
                            </div>
                            <form id="formInfo" wire:submit.prevent="saveInfo()" role="form" >
                                <div id="wizard3" class="wizard clearfix vertical">
                                    <div class="steps clearfix boder-none" >
                                        <ul class="item1-links nav nav-tabs  mb-0 boder-none ">

                                            @foreach($languages as $key=>$language)
                                            <li class="nav-item dir-ltr">
                                                <a   wire:ignore data-target="#language{{$language->id}}" class="nav-link pl-0  {{$loop->first ? 'active' : ''}}" data-toggle="tab" role="tablist" >
                                                    <span class="current-info audible">current step: </span>
                                                    <span class="number">{{$key+1}}</span> 
                                                    <span class="title">{{$language->language->name}}</span>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="content clearfix tab-content mh-260" id="myTabContent"> 

                                        @foreach($languages as $language)
                                        <div wire:ignore.self class="tab-pane fade {{$loop->first ? 'show active' : ''}} " id="language{{$language->id}}" role="tabpanel">
                                           <div class="form-group">
                                                <div class="row row-sm" wire:ignore>
                                                    <label class="col-sm-3 form-label"> title:<span class="tx-danger">{{$language->language->code == 'en' ? '*' : ''}}</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" wire:model.defer="title.{{$language->language->code}}"  placeholder=" title" name="meta_title"  class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" wire:ignore >
                                                <div class="row row-sm">
                                                    <label class="form-label col-sm-3">description:<span class="tx-danger">{{$language->language->code == 'en' ? '*' : ''}}</span> </label>
                                                    <div class="col-sm-9">
                                                        <textarea  rows="10" class="form-control summernote-editor " id="summernote-editor{{$language->language->code}}" 
                                                                    wire:model.defer="description.{{$language->language->code}}"
                                                                  autocomplete="off">{!! $description[$language->language->code] !!}</textarea>

                                                    </div>
                                                </div>
                                            </div>

                                            @push('jsBeforCustomJs')

                                            <script>

                                                $('#summernote-editor' + "{{$language->language->code}}").summernote({

                                                toolbar: [
                                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                                ['font', ['strikethrough', 'superscript', 'subscript']],
                                                ['fontsize', ['fontsize']],
                                                ['color', ['color']],
                                                ['para', ['ul', 'ol', 'paragraph']],
                                                ['height', ['height']],
                                                ['view', ['fullscreen', 'codeview', 'help']],
                                                ['popovers', ['lfm']],
                                                ],
                                                        buttons: {
                                                        lfm: LFMButton
                                                        },
                                                        height: 200,
                                                        callbacks: {
                                                        onChange: function (contents, $editable) {
                                                        @this.set("description." + "{{$language->language->code}}", contents);
                                                        }
                                                        },
                                                });

                                            </script>
                                            @endpush
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
