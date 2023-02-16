<div>
    @section('title',__('Add language'))
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5">Add language</h2><br>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.language')}}">languages</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Add language</li>
                    </ol>
                </div>
                <div>
                    <a data-toggle="tooltip" href="{{route('admin.language')}}" class="btn btn-warning text-white"  data-original-title="back">
                        <i class="fa fa-backward"></i>
                    </a>
                    <button class="btn btn-primary my-2 btn-icon-text"  form="formInfo"  wire:loading.attr="disabled"  wire:loading.remove wire:target="saveInfo"> 
                        save
                    </button>                   
                    <div wire:loading wire:target="saveInfo">
                        <div class="spinner-border text-primary" role="status"></div>
                    </div>
                </div>
            </div>
            @include('livewire.admin.layouts.error')
            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <div>
                                <h6 class="main-content-label mb-1">Add language</h6>
                                <p class="text-muted card-sub-title">It is necessary to fill in the fields marked with (*)</p>
                            </div>
                            <form id="formInfo" wire:submit.prevent="saveInfo()" role="form" >

                                <div class="form-group row">
                                    <label class="col-md-2">language: </label>
                                    <div class="col-md-5">
                                        <select type="text"  class="form-control @error('name') is-invalid @enderror"  wire:model.defer="name">
                                            <option value="">select</option>
                                            @foreach($languages as $lang)
                                            <option value="{{$lang->id}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <table id="images" class="table table-hover table-custom spacing8">
                                    <thead>
                                        <tr>
                                            <td >phrase</td>
                                            <td >translate</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pharas as $phara)
                                        <tr id="image-row5">  
                                            <td class="text-left" style="width: 50%">
                                                <div class="border p-2" >{{$phara->key}}<div>
                                            </td>
                                            <td class="text-right">
                                                <textarea type="text" wire:model.defer="phara.{{$phara->id}}" class="form-control" placeholder="translation"></textarea>
                                            </td> 
                                        @endforeach
                                        </tr>
                                    </tbody>

                                </table>

                            </form>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
