@section('title','newsletter')
<div class="container-fluid">
    <div class="inner-body" wire:init="loadPage">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">newsletter</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">newsletter</li>
                </ol>
            </div>
        </div>
        @include('livewire.admin.layouts.message')
        <div class="row">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        newsletter
                        @if(count($deleteItem) >=1 )
                        <span class="float-right">
                            <a href="" wire:click.prevent="confirmAllRemoval()"
                               class="btn btn-sm btn-danger">delete ({{count($deleteItem)}})
                            </a>
                        </span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div>
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
                                <div  class="table-responsive scrollbar" id="style-1" >
                                    <table class="table dataTable no-footer dtr-inline ">
                                        <thead role="rowgroup">
                                            <tr role="row" class="title-row">
                                                <th style="padding-right: 15px;" class="wd-lg-5p">
                                                    <label class="ckbox">
                                                        <input name="selected"  wire:model="SelectPage"
                                                               type="checkbox"><span
                                                               class="tx-13"></span>
                                                    </label>
                                                </th>

                                                <th>email</th>

                                                <th class="wd-lg-5p">opration</th>
                                            </tr>
                                        </thead>
                                        @if($readyToLoad)
                                        <tbody>
                                            @foreach($contacts as $value)
                                            <tr role="row">
                                                <td>
                                                    <label class="ckbox">
                                                        <input name="selected" value="{{$value->id}}"
                                                               wire:model="mulitiSelect" type="checkbox"><span
                                                               class="tx-13"></span>
                                                    </label>
                                                </td>

                                                <td> {{$value->email}}</td>


                                                <td>

                                                    <a href="" wire:click.prevent="confirmRemoval({{$value->id }})" class="btn btn-sm btn-danger">
                                                        <i class="fe fe-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        @else
                                        <div class="alert-warning alert">
                                            waiting...
                                        </div>
                                        @endif
                                    </table>
                                    @if($readyToLoad)
                                    {{$contacts->render()}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        create newsletter
                    </div>
                    <div class="card-body">

                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            @if($success)
                            <div class="alert alert-success">
                                <ul>
                                    <li>{{$success}}</li>
                                </ul>
                            </div>
                            @endif

                            <form wire:submit.prevent="save"
                                  enctype="multipart/form-data" role="form"
                                  class="padding-10 categoryForm">

                                <div class="form-group">
                                    <input  wire:model.lazy="email"
                                            placeholder="email "
                                            class="form-control">
                                </div>
                                @error('email')
                                <div class="invalid-feedback display-block" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror

                                <button class="btn btn-primary text-white">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('livewire.admin.layouts.modals')

</div>

