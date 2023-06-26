@section('title','orders ')
<div class="container-fluid" >
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">orders </h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">orders</li>
                </ol>
            </div>
            <div>
                <a class="btn btn-primary text-white my-2 btn-icon-text" href="{{route('admin.role.add')}}">Add
                    <i class="fa fa-plus-circle"></i>
                </a>
            </div>
        </div>
        @include('livewire.admin.layouts.message')
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        orders

                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="input-group mb-2">
                                            <input type="search" wire:model.debounce.1000="search" class="form-control  pr-3"  placeholder="search ...  ">
                                            <span class="input-group-append">
                                                <button class="btn ripple btn-primary" type="button"><i  class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-6"></div>
                                            <div class="col-sm-6">
                                                <select  wire:model.lazy="count_data" class="form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive scrollbar" id="style-1">
                                        <table class="table dataTable no-footer dtr-inline " id="example2"
                                               role="grid" aria-describedby="example2_info">
                                            <thead>
                                                <tr role="row">
                                                    <th style="padding-right: 15px;" class="wd-lg-5p">
                                                        <label class="ckbox">
                                                            <input name="selected" wire:model="SelectPage"
                                                                   type="checkbox"><span
                                                                   class="tx-13"></span>
                                                        </label>
                                                    </th>
                                                    <th class="wd-lg-20p">
                                                        <span style="margin-right: 15px;"> title </span>
                                                        <span wire:click="sortBy('name')" class="float-right text-sm"
                                                              style="cursor: pointer;">
                                                            <i class="fa fa-arrow-up {{ $sortColumnName === 'name' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'name' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                                        </span>
                                                    </th>
                                                    <th>description</th>
                                                    <th>
                                                        <span style="margin-right: 15px;"> create date</span>
                                                        <span wire:click="sortBy('created_at')" class="float-right text-sm"
                                                              style="cursor: pointer;">
                                                            <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                                        </span>
                                                    </th>
                                                    
                                                </tr>
                                            </thead>
                                            <div class="payment-box">
                                                <div class="table-responsive scrollbar" id="style-1" >
                                                    <table class="table dataTable no-footer dtr-inline " id="example2"
                                                           role="grid" aria-describedby="example2_info">
                                                        <thead >
                                                            <tr>
                                                                <th class="wd-lg-20p"> <span>{{__('Subject')}}</span> </th>
                                                                <th class="wd-lg-20p"> <span>{{__('Code')}}</span> </th>
                                                                <th class="wd-lg-20p"> <span>{{__('Price')}}</span> </th>
                                                                <th class="wd-lg-20p"> <span>{{__('Create date')}}</span> </th>
                                                                <th scope="col">{{__('Expiration date')}}</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($orders as $order)
                                                            <tr>
                                                                
                                                                <td>{{$order->pack_title}}</td>
                                                                <td>{{$order->code}}</td>
                                                                <td>$ {{$order->price}}</td>
                                                                <td>{{ $order->created_at }}</td>
                                                                <td>{{ $this->status($order->id)}}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                {{$orders->links()}}
                                            </div>
                                        </table>
                                    </div>
                                    @if($readyToLoad)
                                    {{$data_info->links()}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

