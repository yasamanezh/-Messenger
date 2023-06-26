@section('title','Image manager ')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Image manager </h2><br>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Image manager </li>
                </ol>
            </div>
            <div>
                <a class="btn btn-primary text-white my-2 btn-icon-text" href="" wire:click.prevent="create()">Add
                    <i class="fa fa-plus-circle"></i>
                </a>
            </div>
            
        </div>
        @include('livewire.admin.layouts.message')
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        Images
                       
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive scrollbar" id="style-1">
                                        <table class="table dataTable no-footer dtr-inline " id="example2"
                                               role="grid" aria-describedby="example2_info">
                                            <thead>
                                                <tr role="row">
                                                    
                                                    
                                                    <th>image</th>
                                                    <th>
                                                        link
                                                    </th>
                                                    
                                                </tr>
                                            </thead>
                                           
                                            <tbody>
                                                @foreach($images as $info)
                                                <tr role="row">
                                                    
                                                    <td>
                                                        <img src="/storage/{{$info->file}}" style="width:100px;height:100px"  />
                                                    </td>
                                                    <td>
                                                        <a href="{{$link}}/storage/{{$info->file}}">{{$link}}/storage/{{$info->file}}</a>
                                                       
                                                    </td>
                                                    
                                                </tr>
                                                @endforeach
                                            </tbody>
                                           
                                        </table>
                                    </div>
                                    
                                   
                                   
                                </div>
                            </div>
                        </div>
                    </div>
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
                   <div class="form-group row">
                                                <label class="form-label col-sm-3">image: <span class="tx-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    @if($uploadImage)
                                                    <img src="{{ $uploadImage->temporaryUrl() }}"  style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;" id="picture">
                                                    @else
                                                    <img id="picture"  style="width: 200px;height:200px;padding: 10px;border:2px dashed #ddd;cursor: pointer;" src="{{ asset('admin/img/uploadicon.png')}}">
                                                    @endif
                                                    <br>
                                                    <input type="file" class="form-control " style="display:none" id="fileinput"
                                                           wire:model.defer="uploadImage" accept="image/*">
                                                    <span class="mt-2 text-danger" wire:loading
                                                          wire:target="image">uploading...</span>
                                                    <br>
                                                    @error('uploadImage')
                                                    <div class="invalid-feedback display-block" style="display: block">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click.prevent="cancell()"><i
                            class="fa fa-times ml-1"></i> Cancel
                    </button>
                    <button type="button"  wire:click.prevent="saveInfo()"  class="btn btn-danger">
                        <i  class="fa fa-trash ml-1"></i>Ok
                    </button>
                    
                </div>
            </div>
        </div>
    </div>

</div>
@push('jsPanel')
<script>


    window.addEventListener('show-modal', event => {
        $('#form').modal('show');
    })

    window.addEventListener('hide-modal', event => {
        $('#form').modal('hide');
    })

 

</script>
@endpush


