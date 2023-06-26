<div>
    @section('title',__('profile'))
    <livewire:front.layout.menu :lang="$multiLanguage">
        <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{__('Profile')}}</h2>
                    <ul>
                         <li><a href="{{$multiLanguage ? route('front.home.language',app()->getlocale()) : route('front.home')}}">{{__('Home')}}</a></li>
						
                        <li>{{__('Profile')}}</li>
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
            <div class="banner-shape1">
                <img src="{{asset('front/ltr/assets/img/shape/shape9.png')}}" alt="{{$name}}"></div>
        </div>
        <!-- Start Checkout Area -->
        <div class="checkout-area ptb-100">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="billing-details">
                            <h3 class="title">{{__('Profile')}}</h3>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    @include('livewire.admin.layouts.error')
                                    @if($success)
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{{__('success')}}</li>
                                        </ul>
                                    </div>
                                    @endif

                                    @if($errorsmsg)
                                    <div class="alert alert-danger">
                                        <ul>
                                            <li>{{$errorsmsg}}</li>
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-8">
                                       <div class="form-group row">
                                                <label class="form-label col-sm-2">image:</label>
                                                <div class="col-sm-10">
                                                    @if($uploadImage)
                                                    <img src="{{ $uploadImage->temporaryUrl() }}"
                                                         style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                         id="picture">
                                                    @elseif(isset($image))
                                                    <img id="picture"
                                                         style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                         src="/storage/{{ $image}}">
                                                    @else
                                                    <img id="picture"
                                                         style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;"
                                                         src=" {{asset('admin/img/svgs/user.svg')}}">
                                                   
                                                    @endif
                                                    <br>
                                                    <input type="file" class="form-control " style="display:none" id="fileinput"
                                                           wire:model.defer="uploadImage" accept="image/*">
                                                    <span class="mt-2 text-danger" wire:loading
                                                          wire:target="uploadImage">uploading...</span>
                                                    <br>
                                                    @error('uploadImage')
                                                    <div class="invalid-feedback display-block">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                
                                    <br><br>
                                    <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>{{__('Name')}} <span class="required">*</span></label>
                                        <input type="text" class="form-control" wire:model.defer="name">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>{{__('Email')}}<span class="required">*</span></label>
                                        <input type="text" class="form-control" wire:model.defer="email">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>{{__('New Password')}}</label>
                                        <input type="password" class="form-control"  wire:model.defer="password">
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-6">
                                    <button wire:loading.remove  wire:click.prvnt="saveProfile()" type="button" class="default-btn">{{__('save')}}</button>
                                </div>
                                <div  wire:loading  class="spinner-border text-danger" role="status">
                                    <span class="visually-hidden">{{__('Loading')}}...</span>
                                </div>
</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- End Checkout Area -->

        <!-- End Page Title Area -->
        <livewire:front.layout.footer :language="$multiLanguage">

            </div>

