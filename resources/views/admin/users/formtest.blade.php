@extends('admin.top-nav')

@section('page_title', trans('Utilisateurs'))

@section('title', 'Comptes utilisateurs')


@section('content')

    <div class="panel panel-flat">
        <div class="panel-body" style="padding: 0;">
            <div class="panel-heading pull-right">
                <a href="{{ route('users.create') }}" class="btn btn-bloo"><i class="fas fa-plus-circle"></i> {{ trans('create_user') }}</a>
            </div>
        </div>

            <div class="panel panel-flat">
                <!-- /.box-header -->
                <div  style="padding: 15px">
                    <form name="frm-example" id="frm-example">
                        <table id="example" class="display" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Office</th>
                                <th>Selected</th>
                                <th>Comments</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Office</th>
                                <th>Selected</th>
                                <th>Comments</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Tiger Nixon</td>
                                <td><input type="text" name="r1_age" value="61" size="3"></td>
                                <td><select size="1" name="r1_office">
                                        <option value="Edinburgh" selected="selected">Edinburgh</option>
                                        <option value="London">London</option>
                                        <option value="New York">New York</option>
                                        <option value="San Francisco">San Francisco</option>
                                        <option value="Tokyo">Tokyo</option>
                                    </select></td>
                                <td><input type="checkbox" name="r1_selected" value="1"></td>
                                <td><textarea name="r1_comments" rows="2" cols="10"></textarea></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Garrett Winters</td>
                                <td><input type="text" name="r2_age" value="63" size="3"></td>
                                <td><select size="1" name="r2_office">
                                        <option value="Edinburgh">Edinburgh</option>
                                        <option value="London">London</option>
                                        <option value="New York">New York</option>
                                        <option value="San Francisco">San Francisco</option>
                                        <option value="Tokyo" selected="selected">Tokyo</option>
                                    </select></td>
                                <td><input type="checkbox" name="r2_selected" value="2"></td>
                                <td><textarea name="r2_comments" rows="2" cols="10"></textarea></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Ashton Cox</td>
                                <td><input type="text" name="r3_age" value="66" size="3"></td>
                                <td><select size="1" name="r3_office">
                                        <option value="Edinburgh">Edinburgh</option>
                                        <option value="London">London</option>
                                        <option value="New York">New York</option>
                                        <option value="San Francisco" selected="selected">San Francisco</option>
                                        <option value="Tokyo">Tokyo</option>
                                    </select></td>
                                <td><input type="checkbox" name="r3_selected" value="3"></td>
                                <td><textarea name="r3_comments" rows="2" cols="10"></textarea></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Cedric Kelly</td>
                                <td><input type="text" name="r4_age" value="22" size="3"></td>
                                <td><select size="1" name="r4_office">
                                        <option value="Edinburgh" selected="selected">Edinburgh</option>
                                        <option value="London">London</option>
                                        <option value="New York">New York</option>
                                        <option value="San Francisco">San Francisco</option>
                                        <option value="Tokyo">Tokyo</option>
                                    </select></td>
                                <td><input type="checkbox" name="r4_selected" value="4"></td>
                                <td><textarea name="r4_comments" rows="2" cols="10"></textarea></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Airi Satou</td>
                                <td><input type="text" name="r5_age" value="33" size="3"></td>
                                <td><select size="1" name="r5_office">
                                        <option value="Edinburgh">Edinburgh</option>
                                        <option value="London">London</option>
                                        <option value="New York">New York</option>
                                        <option value="San Francisco">San Francisco</option>
                                        <option value="Tokyo" selected="selected">Tokyo</option>
                                    </select></td>
                                <td><input type="checkbox" name="r5_selected" value="5"></td>
                                <td><textarea name="r5_comments" rows="2" cols="10"></textarea></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Brielle Williamson</td>
                                <td><input type="text" name="r6_age" value="61" size="3"></td>
                                <td><select size="1" name="r6_office">
                                        <option value="Edinburgh">Edinburgh</option>
                                        <option value="London">London</option>
                                        <option value="New York" selected="selected">New York</option>
                                        <option value="San Francisco">San Francisco</option>
                                        <option value="Tokyo">Tokyo</option>
                                    </select></td>
                                <td><input type="checkbox" name="r6_selected" value="6"></td>
                                <td><textarea name="r6_comments" rows="2" cols="10"></textarea></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Herrod Chandler</td>
                                <td><input type="text" name="r7_age" value="59" size="3"></td>
                                <td><select size="1" name="r7_office">
                                        <option value="Edinburgh">Edinburgh</option>
                                        <option value="London">London</option>
                                        <option value="New York">New York</option>
                                        <option value="San Francisco" selected="selected">San Francisco</option>
                                        <option value="Tokyo">Tokyo</option>
                                    </select></td>
                                <td><input type="checkbox" name="r7_selected" value="7"></td>
                                <td><textarea name="r7_comments" rows="2" cols="10"></textarea></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Rhona Davidson</td>
                                <td><input type="text" name="r8_age" value="55" size="3"></td>
                                <td><select size="1" name="r8_office">
                                        <option value="Edinburgh">Edinburgh</option>
                                        <option value="London">London</option>
                                        <option value="New York">New York</option>
                                        <option value="San Francisco">San Francisco</option>
                                        <option value="Tokyo" selected="selected">Tokyo</option>
                                    </select></td>
                                <td><input type="checkbox" name="r8_selected" value="8"></td>
                                <td><textarea name="r8_comments" rows="2" cols="10"></textarea></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Colleen Hurst</td>
                                <td><input type="text" name="r9_age" value="39" size="3"></td>
                                <td><select size="1" name="r9_office">
                                        <option value="Edinburgh">Edinburgh</option>
                                        <option value="London">London</option>
                                        <option value="New York">New York</option>
                                        <option value="San Francisco" selected="selected">San Francisco</option>
                                        <option value="Tokyo">Tokyo</option>
                                    </select></td>
                                <td><input type="checkbox" name="r9_selected" value="9"></td>
                                <td><textarea name="r9_comments" rows="2" cols="10"></textarea></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Sonya Frost</td>
                                <td><input type="text" name="r10_age" value="23" size="3"></td>
                                <td><select size="1" name="r10_office">
                                        <option value="Edinburgh" selected="selected">Edinburgh</option>
                                        <option value="London">London</option>
                                        <option value="New York">New York</option>
                                        <option value="San Francisco">San Francisco</option>
                                        <option value="Tokyo">Tokyo</option>
                                    </select></td>
                                <td><input type="checkbox" name="r10_selected" value="10"></td>
                                <td><textarea name="r10_comments" rows="2" cols="10"></textarea></td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>Jena Gaines</td>
                                <td><input type="text" name="r11_age" value="30" size="3"></td>
                                <td><select size="1" name="r11_office">
                                        <option value="Edinburgh">Edinburgh</option>
                                        <option value="London" selected="selected">London</option>
                                        <option value="New York">New York</option>
                                        <option value="San Francisco">San Francisco</option>
                                        <option value="Tokyo">Tokyo</option>
                                    </select></td>
                                <td><input type="checkbox" name="r11_selected" value="11"></td>
                                <td><textarea name="r11_comments" rows="2" cols="10"></textarea></td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>Quinn Flynn</td>
                                <td><input type="text" name="r12_age" value="22" size="3"></td>
                                <td><select size="1" name="r12_office">
                                        <option value="Edinburgh" selected="selected">Edinburgh</option>
                                        <option value="London">London</option>
                                        <option value="New York">New York</option>
                                        <option value="San Francisco">San Francisco</option>
                                        <option value="Tokyo">Tokyo</option>
                                    </select></td>
                                <td><input type="checkbox" name="r12_selected" value="12"></td>
                                <td><textarea name="r12_comments" rows="2" cols="10"></textarea></td>
                            </tr>
                            </tbody>
                        </table>

                        <hr>

                        <p>Press <b>Submit</b> to see URL-encoded form data that would be submitted to the server.</p>

                        <p><button>Submit</button></p>

                        <p><b>Form data:</b></p>
                        <div id="example-console-form"></div>
                    </form>
                </div>

            </div>
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

        @section('plugin-scripts')
            <script src="{{ asset('assets/js/plugins/bootbox.min.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/datatables/datatables.min.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/datatables/extension-responsive.min.js') }}"></script>
        @endsection

        @section('page-script')
            <script>
                $(document).ready(function (){
                    var table = $('#example').DataTable();

                    // Handle form submission event
                    $('#frm-example').on('submit', function(e){
                        // Prevent actual form submission
                        e.preventDefault();

                        // Serialize form data
                        var data = table.$('input,select,textarea').serialize();

                        // Submit form data via Ajax
                        $.ajax({
                            url: '/echo/jsonp/',
                            data: data,
                            success: function(data){
                                console.log('Server response', data);
                            }

                        });

                        // FOR DEMONSTRATION ONLY
                        // The code below is not needed in production

                        // Output form data to a console
                        $('#example-console-form').text(data);
                    });
                    document.getElementById('send').onclick = function () {
                        setInterval(reload, 1000);
                    };
                });
            </script>
@endsection
