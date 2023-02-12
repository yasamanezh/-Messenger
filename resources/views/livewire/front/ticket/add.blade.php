<div>
    <livewire:front.layout.menu :lang="$multiLanguage">
        <!-- Start Page Title Area -->
        <div class="page-title-area">
            <div class="container">
                <div class="page-title-content">
                    <h2>view tickets</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li>view tickets</li>
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
            <div class="banner-shape1"><img src="{{asset('front/ltr/assets/img/shape/shape9.png')}}" alt="image"></div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Checkout Area -->
        <div class="checkout-area ptb-100">
            <div class="container">

                <div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="order-details">
                                <h3 class="title">create new ticket</h3>
                                @include('livewire.admin.layouts.error')
                                @if($success)
                                <div class="alert alert-success">
                                    <ul>
                                        <li>{{$success}}</li>
                                    </ul>
                                </div>
                                @endif

                                <div class="payment-box">
                                    <div class="payment-method">
                                        <div >

                                            <div class="row">
                                                <div class="form-group col-sm-4">
                                                    <label for="inputSubject">subject</label>
                                                    <input type="text" wire:model.defer="subject" placeholder="Subject"  class="form-control">

                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label for="inputDepartment">part</label>
                                                    <select id="inputDepartment" class="form-control" wire:model.defer="part_id">
                                                        <option value="">select</option>
                                                        @foreach($parts as $part)
                                                        <option value="{{$part->id}}">{{$part->currentTranslate()->title}}  </option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label for="inputMessage"> message</label>
                                                <textarea wire:model.defer="message" id="inputMessage" rows="12" class="form-control"></textarea>

                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="inputAttachments">attachments</label>
                                                </div>
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
                                    <div  wire:loading wire:target="saveInfo"  class="spinner-border text-danger" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <button wire:click.prevent="saveInfo()" class="default-btn"><i class='bx bx-paper-plane'></i>Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <livewire:front.layout.footer :language="$multiLanguage">

            </div>

