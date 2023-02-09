<div>
    <style>
        .btn-light{
            position: relative;
            width: 100%;
            font-weight: bold;
            font-size: 1.0rem;
            display: flex;
            margin: 10px 0 10px;
            justify-content: center;
            justify-content: flex-start;
            padding-left: 10px;
            background: #ebebf0;
            box-shadow: rgb(0 0 0 / 16%) 0px 3px 6px, rgb(0 0 0 / 5%) 0px 3px 6px;
        }
        .btn-light i {
            color: #6259ca;
            margin-right: 20px;
            font-weight: 900
        }
    </style>
    @section('title',__('Pages'))
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5"> pages</h2><br>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.modules')}}">pages</a></li>
                    </ol>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <div class="card-header p-3 tx-medium my-auto tx-white bg-primary flex-1">
                            <span>pages</span>
                        </div>
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="btn btn-list" style="width: 100%">
                                    <a href="{{route('admin.page.contact')}}" class="btn ripple btn-light btn-lg btn-block"><i class="fe fe-edit-2"></i> contact </a>
                                    <a href="{{route('admin.page.about')}}" class="btn ripple btn-light btn-lg btn-block"> <i class="fe fe-edit-2"></i> about</a>
                                    <a href="{{route('admin.page.faq')}}" class="btn ripple btn-light btn-lg btn-block"><i class="fe fe-edit-2"></i>faq </a>
                                    <a href="{{route('admin.page.feature')}}" class="btn ripple btn-light btn-lg btn-block"><i class="fe fe-edit-2"></i> feature</a>
                                    <a href="{{route('admin.page.work')}}" class="btn ripple btn-light btn-lg btn-block"><i class="fe fe-edit-2"></i> how to work </a>
                                    <a href="{{route('admin.page.pack')}}" class="btn ripple btn-light btn-lg btn-block"><i class="fe fe-edit-2"></i>packages </a>
                                    @foreach($pages as $page)
                                    @if($page->translateable->slug == 'faq' || $page->translateable->slug == 'feature' || $page->translateable->slug == 'how-to-work'|| $page->translateable->slug == 'pack' || $page->translateable->slug == 'about' || $page->translateable->slug == 'contact'   ) @continue   @endif

                                    <div  class="btn ripple btn-light btn-lg btn-block">
                                        <a href="{{route('admin.page.edit',$page->translateable_id)}}"><i class="fe fe-edit-2"></i></a>
                                        <a  wire:click.prevent="confirmRemoval({{$page->translateable->id }})" >
                                            <i class="fe fe-trash text-danger"></i>
                                        </a>
                                        {{$page->title}}

                                    </div>

                                    @endforeach

                                </div>
                            </div>
                            <br>
                            <div>
                                <a class="btn btn-primary" href="{{route('admin.page.add')}}">
                                    <i class="fa fa-plus-circle"></i>

                                </a>
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
