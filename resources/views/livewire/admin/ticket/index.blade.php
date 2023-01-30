@section('title','tickets')
<div class="container-fluid" wire:init="loadMenu">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">tickets</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">tickets</li>
                </ol>
            </div>
             <div>
                <a class="btn btn-primary my-2 btn-icon-text" href="{{route('admin.ticket.add')}}">Add
                    <i class="fa fa-plus-circle"></i>
                </a>

            </div>
        </div>
        @include('livewire.admin.layouts.message')
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        tickets
                        @if(count($deleteItem) >=1 )
                        <span class="float-left">
                            <a href="" wire:click.prevent="confirmAllRemoval()" class="btn btn-sm btn-danger">حذف ({{count($deleteItem)}})</a>
                        </span>
                        @endif
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
                                    <div class="table-responsive scrollbar" id="style-1" >
                                        <table class="table dataTable no-footer dtr-inline " id="example2"
                                               role="grid" aria-describedby="example2_info">
                                            <thead >
                                                <tr>
                                                    <th style="padding-right: 15px;" class="wd-lg-5p">
                                                        <label class="ckbox">
                                                            <input name="selected" wire:model="SelectPage"
                                                                   type="checkbox"><span
                                                                   class="tx-13"></span>
                                                        </label>
                                                    </th>
                                                    <th>
                                                        created date
                                                        <span wire:click="sortBy('created_at')" class="float-right text-sm" style="cursor: pointer;">
                                                            <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                                        </span>
                                                    </th>
                                                    <th scope="col">part</th>
                                                    <th class="wd-lg-20p">
                                                        <span>title</span>
                                                        <span wire:click="sortBy('title')" class="float-right text-sm"  style="cursor: pointer;">
                                                            <i class="fa fa-arrow-up {{ $sortColumnName === 'title' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                            <i class="fa fa-arrow-down {{ $sortColumnName === 'title' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                                        </span>
                                                    </th>
                                                    <th scope="col">status</th>
                                                    <th scope="col">latest update</th>
                                                    <th scope="col">operation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($tickets as $ticket)
                                                <tr>
                                                    <td>
                                                        <label class="ckbox">
                                                            <input name="selected" value="{{$ticket->id}}" wire:model="mulitiSelect" type="checkbox">
                                                            <span class="tx-13"></span>
                                                        </label>
                                                    </td>
                                                    <td>{{ $ticket->created_at }}</td>
                                                    <td>{{$ticket->part}}</td>
                                                    <td>{{$ticket->title}}</td>
                                                    <td>{{$this->status($ticket->id)}}</td>
                                                    <td>{{ $ticket->updates_at}}</td>
                                                    <td>
                                                        <a href="{{route('admin.ticket.edit',$ticket->id)}}"  class="btn btn-sm btn-info">
                                                            <i class="fe fe-edit-2"></i>
                                                        </a>
                                                        <a href=""  wire:click.prevent="confirmRemoval({{ $ticket->id }})"
                                                           class="btn btn-sm btn-danger">
                                                            <i class="fe fe-trash"></i>
                                                        </a>
                                                        @if($ticket->status == 0)
                                                        <a href=""  class="btn btn-sm btn-danger">بسته </a>
                                                        @else
                                                        <a href=""   wire:click.prevent="close({{ $ticket->id }})" class="btn btn-sm btn-success">باز </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($readyToLoad)
                                    {{$tickets->links()}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>delete log</h5>
                </div>
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this item?</h4>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click.prevent="cancelDelete"><i
                            class="fa fa-times ml-1"></i> Cancel
                    </button>
                    <button type="button"  wire:click.prevent="delete" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>Ok
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>delete items</h5>
                </div>
                <div class="modal-body">
                    <h4>Are you sure you want to delete this items?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click.prevent="cancellAllDelete()"><i
                            class="fa fa-times ml-1"></i> Cancel
                    </button>
                    <button type="button"  wire:click.prevent="deleteAll()" class="btn btn-danger">
                        <i  class="fa fa-trash ml-1"></i>Ok
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
@push('jsPanel')
<script>

    window.addEventListener('hide-form', event => {
        $('#form').modal('hide');
    })

    window.addEventListener('show-form', event => {
        $('#form').modal('show');
    })

    window.addEventListener('show-delete-modal', event => {
        $('#confirmationModal').modal('show');
    })

    window.addEventListener('hide-delete-modal', event => {
        $('#confirmationModal').modal('hide');

    })
</script>
@endpush

