@extends('admin.top-nav')

@section('content')

    <div class="panel panel-flat panel-wb">
        <div class="panel-body" style="padding: 0;">
            <div class="row">
                <div class="col-md-12">
                    <div class="box" style="height: 100%;">
                        <div class="box-header with-border">
                            <ul class="box-title" style="padding-left: 4px;">
                                <li>{{ trans('response_stats') }}</li>

                                <li class="dropdown">
                                    <a class="dropdown-toggle" style="color:#0065A1; font-size:16px;" data-toggle="dropdown" href="#">
                                        {{ trans('sort_by') }} <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-item" role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <span class="pull-right">
                            <i class="fa fa-file-powerpoint" style="font-size: 20px" aria-hidden="true"></i>

                             <a id="download_pdf">
                                <i class="fa fa-file-pdf"  style="font-size: 20px" aria-hidden="true" ></i>
                             </a>

                            <a href="{{ route('forms.response.export', $form->code) }}">
                                <i class="fa fa-file-excel"  style="font-size: 20px" aria-hidden="true">  </i>
                            </a>
                        </span>
                        </div>

                        <div class="box-body row" id="responses">
                            {!! $view !!}
                        </div>

                        <div class="box-body row" id="responsesprint">
                            {!! $viewprint !!}
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
