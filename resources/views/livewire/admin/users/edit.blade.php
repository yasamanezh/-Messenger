@section('title','edit usert')
<div class="container-fluid">
    <div class="inner-body">
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">edit usert</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.users')}}">users </a></li>
                    <li class="breadcrumb-item active" aria-current="page">edit usertر</li>
                </ol>
            </div>
            <div>
                <button wire:click.prevent="saveInfo" class="btn btn-primary my-2 btn-icon-text" type="submit"
                        wire:loading.attr="disabled" wire:loading.remove>save
                </button>
                <div wire:loading wire:target="saveInfo">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
                <a data-toggle="tooltip" href="{{route('admin.users')}}" class="btn btn-warning text-white"
                   data-original-title="back">
                    <i class="fa fa-backward"></i>
                </a>
            </div>
        </div>
        @include('livewire.admin.layouts.error')
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card">
                    <div class="card-header p-3 tx-medium my-auto tx-white bg-primary">
                        edit user
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name " class="form-label col-sm-2">Name:<span
                                        class="tx-danger"> * </span></label>
                            <input type="text" wire:model.defer="name"
                                   class="form-control col-sm-10 @error('name') is-invalid @enderror" id="name"
                                   aria-describedby="nameHelp" placeholder="Enter Name">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="form-label col-sm-2">Email:
                                <span class="tx-danger"> * </span>
                            </label>
                            <input type="text" wire:model.defer="email"
                                   class="form-control col-sm-10 @error('email') is-invalid @enderror"
                                  placeholder="Enter email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="password" class="form-label col-sm-2">password: <span class="tx-danger"> * </span></label>
                            <input type="password" wire:model.defer="password"
                                   class="form-control col-sm-10 @error('password') is-invalid @enderror" id="password"
                                   placeholder="password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label for="passwordConfirmation" class="form-label col-sm-2">password confirmation:</label>
                            <input type="password" wire:model.defer="password_confirmation"
                                   class="form-control col-sm-10"  placeholder="password confirmation">
                        </div>
                        <div class="form-group row">
                            <label for="role" class="form-label col-sm-2">Role:</label>
                            <select class="form-control col-sm-10" wire:model="role">
                                <option value="admin">adminn</option>
                                <option value="Employee">Employee</option>
                                <option value="user">user</option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback display-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div style="display: {{$role =='Employee' ? 'block':'none'}}">
                            <div  class="form-group row">
                                <label for="AdminRoles" class="form-label col-sm-2">Permissions :</label>
                                <div class="col-sm-10">
                                    
                                    <x-inputs.select2 wire:model.defer="AdminRoles" id="AdminRoles">
            
                                        @foreach($roles as $value)
                                            <option value="{{$value->id}}">{{$value->label}}</option>
                                        @endforeach
                                    </x-inputs.select2>
                                    @error('AdminRoles')
                                    <div class="invalid-feedback display-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('jsBeforCustomJs')
<!-- Select2 -->
<script src="{{ asset('admin/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(function () {
            $('#AdminRoles').select2({
                theme: 'bootstrap4',
            }).on('change', function () {
                @this.
                set('AdminRoles', $('#AdminRoles').val());
            })
        })
    </script>
@endpush



