@section('title','Socials')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5"> Socials</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Socials</li>
                </ol>
            </div>
            <div>
                <button class="btn btn-primary my-2 btn-icon-text" wire:click.prevent="saveInfo"
                        wire:loading.remove>save
                </button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
            </div>
        </div>
          @if($success)
            <div class="alert alert-success">
                <ul>

                    <li>{{$success}}</li>

                </ul>
            </div>

            @endif
        <div class="row">
            <div class="col-12 ">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                      Socials
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <form class="padding-10 saveInfo">
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">Telegram : </label>
                                    <input type="text" wire:model.lazy="telegram" placeholder=""
                                           class="form-control col-sm-6">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">Watssapp : </label>
                                    <input type="text" wire:model.lazy="whatsapp" placeholder=""
                                           class="form-control col-sm-6">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">Ttwitter : </label>
                                    <input type="text" wire:model.lazy="twitter" placeholder=""
                                           class="form-control col-sm-6">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">Linkedin : </label>
                                    <input type="text" wire:model.lazy="linkdin" placeholder=""
                                           class="form-control col-sm-6">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">Instagram : </label>
                                    <input type="text" wire:model.lazy="instagram" placeholder=""
                                           class="form-control col-sm-6">
                                </div>
                                <div class="form-group row">
                                    <label class="form-label col-sm-2">Email : </label>
                                    <input type="text" wire:model.lazy="email" placeholder=""
                                           class="form-control col-sm-6">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
