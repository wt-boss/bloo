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
                            @foreach($operations as $operation)
                            <li id="{{$operation->id}}">
                                <div class="cir-image" id="{{$operation->id}}">
                                    <div class="widget-user-image text-center op-msg-list operation" id="{{$operation->id}}">
                                        <img src="{{ asset('assets/images/bg_1.jpg') }}" alt="LOGO HERE" class="img-circle" id="{{$operation->id}}">
                                        <p id="{{$operation->id}}">{{$operation->nom}}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
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
                                <ul class="nav nav-stacked" id="lecteur">
                                </ul>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="box" style="height: 100%;">
                            <div class="box-header with-border">
                                <ul class="box-title"  >
                                    <li>Operateurs</li>
                                </ul>
                            </div>
                            <div class="box-body">
                                <ul class="nav nav-stacked"  id="operateur">
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
        $('.operation').on('click', function(e){
            console.log(e);
            var operation_id = e.target.id
            $.get('/json-lecteurs?operation_id=' + operation_id,function(data) {
                console.log(data);
                $('#lecteur').empty();
                $.each(data, function(index, lecteurObj){
                    $('#lecteur').append('<li id="'+ lecteurObj.id +'">'+ lecteurObj.first_name +'</li>');
                })
            });

            $.get('/json-operateurs?operation_id=' + operation_id,function(data) {
                console.log(data);
                $('#operateur').empty();
                $.each(data, function(index, operateurObj){
                    $('#operateur').append('<li id="'+ operateurObj.id +'">'+ operateurObj.first_name +'</li>');
                })
            });
        });
    </script>
@endsection



@section('laraform_script1')
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>
@endsection


@section('laraform_script2')
    {{-- <script src="{{ asset('assets/js/core/app.js') }}"></script> --}}
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
@endsection
