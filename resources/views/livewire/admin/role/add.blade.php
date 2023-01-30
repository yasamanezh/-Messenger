@section('title','Create Role')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Create Role</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.roles')}}">Roles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Role</li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="saveInfo" class="btn btn-primary my-2 btn-icon-text" type="submit"
                        wire:loading.attr="disabled" wire:loading.remove>save
                </button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('admin.roles')}}" class="btn btn-warning text-white"
                   data-original-title="برگشت">
                    <i class="fa fa-backward"></i>
                </a>
            </div>
        </div>
        @include('livewire.admin.layouts.error')
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                       Create Role
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label class="col-md-2">title: </label>
                                <div class="col-md-10">
                                    <input type="text"  placeholder="role title"
                                           class="form-control @error('name') is-invalid @enderror"
                                           wire:model.defer="name">
                                    @error('role.name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">description: </label>
                                <div class="col-md-10">
                                    <input type="text" name="label" placeholder="role description  "
                                           class="form-control @error('label') is-invalid @enderror"
                                           wire:model.defer="label">
                                    @error('label')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">show permission :</label>
                                <div class="col-sm-10">
                                    <div class="well well-sm scrollbar" id="style-1"
                                         style="height: 150px; overflow: auto;background-color: #f5f5f5;;padding: 20px">
                                        <div class="checkbox">
                                            <label>
                                                <input wire:model="SelectShow" type="checkbox"> select all
                                            </label>

                                        </div>
                                        @foreach($showPermissions as $permission)
                                            <div class="checkbox">
                                                <label>
                                                    <input wire:model.defer="shows" type="checkbox" checked=""
                                                               value="{{$permission->id}}"> {{$permission->description}}
                                                </label>
                                            </div>
                                        @endforeach
                                        
                                    </div>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label ">edit permission :</label>
                                <div class="col-sm-10">
                                    <div class="well well-sm scrollbar" id="style-1" style="height: 150px; overflow: auto;background-color: #f5f5f5;;padding: 20px">
                                       <div class="checkbox">
                                            <label>
                                                <input wire:model="SelectEdit" type="checkbox">select all
                                            </label>

                                        </div>
                                        @foreach($editPermissions as $permission)
                                            <div class="checkbox">
                                                <label> <input wire:model.defer="edits" type="checkbox"
                                                               value="{{$permission->id}}"> {{$permission->description}}
                                                </label>
                                            </div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label">delete permission:</label>
                                <div class="col-sm-10">
                                    <div class="well well-sm scrollbar" id="style-1"
                                         style="height: 150px; overflow: auto;background-color: #f5f5f5;;padding: 20px">
                                        <div class="checkbox">
                                            <label>
                                                <input wire:model="SelectDelete" type="checkbox">select all
                                            </label>

                                        </div>
                                        @foreach($deletePermissions as $permission)
                                            <div class="checkbox">
                                                <label> <input wire:model.defer="delets" type="checkbox"
                                                               value="{{$permission->id}}"> {{$permission->description}}
                                                </label>
                                            </div>
                                        @endforeach
                                        
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

