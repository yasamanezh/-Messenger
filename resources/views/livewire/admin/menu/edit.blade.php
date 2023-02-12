<div>
    @section('title',__('Edit Menu'))
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Edit Menu</h2><br>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.menus')}}">Menu</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Edit Menu</li>
                    </ol>
                </div>
                <div>
                    <a data-toggle="tooltip" href="{{route('admin.menus')}}" class="btn btn-warning text-white"  data-original-title="back">
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
                                <h6 class="main-content-label mb-1">Edit Menu</h6>
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
                                                <label class="col-sm-3 form-label">sort:</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" placeholder="sort" wire:model.defer="sort" >
                                                       
                                                </div>
                                                @error('sort') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                            </div>
                                             <div class="form-group row">
                                                <label class="col-sm-3 form-label">parent:<span class="tx-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" wire:model.defer="parent" >
                                                        <option value="">select</option>
                                                        <option value="0">Dont Parent</option>
                                                        @foreach($menus as $menu)
                                                        <option value="{{$menu->id}}">{{$menu->currentTranslate()->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('status') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-label">type:<span class="tx-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" wire:model="type" >
                                                        <option value="">select</option>
                                                        <option value="blog">blog category</option>
                                                        <option value="weblog">Weblog</option>
                                                        <option value="post">posts</option>
                                                        <option value="home">home page</option>
                                                        <option value="faq">faq page</option>
                                                        <option value="feature">feature page</option>
                                                        <option value="work">how to work page</option>
                                                        <option value="pack">packages</option>
                                                        <option value="page">other page</option>
                                                    </select>
                                                </div>
                                                @error('status') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-label">status:</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" wire:model.defer="status" >
                                                        <option value="">select</option>
                                                        <option value="1">enable</option>
                                                        <option value="0">disable</option>
                                                    </select>
                                                </div>
                                                @error('status') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                            </div>
                                            @if($type)
                                            @if($type == 'blog' || $type == 'post' || $type == 'page' )
                                            <div class="form-group row">
                                                <label class="col-sm-3 form-label">link:<span class="tx-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" wire:model.defer="slug" >
                                                        <option value="">select</option>
                                                        @if($type == 'blog')
                                                        @foreach($blogs as $cat)
                                                        <option value="{{$cat->id}}">{{$cat->currentTranslate()->title}}</option>
                                                        @endforeach
                                                        @endif
                                                        @if($type == 'post')
                                                        @foreach($posts as $post)
                                                        <option value="{{$post->id}}">{{$post->currentTranslate()->title}}</option>
                                                        @endforeach
                                                        @endif
                                                        @if($type == 'page')
                                                        @foreach($pages as $page)
                                                        @if($page->slug == 'faq' || $page->slug == 'feature' || $page->slug == 'how-to-work' || $page->slug == 'pack' || $page->slug == 'about' || $page->slug == 'contact'  ) @continue   @endif
                                                        <option value="{{$page->id}}">{{$page->currentTranslate()->title}}</option>
                                                        @endforeach
                                                        @endif
                                                        
                                                    </select>
                                                </div>
                                                @error('slug') <div class="invalid-feedback">  {{ $message }} </div> @enderror
                                            </div>
                                            @endif
                                            @endif
                                        </div>
                                        @foreach($languages as $language)
                                        <div wire:ignore.self class="tab-pane fade " id="language{{$language->id}}" role="tabpanel">
                                            <div class="form-group row">
                                                <label class="col-md-3 form-label"> title: <span class="tx-danger">{{$language->language->code=='en' ? '*':''}}</span></label>
                                                <div class="col-md-9">
                                                    <input placeholder="title"  class="form-control @error('title') is-invalid @enderror"  wire:model.defer="title.{{$language->language->code}}">
                                                    @error('title')  <div class="invalid-feedback"> {{ $message }}  </div> @enderror
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
