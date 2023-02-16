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
    @section('title',__('Modules'))
    <div class="container-fluid">
        <div class="inner-body">
            <div class="page-header">
                <div>
                    <h2 class="main-content-title tx-24 mg-b-5"> Modules</h2><br>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('Dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.modules')}}">Modules</a></li>
                    </ol>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="card custom-card">
                        <div class="card-header p-3 tx-medium my-auto tx-white bg-primary flex-1">
                            <span>Modules</span>
                        </div>
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="btn btn-list" style="width: 100%">
                                    <a href="{{route('admin.module.top')}}" class="btn ripple btn-light btn-lg btn-block"><i class="fe fe-folder"></i> top page </a>
                                    <a href="{{route('admin.module.feature')}}" class="btn ripple btn-light btn-lg btn-block"> <i class="fe fe-link"></i> feature</a>
                                    <a href="{{route('admin.module.about')}}" class="btn ripple btn-light btn-lg btn-block"><i class="fe fe-users"></i>about </a>
                                    <a href="{{route('admin.module.feature2')}}" class="btn ripple btn-light btn-lg btn-block"> <i class="fe fe-link"></i> feature2</a>
                                    <a href="{{route('admin.module.screen')}}" class="btn ripple btn-light btn-lg btn-block"><i class="fe fe-briefcase"></i> screen</a>
                                    <a href="{{route('admin.module.video')}}" class="btn ripple btn-light btn-lg btn-block"><i class="fe fe-airplay"></i> video </a>
                                    <a href="{{route('admin.module.counters')}}" class="btn ripple btn-light btn-lg btn-block"> <i class="fa fa-check"></i>Counters </a>
                                    <a href="{{route('admin.module.download')}}" class="btn ripple btn-light btn-lg btn-block"> <i class="fe fe-download-cloud"></i> download </a>
                                    <a href="{{route('admin.module.pack')}}" class="btn ripple btn-light btn-lg btn-block"> <i class="typcn typcn-tabs-outline"></i>Packages </a>
                                    <a href="{{route('admin.module.customer')}}" class="btn ripple btn-light btn-lg btn-block"> <i class="fe fe-user"></i>customer </a>
                                    <a href="{{route('admin.module.blog')}}" class="btn ripple btn-light btn-lg btn-block"> <i class="typcn typcn-contacts"></i>Blogs </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
