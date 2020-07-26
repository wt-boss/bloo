@extends('admin.top-nav')

@section('content-header')
@endsection

@section('content')
<div class="panel panel-flat panel-wb">
    <div class="panel-body" style="padding: 0;">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-success">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="box-title">
                                    Operations
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="box-body" id="lecteurs">

                        <ul class="nav nav-stacked">
                            <li>
                                <div class="cir-image">
                                    <div class="widget-user-image text-center op-msg-list">
                                        <img src="{{ asset('assets/images/bg_1.jpg') }}" alt="LOGO HERE" class="img-circle" />
                                        <p>Cedric NOUMBO</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="cir-image">
                                    <div class="widget-user-image text-center op-msg-list">
                                        <img src="{{ asset('assets/images/bg_1.jpg') }}" alt="LOGO HERE" class="img-circle" />
                                        <p>Cedric NOUMBO</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box" style="height: 100%;">
                            <div class="box-header with-border">
                                <ul class="box-title">
                                    <li>Lecteurs</li>
                                </ul>
                            </div>
                            <div class="box-body">
                                <ul class="nav nav-stacked">
                                    <li>
                                        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                           cedric noumbo
                                        </font>
                                    </li>
                                    <li>
                                        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                           cedric noumbo
                                        </font>
                                    </li>
                                    <li>
                                        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                           cedric noumbo
                                        </font>
                                    </li>
                                    <li>
                                        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                           cedric noumbo
                                        </font>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="box" style="height: 100%;">
                            <div class="box-header with-border">
                                <ul class="box-title">
                                    <li>Operateurs</li>
                                </ul>
                            </div>
                            <div class="box-body">
                                <ul class="nav nav-stacked">
                                    <li>
                                        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                           cedric noumbo
                                        </font>
                                    </li>
                                    <li>
                                        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                           cedric noumbo
                                        </font>
                                    </li>
                                    <li>
                                        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                           cedric noumbo
                                        </font>
                                    </li>
                                    <li>
                                        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                                           cedric noumbo
                                        </font>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box" style="height: 100%;">
                    <div class="box-header with-border">
                        <ul class="box-title">
                            <li>Mahamat Nour</li>
                        </ul>
                    </div>
                    <div class="box-body">

                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('admin_lte_script')

    <!-- jQuery 3 -->
    <script type="application/javascript"  src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script type="application/javascript">

    </script>
@endsection
