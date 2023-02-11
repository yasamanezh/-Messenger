<div>
    <livewire:front.page.layout.title :title="$this->getTranslate('title',$page)" />
        <!-- Start Contact Area -->
        <div class="contact-area ptb-100">
            <div class="container">
                <div class="section-title">
                    <h2>{!! $this->getTranslate('title', $page) !!}</h2>
                    <p>{!! $this->getTranslate('short_content', $page) !!}</p>
                </div>
                <div class="contact-form">
                    @if($success)
                    <div class="alert alert-success">
                        <ul>
                            <li>{{$success}}</li>
                        </ul>
                    </div>

                    @endif
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" wire:model.defer="name" class="form-control" id="name"   placeholder="Eg: Sarah Taylor">
                                    @error('name')<div class="help-block with-errors">{{$message}}</div>@endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input  wire:model.defer="email" class="form-control" id="email"   placeholder="hello@sarah.com">
                                    @error('email')<div class="help-block with-errors">{{$message}}</div>@endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" wire:model.defer="phone_number" class="form-control" id="phone_number"   placeholder="Enter your phone number">
                                    @error('phone_number')<div class="help-block with-errors">{{$message}}</div>@endif
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <input type="text" wire:model.defer="msg_subject" class="form-control" id="msg_subject" placeholder="Enter your subject" >
                                    @error('msg_subject')<div class="help-block with-errors">{{$message}}</div>@endif
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <textarea wire:model.defer="message" id="message" class="form-control" cols="30" rows="6" placeholder="Enter message..."></textarea>
                                    @error('message')<div class="help-block with-errors">{{$message}}</div>@endif
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button type="text" wire:click.prevent='save()' wire:loading.remove class="default-btn"><i class='bx bx-paper-plane'></i> Send Message</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                            <div  wire:loading  class="spinner-border text-danger" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="maps">
                <iframe src="{{$setting->location}}"></iframe>
            </div>
        </div>
        <!-- End Contact Area -->
        <livewire:front.page.layout.call :title="[$setting,$call_text]" />
</div>