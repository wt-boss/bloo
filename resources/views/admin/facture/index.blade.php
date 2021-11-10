@extends('admin.top-nav')
@section('page_title', trans('Dashboard'))


@section('title', 'Accueil')

@section('laraform_script1')
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>
@endsection

@section('laraform_script2')
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
@endsection

@section('plugin-scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>

@endsection



@section('content')

    @include('partials.alert', ['name' => 'index'])

    <div class="panel panel-flat panel-wb">
        <div class="panel-body" style="padding: 0;">
            <div class="row">
                <a href="/compte">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-white">
                            <div class="inner">
                                <h3>{{$comptes->count()}}</h3>

                                <p>{{ trans('accounts') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-briefcase"></i>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="/operation">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-white">
                            <div class="inner">
                                <h3>{{$operations->count()}}</h3>

                                <p>{{ trans('operations') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-social-buffer"></i>
                            </div>
                        </div>
                    </div>
                </a>
                @if (auth()->user()->hasRole('Superadmin|Client'))
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-white">
                            <div class="inner">
                                <h3>{{$operateurs->count()}}</h3>

                                <p>{{ trans('Factures') }}</p>
                            </div>
                            <div class="icon">

                                <i class="ion ion-document-text"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-white">
                            <div class="inner">
                                <h3>{{$rapports->count()}}</h3>

                                <p>{{ trans('Credit') }}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-social-usd"></i>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-8 col-xs-12">
                    <!-- DONUT CHART -->
                    <div class="box" style="height: 100%;">
                        <div class="box-header with-border">
                            <ul class="box-title" style="font-size: 15px;;">
                                <li>{{ trans('client_bill') }}</li>
                            </ul>
                        </div>
                        <div class="box-body">
                            <div  style="padding: 15px">
                                <table id="factures-tab" class="table stripe">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th class="text-center" style="color:#0065A1 !important">{{ trans('Description') }}</th>
                                        <th class="text-center" style="color:#0065A1 !important">{{ trans('Status') }}</th>
                                        <th class="text-center "style="color:#0065A1 !important">{{ trans('Date') }}</th>
                                        <th class="text-center "style="color:#0065A1 !important">{{ trans('Prix') }}</th>
{{--                                        <th class="text-center "style="color:#0065A1 !important">{{ trans('actions') }}</th>--}}

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($factures as $facture)
                                        <tr>
                                            <td></td>
                                            <td class="text-center">{{ $facture->description }} <br><span style="font-size: 11px"><a href="">{{$facture->updated_at.' - '}}</a><a href="#">{{$facture->updated_at->addMonth(1)}}</a></span></td>
                                            <td class="text-center">{{ $facture->state }} <br><span style="font-size: 11px"><a href="">view invoice</a></span></td>
                                            <td class="text-center">{{ $facture->date }}</td>
                                            @if($facture->state=='paid')
                                                <td class="text-center">{{ "$".$facture->Total  }}</td>
                                            @else
                                                <td class="text-center">
                                                    <form action="{{route('paypal')}}" method="POST"><input type="text" value="{{$facture->id}}" hidden> <button class="btn-bloo" type="submit">Pay</button></form></td>
                                                @endif
{{--                                            <td class="text-center" >--}}
{{--                                                --}}{{--                                        <a href="{{ route('offers.show', [$offer->id]) }}" class="btn btn-xs btn-info mb-5" style="background-color: #0065A1;"><i class="fa fa-eye" aria-hidden="true"></i></a>--}}
{{--                                                --}}{{--                                        <a href="{{  route('offers.edit', [$offer->id]) }}" class="btn btn-xs btn-primary  mb-5 position-right" style="background-color: #0065A1;" data-target="#modal" data-toggle="modal"><i class="fa fa-edit"></i></a>--}}
{{--                                                <a href="#" class="btn btn-xs btn-primary  mb-5 position-right" style="background-color: #0065A1;" data-target="#myModal-{{$offer->id}}" data-toggle="modal"><i class="fa fa-edit"></i></a>--}}
{{--                                                --}}{{--                                        @if(Auth::user()->rolename() == "Superadmin")--}}
{{--                                                --}}{{--                                            <form  id="myForm" class="btn btn-xs  position-right" method="POST" action="{{route('offers.destroy', [$offer->id]) }}" > @csrf @method('DELETE')--}}
{{--                                                --}}{{--                                                <button  class="btn btn-xs btn-primary  mb-5 position- submit" style="background-color: #0065A1;" > <i class="fa fa-trash"></i> </button>--}}
{{--                                                --}}{{--                                            </form>--}}
{{--                                                --}}{{--                                        @endif--}}
{{--                                            </td>--}}
                                        </tr>
{{--                                        @include('admin.offers.offer_modal',['offer'=>$offer])--}}
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

{{--                            <div id="piechart" style="width: 500px; height: 400px;"></div>--}}
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-lg-4 col-xs-12">
                    <div class="box ">
                        <div class="box-header with-border">
                            <ul class="box-title" style="font-size: 15px;">
                                <li>{{ trans('operators') }}</li>
                            </ul>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="operateur_select">
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin-scripts')
    <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>
@endsection

@section('page-script')
    <script>
        $(function() {
            $('#factures-tab').DataTable({

                "language": {
                    @if( app()->getLocale() === "fr" )
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
                    @endif
                            @if( app()->getLocale() === "en")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
                    @endif
                            @if( app()->getLocale() === "es")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
                    @endif
                            @if( app()->getLocale() === "pt")
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese.json"
                    @endif
                },

                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                columnDefs: [
                    {
                        className: 'control',
                        orderable: false,
                        targets:   0
                    },
                    {
                        orderable: false,
                        targets: [-1]
                    },
                    { responsivePriority: 1, targets: 0 },
                ],
            });

            // Enable Select2 select for the length option
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity,
                width: 'auto'
            });
            // Set onclick cbg-colour .btn-success
        });
    </script>

@endsection


