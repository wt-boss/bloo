@extends('adminlte.index')

@section('stylesheets')
 {!! Html::style('css/select2.min.css') !!}


@endsection

@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Opération</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Acceuil</a></li>
                        <li class="breadcrumb-item active">opération</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <!-- left column -->
        <div class="col-md-9 ">


          <div class="card card-default">
                <div class="card-header">
                <h3 class="card-title">Iformation sur Opération</h3>
                </div>
                        <br>
              <div class="row justify-content-center">

                       <div class="col-5">
                            <div class="card card-info">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="text"> Nomé l'Opération </label> '
                                            <input type="text" class="form-control" placeholder="Nomé l'Opération">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="col-5">
                        <div class="card card-info">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="text">Date début</label>
                                         <input type="date" class="form-control" >
                                    </div>
                                    <div class="col-6">
                                        <label for="text">Date fin</label>
                                     <input type="date" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="col-5">
                         <div class="card card-info">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="text">Edité un questionnaire </label><br>
                                            <p>
                                                <button class="btn btn-light" type="button" style="font-size:24px" >
                                                    <i class="fa fa-book"> </i> &nbsp;  &nbsp; Cliquer pour ajouter ou modifier
                                                </button>
                                            </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>


                      <div class="col-5">
                          <div class="card card-info">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="text">Edité les sites d'operation '</label><br>
                                        <p>
                                            <button class="btn btn-light" type="button" style="font-size:24px" >
                                                <i class="fa fa-map-marker-alt"> </i> &nbsp;  &nbsp; Cliquer pour ajouter ou modifier
                                            </button>
                                        </p>
                                    </div>

                                </div>

                            </div>



                        </div>

                      </div>



                      <div class="col-5">
                            <div class="card card-info">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="text">Selectionner les lecteurs </label><br>
                                            <p>

                                                <button class="btn btn-light" type="button"    data-toggle="modal" data-target="#modal-lg" style="font-size:24px" >
                                                    <i class="fa fa-user-plus"> </i> &nbsp;  &nbsp; Ajouter des lecteurs
                                                </button>
                                            </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>

                     <div class="col-5">
                        <div class="card card-info">
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-12">
                                      <label for="text">Selectionner les Operateurs</label><br>
                                        <p>
                                            <button class="btn btn-light" type="button" data-toggle="modal" data-target="#modal-lg"  style="font-size:24px" >
                                                <i class="fa fa-user-check"> </i> &nbsp;  &nbsp; Ajouter des opérateurs
                                            </button>
                                        </p>
                                  </div>
                              </div>
                          </div>
                      </div>
                </div>
            </div>
        </div>


    </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- Input addon -->

          <!-- /.card -->
          <!-- Horizontal Form -->

          <!-- /.card -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->

        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->




    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Extra Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">




                <div class="col-12">
                    <!-- Widget: user widget style 1 -->

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class=" card-title">  <a href="#"> <i class="fas fa-plus-circle"></i>  </a>  <i class="fas fa-user"></i>  Operators</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                              <div class="col-12 col-sm-6">
                                <select id="myselect" class="selectpicker" onchange="deleteOption()" data-live-search="true" >
                                    <option ></option>
                                    <option value="java">Java</option>
                                    <option value="php">PHP</option>
                                    <option value="python">Python</option>
                                  </select>
                                <!-- /.form-group -->
                              </div>

                              <div class="col-12 col-sm-6 selectValue">
                             {{-- <span class="selectValue">test</span> --}}

                                <!-- /.form-group -->
                              </div>
                              <!-- /.col -->

                              <!-- /.col -->
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>
                </div>




            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  </section>

@endsection

@section('js')


<script>
    var text='';
    var content='';
    var tab=[];
    $('#myselect').on('change', function(){
        var selectedOption;
        selectedOption=this['selectedOptions'][0]['attributes']['value']['nodeValue'];
        console.log(selectedOption);
        text=selectedOption;
        tab.push(text);
        //console.log(tab)
        //$('.selectValue').append(paragraph)
        //$('.selectValue').children('div').last().append(text)
        content='<div class="card card-primary"><div class="card-header"><h3 class=" card-title"></h3><div class="card-tools"><button type="button" class="btn btn-tool closeSelect"  ><i class="fas fa-minus" ></i></button></div><!-- /.card-tools --></div><!-- /.card-header --></div>'
        $('.selectValue').append(content);
        $('.selectValue').children('div').last().children('div').children('h3').text(text);
        //console.log($('.selectValue').html());
        //$(this .option:selected)
      // var test= $(this).children('option[value='+selectedOption+']');
      // console.log(test);
      var x=document.getElementById('myselect');
      var x=$('#myselect').siblings('.')
x.remove(x.selectedIndex);
       // $(this).children('option[value='+selectedOption+']').hide();

        $('.closeSelect').on('click',function(e){
            e.preventDefault();
           // alert('hello');
            $(this).parent('div').parents('.card-primary').toggle();
          var title=  $('.selectValue').children('div').last().children('div').children('h3').text();
          var html='<option value='+title+'>'+title+'</option>';
          $('#myselect').append(html);

        });
    });

function deleteOption(){

}
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Datemask dd/mm/yyyy

      //Date range picker

      //Date range picker

      //Date range picker with time picker

      //Date range as a button


      //Timepicker

      //Bootstrap Duallistbox

      //Colorpicker

      //color picker with addon


    })
  </script>

{{asset('adminlte/')}}
{!! Html::script('js/select2.min.js') !!}
@endsection
