
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
                                            <i class="fa fa-plus-circle pull-right" aria-hidden="true" id="getlecteur"  data-toggle="modal" data-target="#modal-default"></i>
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
                                    <i class="fa fa-plus-circle pull-right" aria-hidden="true" id="getlecteur"  data-toggle="modal" data-target="#template-default"></i>
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


    <div class="modal fade bd-example-modal-lg"  id="modal-default" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span>
                    </button>
                    <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ trans('Create a topic')}}</font></font></h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('topics.store') }}">
                        @csrf
                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control" name="name" id="name" placeholder="@lang("Name")" value="{{ old('name') }}" required autofocus>
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control" name="description" id="description" placeholder="@lang("Description")" value="{{ old('description') }}" required autofocus>
                            <div class="form-control-feedback">
                                <i class="icon-book3 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn bg-teal btn-block">{{ trans('savee') }} <i class="icon-arrow-right14 position-right"></i></button>
                        </div>

                        <div class="content-divider text-muted form-group"><span></span></div>
                        <button type="button" class="btn btn-default btn-block content-group" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ trans('Close') }}</font></font></button>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade bd-example-modal-lg"  id="template-default" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">×</font></font></span></button>
                    <h4 class="modal-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ trans('Create a template') }}</font></font></h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('templates.store') }}">
                        @csrf
                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control" name="name" id="name" placeholder="@lang("Name")" value="{{ old('name') }}" required autofocus>
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control" name="description" id="description" placeholder="@lang("Description")" value="{{ old('description') }}" required autofocus>
                            <div class="form-control-feedback">
                                <i class="icon-book3 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <select class="form-control" name="topic_id" id="description">
                                @foreach($topics as $topic)
                                    <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-control-feedback">
                                <i class="icon-book3 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn bg-teal btn-block">{{ trans('savee') }} <i class="icon-arrow-right14 position-right"></i></button>
                        </div>

                        <div class="content-divider text-muted form-group"><span></span></div>
                        <button type="button" class="btn btn-default btn-block content-group" data-dismiss="modal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ trans('Close') }}</font></font></button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
            $.get('/json-templates2?topic_id=' + topic_id,function(data) {
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
