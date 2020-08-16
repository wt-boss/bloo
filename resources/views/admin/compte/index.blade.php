@extends('admin.top-nav')

@section('title', 'Manage Account')

@section('page-css')
    <!-- DataTables -->
    {{-- <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"> --}}
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-body" style="padding: 0;">
        @if (auth()->user()->hasRole('Superadmin|Account Manager'))
        <div class="panel-heading pull-right">
            <a href="{{route('compte.create')}}" class="btn btn-bloo heading-btn legitRipple"><i class="fas fa-plus-circle"></i> Creer un compte</a>
        </div>
            @endif
    </div>
    @if (auth()->user()->hasRole('Superadmin|Account Manager'))
        @if ($comptes->isEmpty())
            <div class="panel-body text-center">
                <div class="mt-30 mb-30">
                    <h6 class="text-semibold">
                            Creer des maintenant votre premiere entreprise
                    </h6>
                </div>
            </div>
        @else
            <div class="panel panel-flat">
                <!-- /.box-header -->
                <div  style="padding: 15px">
                    <table id="account-tab" class="table stripe operations">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                                $count = $comptes->count();
                                $lineCount = ceil($count / 4);
                                $currentLine = 0;
                            @endphp
                            @foreach($comptes as $compte)
                                @if ($i % 4 == 0)
                                    @php
                                        $currentLine++;
                                    @endphp
                                    <tr>
                                        <td></td>
                                @endif
                                <td>
                                    <div class="col-xs-12">
                                        <!-- Widget: user widget style 1 -->
                                        <div class="box box-widget widget-user">
                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                            <div class="widget-user-header bg-b-blue-gradient">
                                            </div>
                                            <div class="widget-user-image">
                                                <img class="img-circle" src="{{asset('assets/images/about.jpg')}}" alt="User Avatar">
                                            </div>
                                            <div class="box-footer">
                                                <div class="row">
                                                    <div class="col-sm-12 border-right">
                                                        <div class="description-block">
                                                            <span style="color: #0065A1;">
                                                                @php echo !empty($compte->users()->where('role','4')->get()->pluck('last_name')->last()) ?
                                                                        $compte->users()->where('role','4')->get()->pluck('last_name')->last() :
                                                                        trans('no account manager');
                                                                @endphp
                                                            </span>
                                                            <h5 class="description-header" title="{{$compte->nom}}">{{$compte->nom}}</h5>
                                                            <span class="description-text">
                                                                Type Compte (
                                                                @if($compte->type === "Personne Physique")
                                                                    Particulier
                                                                @else
                                                                    Entreprise
                                                                @endif
                                                                )
                                                            </span>
                                                            <span class="description-text">{{$compte->ville}} {{$compte->pays}}</span>
                                                            <span class="description-text">{{$compte->operations->count()}} operations</span>
                                                            <span class="description-text">{{$compte->email}}</span>
                                                            @if (auth()->user()->hasRole('Superadmin'))
                                                            <button class=" btn btn-xs-bloo"  data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-cog"></i> Parametres</button>
                                                            @endif
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
                                </td>
                                @if($currentLine == $lineCount && $i+1 == $count)
                                    @php $remain =  $lineCount * 4 - ($i+1); @endphp
                                    @for($j = 0; $j < $remain; $j++)
                                        <td>
                                            <div class="col-xs-12">
                                                <div class="box box-widget widget-user"></div>
                                            </div>
                                        </td>
                                    @endfor
                                    </tr>
                                @else
                                    @if ($i+1 % 4 == 0)
                                        </tr>
                                    @endif
                                @endif
                                @php $i++;  @endphp
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @endif
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('savegift') }}">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Veuillez choisir un Account Manager et une operation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @csrf
                    <select class="form-control" name="user_id" required>
                        @foreach($users as $user)
                            <option  value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control" name="entreprise_id" required>
                        @foreach($comptes as $sompte)
                            <option  value="{{$sompte->id}}">{{$sompte->nom}}</option>
                        @endforeach
                    </select>
                    <br/>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-bloo">Enregistrer</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script type="application/javascript"  src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
@endsection

@section('laraform_script1')
    <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/blockui.min.js') }}"></script>
@endsection

@section('plugin-scripts')
	<script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>
@endsection

@section('laraform_script2')
    {{-- <script src="{{ asset('assets/js/core/app.js') }}"></script> --}}
    <script src="{{ asset('assets/js/plugins/ripple.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom/main.js') }}"></script>
    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>
@endsection

@section('page-script')
    {{-- <script src="{{ asset('assets/js/custom/pages/datatable.js') }}"></script> --}}
    <script>
        $(function() {
            $('#account-tab').DataTable({
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
