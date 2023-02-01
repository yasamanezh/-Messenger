<div>
@section('title',__('Clients'))
<div class="container-fluid">
    <div class="inner-body" wire:init="loadPage"  >
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Clients</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.modules')}}">Modules</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Clients</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="{{route('admin.customer.user.add')}}" class="btn ripple btn-primary"> Add <i class="fa fa-plus-circle ml-0"></i> </a>
                </div>
            </div>
        </div>
        @include('livewire.admin.layouts.message')
        <div class="row">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                  @include('livewire.admin.layouts.table') 
            </div>
        </div>
    </div>
 @include('livewire.admin.layouts.modals')
</div>

</div>
