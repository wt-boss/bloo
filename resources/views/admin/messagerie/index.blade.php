@extends('admin.top-nav')

@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
            <small>Panneau de control</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"> <i class="fas fa-tachometer-alt"></i> Tableau de bord</a></li>
            <li class="active">Users</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-yellow">
                    <h5 class="widget-user-desc">Operations</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        @foreach($operations as $opera)
                        <li  class="operation" title="{{$opera->id}}" > {{$opera->nom}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        <div class="col-md-9">
            <private :user="{{auth()->user()}}" :operation="{{$operation->id}}"></private>
        </div>
    </div>
@endsection

@section('admin_lte_script')

    <!-- jQuery 3 -->
    <script type="application/javascript"  src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script type="application/javascript">
        $('.operation').on('click', function (e) {
            console.log(e);
            var operation_id = e.target.title;
            var user_id = e.target.title;
            $.get('/removelecteurs/' + user_id + '/' + operation_id , function (data) {
                if(data && $.parseJSON('true') === true){
                    $(e.target).parents('li').remove();
                }
            });
            // $.post('/messages_show/'+operation_id , function (data) {
            //     console.log(data);
            // });
        });
    </script>
@endsection
