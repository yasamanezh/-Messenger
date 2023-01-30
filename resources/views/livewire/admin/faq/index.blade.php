<div>
@section('title',__('Faqs'))
<div class="container-fluid">
    <div class="inner-body" wire:init="loadPage"  >
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Faqs</h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Faqs</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="{{route('admin.faq.add')}}" class="btn ripple btn-primary"> Add <i class="fa fa-plus-circle ml-0"></i> </a>
                </div>
            </div>
        </div>
        @include('livewire.admin.layouts.message')
        <div class="row">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary flex-1">
                        <span>Faqs</span>
                        @if(count($deleteItem) >=1 )
                        <span class="pull-right" >
                            <a href="" wire:click.prevent="confirmAllRemoval()" class="btn btn-sm btn-danger">
                                delete (
                                {{count($deleteItem)}})
                            </a>
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
                            <div class="table-responsive">
                                <table class="table dataTable no-footer dtr-inline ">
                                    <thead role="rowgroup">
                                        <tr role="row" class="title-row">
                                            <th style="padding-right: 15px;" class="wd-lg-5p">
                                                <label class="ckbox">
                                                    <input name="selected" wire:model="SelectPage"  type="checkbox"><span lass="tx-13"></span>
                                                </label>
                                            </th>
                                            <th class="wd-lg-20p"><span>title</span>
                                                <span wire:click="sortBy('title')" class="float-right text-sm" style="cursor: pointer;">
                                                    <i class="fa fa-arrow-up {{ $sortColumnName === 'title' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                    <i  class="fa fa-arrow-down {{ $sortColumnName === 'title' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                                </span>
                                            </th>
                                            <th>
                                                created 
                                                <span wire:click="sortBy('created_at')" class="float-right text-sm" style="cursor: pointer;">
                                                    <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                    <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                                </span>
                                            </th>
                                            <th>status</th>
                                            <th>oprations</th>
                                        </tr>
                                    </thead>
                                    @if($readyToLoad)
                                    <tbody>
                                        @foreach($datas as $item)
                                        <tr role="row">
                                            <td>
                                                <label class="ckbox" >
                                                    <input name="selected"  value="{{$item->translateable->id}}" wire:model="mulitiSelect" type="checkbox"><span class="tx-13"></span>
                                                </label>
                                            </td>
                                            <td>{!! \Illuminate\Support\Str::limit($item->title,30,'...') !!}  </td>
                                            <td>{{ $item->created_at}}</td>
                                            <td>
                                                <label  wire:click.prevent="changeStatus({{$item->translateable->id}})" style="cursor: pointer;" class="custom-switch" >
                                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" {{$item->translateable->status==1 ? 'checked' :''  }}>
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.faq.edit',$item->translateable->id)}}" class="btn btn-sm btn-info">
                                                    <i class="fe fe-edit-2"></i>
                                                </a>
                                                <a href="" wire:click.prevent="confirmRemoval({{$item->translateable->id }})" class="btn btn-sm btn-danger">
                                                    <i class="fe fe-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    @else
                                    <div class="alert-warning alert">
                                        waiting ...
                                    </div>
                                    @endif
                                </table>
                            </div>
                            @if($readyToLoad)
                            {{ $datas->links() }}
                            @endif
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
                
                <div class="modal-body">
                    <h4>Are you sure you want delete this item ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click.prevent='cancelDelete()' data-bs-dismiss="modal"><i class="fa fa-times ml-1"></i> Cancell
                    </button>
                    <button type="button"  wire:click.prevent="delete" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>ok
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
                
                <div class="modal-body">
                    <h4>Are you sure you want delete this items ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  wire:click.prevent='cancellAllDelete()'><i
                            class="fa fa-times ml-1"></i> Cancel
                    </button>
                    <button type="button"  wire:click.prevent="deleteAll()" class="btn btn-danger"><i
                            class="fa fa-trash ml-1"></i>OK
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
</div>
