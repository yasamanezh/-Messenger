<div >
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
            <div class="banner-shape1"><img src="assets/img/shape/shape9.png" alt="image"></div>
        </div>
        <!-- End Page Title Area -->


        <style>
            .box1{
                border: 1px solid #eee;


                display: block;
                float: right;
                width: 100%;
            }
            .box1 .header{
                display: block;
                width: 100%;
                background: aliceblue;
                padding:15px 20px;
            }

            .header2{
                display: block;
                width: 100%;
                background: blue;
                padding:15px 20px; 
            }

            .box1 .body{
                display: block;
                width: 100%;
                padding: 20px;
            }
            .ticket-body{
                display: block;
                width: 100%;
                height: 100%;
                float: right;

            }
        </style>

        <div class="container-fluid mt-2">
            <div class="py-12 p-3">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="col-lg-12">
                            <div class="card custom-card " style="padding: 20px">
                                <div >

                                    <div class="row">
                                        <div class="form-group col-sm-4">
                                            <label for="inputSubject">subject</label>
                                            <input type="text" wire:model.defer="title" placeholder="Subject" value="" class="form-control">
                                            @error('title')
                                            <div class="invalid-feedback display-block">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="inputDepartment">part</label>
                                            <select id="inputDepartment" class="form-control" wire:model.defer="part">
                                                <option value="">select</option>
                                                @foreach($parts as $part)
                                                <option value="{{$part->id}}">{{$part->currentTranslate()->title}}  </option>
                                                @endforeach
                                            </select>
                                            @error('part')
                                            <div class="invalid-feedback display-block">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                       
                                    </div>

                                    <div class="form-group">
                                        <label for="inputMessage"> message</label>
                                        <textarea wire:model.defer="description" id="inputMessage" rows="12" class="form-control"></textarea>
                                        @error('description')
                                        <div class="invalid-feedback display-block">
                                            {{ $message }}
                                        </div>
                                        @enderror
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
                                <div  wire:loading wire:target="saveInfo"  class="spinner-border text-danger" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <button wire:loading.remove wire:target="saveInfo" class="btn btn-primary" wire:click.prevent="saveInfo">save</button>


                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
</div>

