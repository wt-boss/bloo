@extends('admin.top-nav')


@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
            <small>Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li>
            <li><a href="#"><i class="fas fa-user"></i> Users </a></li>
            <li class="active">Profile</li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="row">
        @foreach($comptes as $compte)
        <div class="col-md-3">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username">Alexander Pierce</h3>
                    <h5 class="widget-user-desc">Founder &amp; CEO</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">3,200</h5>
                                <span class="description-text">SALES</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">13,000</h5>
                                <span class="description-text">FOLLOWERS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">35</h5>
                                <span class="description-text">PRODUCTS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
            @endforeach
            <div class="col-md-3">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-aqua-active">
                        <h3 class="widget-user-username">Alexander Pierce</h3>
                        <h5 class="widget-user-desc">Founder &amp; CEO</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class=" col-8">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
                                </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
    </div>
@endsection

@section('laraform_script1')
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>

@endsection
