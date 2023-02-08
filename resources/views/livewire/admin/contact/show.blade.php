@section('title','show contact')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">show contact</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.contacts')}}">contacts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">show contact</li>
                </ol>
            </div>
            <div>
                <a data-toggle="tooltip" href="{{route('admin.contacts')}}" class="btn btn-warning text-white"
                   data-original-title="back">
                    <i class="fa fa-backward"></i>
                </a>

                <div wire:loading wire:target="updateInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>

            </div>
        </div>
        @include('livewire.admin.layouts.error')
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        show contact
                    </div>
                    <div class="card-body">
                        <form>
                            <div>
                                <div class="form-group row">
                                    <label class="col-md-2">name:</label>
                                    <div class="col-md-10">
                                        <div disabled  class="form-control">{{$contact->name}}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2">phone:</label>
                                    <div class="col-md-10">
                                        <div disabled  class="form-control">{{$contact->phone_number}}</div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2">email:</label>
                                    <div class="col-md-10">
                                        <div disabled  class="form-control">{{$contact->email}}</div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2">subject:</label>
                                    <div class="col-md-10">
                                        <div disabled  class="form-control">{{$contact->msg_subject}}</div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-2">message:</label>
                                    <div class="col-md-10">
                                        <div disabled  class="form-control">{{$contact->message}}</div>

                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

