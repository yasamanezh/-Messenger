@section('title','Languages')
<div class="container-fluid">
    <div class="inner-body" wire:init="loadPage">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Languages</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Languages</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center mr-1">
                    <a href="{{route('admin.language.add')}}" class="btn ripple btn-primary text-white"> Add Language <i class="fa fa-plus-circle ml-0"></i> </a>
                </div>
                <div class="justify-content-center">
                    <a wire:click.prevent="confirmCreate()" class="btn ripple btn-primary text-white"> Add Phrase <i class="fa fa-plus-circle ml-0"></i> </a>
                </div>
  
            </div>
        </div>
        @include('livewire.admin.layouts.message')
        <div class="row">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        Languages
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
                                                        <input name="selected"  wire:model="SelectPage" type="checkbox"><span class="tx-13"></span>
                                                    </label>
                                                </th>
                                                <th>name</th>
                                                <th>create date</th>

                                                <th class="wd-lg-5p">opration</th>
                                            </tr>
                                        </thead>
                                        @if($readyToLoad)
                                        <tbody>
                                            <tr role="row">
                                                <td>
                                                    <label class="ckbox">
                                                        <input disabled="" name="selected" type="checkbox"><span class="tx-13"></span>
                                                    </label>
                                                </td>
                                                <td> english</td>
                                                <td> 2023-02-09 18:52:29</td>                                                
                                                <td>
                                                  <a href="{{route('admin.pharas')}}"
                                                       class="btn btn-sm btn-info">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>  
                                                </td>
                                            </tr>
                                            @foreach($languages as $value)
                                            <tr role="row">
                                                <td>
                                                    <label class="ckbox">
                                                        <input name="selected" value="{{$value->id}}"
                                                               wire:model="mulitiSelect" type="checkbox"><span
                                                               class="tx-13"></span>
                                                    </label>
                                                </td>
                                                <td> {{$value->language->name}}</td>
                                                <td> {{$value->created_at}}</td>                                                
                                                <td>
                                                    <a href="{{route('admin.language.edit',$value->language->id)}}"
                                                       class="btn btn-sm btn-info">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
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
                                    {{$languages->render()}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.admin.layouts.modals')
     <!-- Modal -->
    <div class="modal fade" id="form1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <h4>create new pharas</h4>
                    <input class="form-control" wire:model.defer="key" placeholder="key">
                     @error('key')<div class="help-block with-errors text-danger">{{$message}}</div>@endif
                    <br>
                    <input class="form-control" wire:model.defer="value" placeholder="value">
                     @error('value')<div class="help-block with-errors text-danger">{{$message}}</div>@endif
                </div>
                <div class="modal-footer">
                    <button type="button"   wire:click.prevent="canncelAdd" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times ml-1"></i> Cancell
                    </button>
                    <button type="button"  wire:click.prevent="saveInfo" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>ok
                    </button>
                </div>
            </div>
        </div>
    </div>
  @push('jsPanel')
    <script>
        window.addEventListener('hide-form1', event => {
            $('#form1').modal('hide');
        })

        window.addEventListener('show-form1', event => {
            $('#form1').modal('show');
        })


    </script>
    @endpush
</div>

