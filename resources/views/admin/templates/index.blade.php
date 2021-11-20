
@extends('admin.top-nav')
@section('page_title', trans('operations'))
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
                                    <p class="box-title">
                                        {{ trans('Topics') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <div class="box box-solid panel-wb">
                        <!-- /.box-header -->
                        @foreach($topics as $topic)
                            <div class="box-body" style="padding: 0 ;">
                                <div class="row">
                                    <div class="col-lg-12 col-xs-6">
                                        <div class="small-box bg-white">
                                            <a href="#" class="btn form-control topic"  id="{{ $topic->id }}">
                                                <i class="fas fa-layer-group"></i>
                                                {{ $topic->name }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    <!-- /.box-body -->
                    </div>
                    <!-- /.box -->


                </div>
                <div class="col-md-9">
                    <div class="box box-success">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="box-title">
                                        {{ trans('Templates') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="box-body" >
                            <div class="row" id="templates">
                                <div class="row">

                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>



@endsection

@section('laraform_script1')
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>

    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>

    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4bZln12ut506FLipFx-kXh95M-zZdUfc&libraries=places&callback=initMap" defer></script>

@endsection

@section('page-script')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="{{ asset('assets/js/custom/pages/response-summary.js') }}"></script>

    <script>
        $('.topic').on('click', function (e) {
            let topic_id = e.target.id;
            $.get('/json-templates?topic_id=' + topic_id,function(data) {
                $('#templates').empty();
                $('#templates').append(data);
            });
        });



    </script>

@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>
@endsection
