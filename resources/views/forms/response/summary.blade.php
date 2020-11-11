@php
    $data_for_chart = [];
    $fields = $form->fields;
    $template_alias_no_options = get_form_templates()->where('attribute_type', 'string')->pluck('alias')->all();
@endphp

<div class="panel panel-body"  >
    @foreach ($fields as $field)
        @php
            $responses = $field->responses;
            $responses_count = $responses->where('answer', '!==', null)->count();
        @endphp
        <div class="row">
            <div class="col-md-12">
                <label class="label-xlg">{{ $field->question }}
                    @if ($field->required) <span class="text-danger">*</span> @endif
                </label>
                <p>{{ $responses_count }} {{ Str::plural(trans('response'), $responses_count) }}</p>

                @if (in_array($field->template, $template_alias_no_options))
                    <div class="table-responsive">
                        <table class="table table-striped-info table-xxs table-framed-info">
                            @foreach ($responses as $response)
                                @if($loop->index === 10)

                                  @break
                                @endif
                                <tr>
                                    @php $answer = $response->getAnswerForTemplate($field->template); @endphp
                                    <td>{!! $answer !!}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @else
                    @php $response_for_chart = $field->getResponseSummaryDataForChart(); @endphp
                    @if (!empty($response_for_chart))
                        @php $data_for_chart[] = $response_for_chart; @endphp

                        <div class="chart-container{{ ($response_for_chart['chart'] == 'pie_chart') ? ' text-center' : '' }}">
                            <div class="{{ ($response_for_chart['chart'] == 'pie_chart') ? 'display-inline-block' : 'chart' }}" id="{{ $response_for_chart['name'] }}"></div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        @if (!$loop->last)
            <hr>
            <div class="html2pdf__page-break"></div>
            <p style="font-size:0.25mm" >test</p>
        @endif
    @endforeach
</div>

<div id="print" style="display:none" >
    <div class="panel panel-body" id="responsesprint"  >
        @foreach ($fields as $field)
            @php
                $responses = $field->responses;
                $responses_count = $responses->where('answer', '!==', null)->count();
            @endphp
            <div class="row">
                <div class="col-md-12">
                    <label class="label-xlg">{{ $field->question }}
                        @if ($field->required) <span class="text-danger">*</span> @endif
                    </label>
                    <p>{{ $responses_count }} {{ Str::plural(trans('response'), $responses_count) }}</p>

                    @if (in_array($field->template, $template_alias_no_options))
                        <div class="table-responsive">
                            <table class="table table-striped-info table-xxs table-framed-info">
                                @foreach ($responses as $response)
                                    <tr>
                                        @php $answer = $response->getAnswerForTemplate($field->template); @endphp
                                        <td>{!! $answer !!}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @else
                        @php $response_for_chart = $field->getResponseSummaryDataForChart2(); @endphp
                        @if (!empty($response_for_chart))
                            @php $data_for_chart[] = $response_for_chart; @endphp

                            <div class="chart-container{{ ($response_for_chart['chart'] == 'pie_chart') ? ' text-center' : '' }}">
                                <div class="{{ ($response_for_chart['chart'] == 'pie_chart') ? 'display-inline-block' : 'chart' }}" id="{{ $response_for_chart['name'] }}"></div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            @if (!$loop->last)
                <hr>
                <div class="html2pdf__page-break"></div>
                <p style="font-size:0.25mm" >test</p>
            @endif
        @endforeach
    </div>
</div>


@push('script')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('assets/js/custom/pages/response-summary.js') }}"></script>
    <script>
        google.charts.load('current', {'packages':['corechart']});

        var data_for_chart = {!! json_encode($data_for_chart) !!};

        if (typeof data_for_chart === 'object' && data_for_chart instanceof Array && data_for_chart.length) {
            google.charts.setOnLoadCallback(function () {
                drawCharts(data_for_chart);
            });
        }
        $(function () {
            // Resize chart on sidebar width change and window resize
            $(window).on('resize', function () {
                drawCharts(data_for_chart);
            });
        });
    </script>
    <script>
        function reload(){
            window.location.reload();
        }
        setInterval(reload, 45000)
    </script>

    <script type="text/javascript">

        setInterval(function(){
            google.charts.load('current', {'packages':['corechart']});

            var data_for_chart = {!! json_encode($data_for_chart) !!};

            if (typeof data_for_chart === 'object' && data_for_chart instanceof Array && data_for_chart.length) {
                google.charts.setOnLoadCallback(function () {
                    drawCharts(data_for_chart);
                });
            }
            $(function () {
                // Resize chart on sidebar width change and window resize
                $(window).on('resize', function () {
                    drawCharts(data_for_chart);
                });
            });
        }, 3000);



        let printpdf = () => {
            var now = new Date();
            var annee   = now.getFullYear();
            var mois    = now.getMonth() + 1;
            var jour    = now.getDate();
            var heure   = now.getHours();
            var minute  = now.getMinutes();
            var seconde = now.getSeconds();
            var imgData = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEEAAAAeCAYAAABzL3NnAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAAEnQAABJ0Ad5mH3gAAAf0SURBVFhH7ZgJUNXVHse/18vOhTQQyJRFqDR6og1p9iZT26xMdJp269VrtGhqmizDrF7Nc56Z02JWVtY4LWO2jZVbYItjY0z6XBgTtUQlBATFC4rAvYDQ93f+51z+93KBpGnGRj8z/+Ge8z//s/z2g6Od4DSnj/57WnNGCOSMEIgSQsHOaszdUKo6/gwzCvZg6c9VuvX3QQXGGV/uxCvr9gL1XjxzWxb+e815+vXJ4XhiDdDSBjS2YO8L12Fw3wj95tRGWUJECP9EhwGp/TDni2KsLD6kXp404SHAWTz4gFikP7ZKd576+McESZb9ozEj/xer3RtMwo134bm1e3Tj1Ea5w+xVu/F84W+WJqVsOHECr9+YiVpPix7GLnYnRofinuEDLMsJguOZtRQr3/VxAN5W5I1Oxrwbh+q3f5y1e93YWH5UydMV5sSUoQlI+wtdq7MQBBFEU4cAfNDdUe9BaGIM8u8egfHpcVa/JlAIT16WgrkTh+i3PXPr0iJ8um4fEEPX5OEVsqbshe0P7sjCXdkDrf4e+O2oB0UVFOTZLmS6QnGei3N2QXAh9EQbhVTTgFFZ5+Cn6SN1Z++FsK+uCel5+UBcNPegDx+IKIYHG0B3rZg9Tnd25j90wTkrdnIz3AMtGmMvtITI7x8ZloAFFyfqkR0Et2vlElRB4GOQQya4sLHkCDIW/Kg7e8e+Og/SZ6xWwdRPAGYPBjlU30hUMvO48r7Wnf7Ezs7HnG9LVDxCPAUqQToq1LKs2HC8+usROD4s5rS2eUlnIcjiHJMSE46EqBD1JPLpL5MdrFca9sGMsresDvO/pwn3kvQnaQEp/XSLyPqHG5hqT2AQN65+H2/WL0moEw1Uwth3/687LMJmrkG9k0KULEd5oZWHaOB3sl+fMJ24PDEML+yo1m2LIEKwFF06cwyqZ41TTxWfQ7PGov2tyZiSSXOqbdSDCaWdt6zI+i3aOgnuW76D2rUFPG423NOK8nnXov1/16Ls8TFof30S3r4pE6iiAgwRoVi/qRwVWjh3fLIdLU4exQTsI424jJa16PbhWJSdhKvio7hnL/86cW9qX3gZ5ZeVuq2xJKg7tAWYi53ldw7HVPo6uFkfZ0fh462VKpKfDEvEdHkghVjAMS888ybgXBctwMb0S5NRmHcFD0erMCRE49lVu9TPZTJPpJ7H3YjFDKA/5o5C7ugU5KbE4ptxyVh9XQqu4jd1jGfn8++KEje8tDYhqBB64sNbhlmmJhsXqIEtlUfhiviDgZWUMchBtGegr78/dYRudGY0C7k0cRtj2vx2ye4a67dZly4wPCMO0yi0QK6nZcQz8OcXHcTUNzfi4892YOGmA+pdF0Lo2azHD0vq2BD9Z+vh44gKqB8c3cyzufKY8m8fFOrU7AG6EZz7R/C9lOUC12w/yDmEZmpUlmpuxbSRg6y+IDgp6LWFZZbbxEWizt2k+tWumSVVQyGTtXftDoaoUH5q+6yV+5BY5IfDNiCAJhlslxmH9ulB+A6xHLNXGWqUYJahqUd2Y40DJf7IvnXsspxBbyNEfNk3OQcctgW+LlglEdZont+mc4FkSUVSQwh89143d5CMOAYrKUMNkSFYs+eIbgRny4G6jjVlHUmDQij3LFOFhWDDrq7XLJD92ArCCP1bzZgjpt1gqxAZTScv3aYbnVkhAhAlmGxAjWSybhhzDnO9EQK1VllWi+2HjlvtAEZJXVBvS30MhneZLBOEepr8p3LdNy7ENSfQ/xVebRFU5pL1+1W1GMihxma8uGZ3hxA45l/adZQQsmXzdlOjRL/aWI6nCzpfgDaU1iLntUJVfPhgLn9sTBoeuCJNpScf/V3Ieu5bFEuuD8KVl7AENj5EH3fTZzNl7gDczESxs1ggJcXoHkIB3idZimRnUYlmHo5JnV2AVygMLwXVQqUs/qkMiTNZj7DcV7C/H89s7iO+f7SuLK7GpLc2KSvwIXmY5vfoqEEsupxYWFSJuipqVkzZwEvWxKGJWHm3Fdkv4SE2V3OMPejRGgbznnH7kHiGm3ampjb8+/JUZDC1hk9fDiT3tcxZkLRFLd3D92mxEVi9341N26t4AFaBxvKYwl08c/2cq60mH+c0zjPwLNVWSKms6ghOLAVUFB9DeR1qFuYwNlpW4ROCcDFTxzYuqj4yiHlL1JNR4o/2tEbph3tb4Jl/ve6wcDy8QtUOquoySBAz2uKcYbxjeOdegzd5Z3nwI7oB3cknCNmSZAH5K+uZOCBIX8UxNLJwi7TtZT/L78GsGpW12MfbkT0wK5U8PwHpvIMY/EZvZYHxjxRqxW0zXzkI3UP5kl0ATGkx1EigAIS21yax8GH6sV3F1bcyhzwsbJr57fglm5FLk342hxUhr84+dxSNS7CWsfYDiZXQyg4umOgnAEFMu2XxFAwRE+ftUVmClMzyyG+W/EkszGrfyPETgOBnCYbPt1Xi5ndYm0u6kcdoVEbKRmqbkHvDBVg0mZvvhim8Gn8pV2PmZITwUDbDUBzzYCxz/7p7s1HEsnjEyxusSlSuvfY1RYM1jRg/ciC+s91au6KBlvvS+lJ4mprpOe0Ip9Af+meqdf8JQlAhGJYxC2z+tQbbeVeQUem8J1xEv3t4dOeKrDvm/7Afu2mGB+ijTpuLiML3VNaj5KmOq3EhLeKLLRXYxfK3mSm0f2QYhiZF46krM3qoInpPt0I4XfB3rNOUM0IgZ4QA4HfrThrjmMx8DgAAAABJRU5ErkJggg=='
            var element = document.getElementById('responsesprint');
            var opt = {
                margin:      [20, 20, 20, 20] ,
                enableLinks: true,
                filename:     '{{$form->title}}.pdf',
                image:        { type: 'jpeg', quality: .95 },
                html2canvas:  {scale: 1},
                jsPDF:        { unit: 'mm', format: 'letter', orientation: 'landscape' }
            };

            html2pdf().from(element).set(opt).toPdf().get('pdf').then(function (pdf) {
                var totalPages = pdf.internal.getNumberOfPages();

                for (i = 1; i <= totalPages; i++) {
                    console.log('here', i);
                    pdf.setPage(i);
                    // pdf.addFont('Baloo-Regular.ttf', 'custom', 'normal');
                    //
                    // pdf.setFont('custom');
                    pdf.setFont("helvetica");
                    pdf.setFontSize(10);
                    pdf.setFontType("bolditalic");
                    {{--                    @if( app()->getLocale() === "fr" )--}}
                    {{--                        pdf.text('Page ' + i + '/' + totalPages, 198, 275);--}}
                    {{--                        pdf.text('Imprimé le : '+jour+"/"+mois+"/"+annee ,00, 275);--}}
                    {{--                    @endif--}}
                    {{--                        @if( app()->getLocale() === "en")--}}
                    {{--                    pdf.text('Page ' + i + '/' + totalPages, 198, 275);--}}
                    {{--                    pdf.text('Print it : '+jour+"/"+mois+"/"+annee ,00, 275);--}}
                    {{--                    @endif--}}
                    {{--                        @if( app()->getLocale() === "pt")--}}
                    {{--                    pdf.text('Página ' + i + '/' + totalPages, 198, 275);--}}
                    {{--                    pdf.text('Imprima : '+jour+"/"+mois+"/"+annee ,00, 275);--}}
                    {{--                    @endif--}}
                    {{--                    pdf.addImage(imgData, "PNG",  195, 05);--}}
                    @if( app()->getLocale() === "fr" )
                    pdf.text('Page ' + i + '/' + totalPages,  260, 210);
                    pdf.text('Imprimé le : '+jour+"/"+mois+"/"+annee ,05, 275);
                    @endif
                    @if( app()->getLocale() === "en")
                    pdf.text('Page ' + i + '/' + totalPages,  260, 210);
                    pdf.text('Printed on : '+jour+"/"+mois+"/"+annee, 05, 210);
                    @endif
                    @if( app()->getLocale() === "pt")
                    pdf.text('Página ' + i + '/' + totalPages,  260, 210);
                    pdf.text('Imprima : '+jour+"/"+mois+"/"+annee ,05, 210);
                    @endif
                    pdf.addImage(imgData, "PNG",  258, 05);
                    pdf.text('{{$form->title}}',05,12);
                }
            }).save();


        }
        document.getElementById('download_pdf').onclick = function () {
            // Simple Slide

            var impresion =  document.getElementById('print');
            impresion.style.display = 'block';
            impresion.style.visibility = 'hidden';
            let data_for_chart = {!! json_encode($data_for_chart) !!};
            if (typeof data_for_chart === 'object' && data_for_chart instanceof Array && data_for_chart.length) {
                google.charts.setOnLoadCallback(function () {
                    drawCharts(data_for_chart);
                    setInterval(reload, 3000)
                });
            }
            printpdf();


        };


        {{--document.getElementById('download_pdf').onclick = function () {--}}
        {{--    var now = new Date();--}}
        {{--    var annee   = now.getFullYear();--}}
        {{--    var mois    = now.getMonth() + 1;--}}
        {{--    var jour    = now.getDate();--}}
        {{--    var heure   = now.getHours();--}}
        {{--    var minute  = now.getMinutes();--}}
        {{--    var seconde = now.getSeconds();--}}

        {{--    // var imgData = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIIAAAA8CAYAAACqw2L4AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAAEnQAABJ0Ad5mH3gAABAJSURBVHhe7ZwJdFXVFYZ3SEhISEKCBJIwhXkKUwKIgIBMRUWLqNBlVayKolVBBIutdaJYloq0WkVXsXXJKqhdODIoyqCEGYSgMkYgEjKQAAmBJGTs/997Hr6Ed4f38kiw3s8Vwj3vcu4Z/rP3PvueZ0AVEIdfPA3Ub4dfOI4QHDQcIThoOEJw0HCE4KDhCMFBwxGCg4YjBAeNCwmlgpJyiZq1UkJjIyQpLkJu7d5Cpg1srd1UH8TPT5GswvPSLrqRjOvcTGYNaiutmzRSnzr4mwtCKC6rlLA/rBIJDxapRFFZBX4q5W8Te9WLIPq8sVVSj+XDZsFolVeKFJXKoN5xsvHufuoOB39S3TUE4CcQRQ0DRcIgiMgQmf5eqkxdvl//vA4JYFsa4I8gtKdRkEjTMNl06KQEPrdGv8HBr5jHCJyNqFB588s0WfTNcVVYj0AQlefLJXb+16rAwV+YC8FFVCOZsmSPuqhngoMkJ7NQ3vsuRxU4+AN7QqBlwJ3/3pWlCuoZuK3Za9LUhYM/sCcE0rCBrEzLVRf1DOKGoz+cUhcO/sC+EBC4HTldoi4uAyDMs6XY2Tj4herbx9nYPkYa7NV5GzxEWFCQVFicZanE583CGkrP5uHyq45N5TeJsRIfEaI+tUffN7fK7owCrH7sYDxxpkSK5l0roRDEpebQySJ59/scWXfktOzJOSuFCFgDtG2N7jX7xEbIgPhIualbjAxPiNbKf27YFwLhrRYiuABvq8AfFZUiGLjQZo3lhdGd5KEBrfTPLbgchPDixnR5fNVBLYchwWgHt7Lc0uoa0GE/mXdhX8thoTA+dw5pJ2/d2BW3X3qR+gvvhFAbKIiSci1P8fFdSXJjlxj1gWfqUwjvpGbJ5CWp+BuGplFDffLtwuGkyzpXKlPHdJKF13dVH/iHz9JOyo7MM7I7u1CC8KzytjGaVeoYHiyDmzaScXHh6k7vqDshuODqwSQO6x0n6+9KVoUXU19C6L1wq+xJyxMJhyvzRgA14bBS+A0DJfeJ4Zqr9JW9uefk3k/2yeZvs/VkXyDaxR9mf5Pb6xaKz9MscJX0bxUu8xJjZERMmF6BDerednFwo0LlqwO5EvDs5ZMlLIPFCpqzRvYwrc3FUBsREC7TUEw+fsU8uVqLL3yh+2tbpMfcdbL5CHZJUWgXXwGw3uAg5a7wALosCoQZ2LAg2Z5XLCM/PyLxKw9Lvs2Auv6cGE0uFH25pIyD/7haKjhoIRhMf8KUfWSIjFiQIuuP2hfDJggy4NHlsi/rjEh0qD7RKkA1hffwmbBAWXBP0Uv3yvvHC9WHxtSfEAg6V3m+QkL+slYV1A8NKMZgDIWRG6otnJymoXLN/A3aG1Ur3thxXAa/8LUI37ZSAL5CQcCCTPoiXV7ee0IVesY7IdC/l8LvWf3Qd/FeO8C8lZ4tlXFacFb3DH/7G6kqLrMvgkoEveyf1lf8ZhBsByWG+HnrVYFnPtyXKw+8840Idlm2LIAVaOKQuGBs3CokBVtfI+wHi5jYKJib8Yj2i7lNMiAQjc+GSVp7AAEXto2aP6MPs+JUkXwze7j0jYvQLusiWFxz+LSMenWjFrNYwskvKpOGMNMj2kXLFRgLjtn242ckIx0mvzF8N3221eSVlMmEPi1l2aSequAn8lB/DI8CXIEgz6oeLrTzEHBSOz1w9HR/eZUMaRIgd7SNklNo6ynMxyPdm0srvlmugX0hYPL7t4mWbVP6qwJrdmYWyvVLdknOiXP6QJnBlYUOVT09SrusCyE0QLBapT3XpA4OD8x5UucYWfHbPhLLYM0DUz7dJ4vW/mAv0DxZJHnzxmpicicILqqCZy/M2kNB0oIhxurNrWLXeEktgLspxqJz5TpIDREQJvpKsKt4rm+8du2OV6NYRrPoBcnxEZI9c6hMHQrVFlikp9n5wlL5PK1u3iF8sO+EVNFfW4kgv0QWT06WnfcPMBQB+ecN3ST9GYjYjruICJFJy75TFzqvbc+QCrP2sC0Yw4EJ0ZL17GipmjtGdj80SHaPSpCqm7tI7sSu8us2kSLnIBIPIiANYDWo0dWwYjXxSgi+snBcV3mCiZWzFoEStj9PrceqqgNmr8Fz6LbMwMB/cP+VcnuvWFVgThsEdxXPj9FXp25oPQMrtmZnhrrQeeiTffphIE8oEbx3Tz/ZfG9/j4JsBmvw0cB4+WR0giQEl8vtNURA2KLGCD63wg3XpE6EQJ4f2UE6o3FaGtYImLVt6pxBQLU8rv85dBAxjFnsAn864aq22vsDb+CqW/vgQLguE9HTnwcHyRImiMAWukCmsY1cCizFW3cmycQeLVSBMTfENpZtYzvLEcRpLlhtI4gvBgLKOFUsizemy0JYIHfqTAhkyz2IL2D+DeEAocHpMMchdgJMH/k87aSefDGCK7CkXJZNvDigs8M1CCZ7dLrCXPTo58cMqME65heMtomICXp1aiZ3e/DrRsQgfhgUEy4BUAAD/FJYhuWp2TJl0Q55ZcV+OYTnLflOF6GLOhVCNExxj87NMEAmPhQ+csOP+Yh7Lp1F2I4g1nD1EQz+rYPaqgvfmDO8A6yKiRDQzxT0k9yWCNdjNCYQ5Ls3J6oL+9zYJko+3J0lM97bI39emiprtPQ0ppvuMCRIUmrEYnUqBHIDXzaZCQETdCS/GFb70glhTw6EYCY0tG98Fwi2FmguxSy9i/5l5mE3Bdoydewp70LLBEvRLaaxKvCOtIwzUowtqbZjo8VxbTE5tm6ug9S5EJKZJzDbfaCNefCX9LWXinPcgpnFIJiUXi18e4tXjcgQzxNM2D9OkgtPwSW2et1bN1EX3jO6Y7QeIXoCC+Gcm1C9EgKTRbWlwmhg3LAbKAb6aDW0k1YWPbfTTisiQhndm9Rj2fwqCa1FrKQvJuPnuy+2C0+xOnVEBaczcVFL8pltNBMUmsGtdLnVRKCOY1a5CQP6MhFjWn+AX47BFeaeNe+rjT5mnTUJri04zW2syfPd5/yCEMKZlbII4vIy9OCmNvBghTbTRqBxCVFh0k7zm6rME6jDm7d57oTRX5rNQVAAIvna9TWbORNOgtFEwD2GILInhQwqPVk39DGT6WsfWcUXTUZjjZ2ENueKanc1bgH/bZYVw5bLtff1lY92YP/K6NUI+MWk2HBJbI5BMmsLOvHi5nR14R08S2m6GiGUBVt8q9vF69uPo40W/VTvVfjK2XDCEOXP3+R9W1J+LNDf9XgSGMY1pnWUutCp9vThCfgQDTQE2447P/xeXXjPS+wQz/GZmUuY5MHY+gxiQ82EAN95ANaFB0u9ZWxH7PG1gNEATMqpnLOy1sfDJGTOqgPmZxswzle10gPBb0+YuBAsvpkf7VMX9rn6rW1MI6qrGsDyX8c8hxvVhHBXn3jLAarAtmPW6kOqwD7n8fBZH0BEoWaDUykN+eYNDGwVqYvSLHaJCJHO/9isLuzTmc/gCR8zqxAeIiP/tV1deMfgt3bqVs9U8OVyT5KeJJrJnAUzi55gHSGB2gspu7RekILJRt+MDs+WlMtDA6p/sbnanbd0b67vfc0GPyxYXlp5QDs8YRe+9Wr05Grt1IyVNZg7ooO6ELmuXyvNlxlCc4oBbcOOe8mdV2IgzERPk4pHx7+8QRXYg18Y3rQ/RxeaERQgxrG7W35gaDL6ahSgwvrx9BSP9pkdbGGAHfPC15KRe05znR7BYgvHc/vF627JxYXX0C4eXHFAFqYcYXJalRiQXyx3DG0n79zUQxV4huncsYuwstgwIz9I2AzsAqoWjFMFIgdh9rvMWasf1TKDh0Tg1zMfu1ribH5/Ih+rIvpx9e7fDE4O9txHZ1ytJ35M0L7K/wOCYR58NQNWdcGERJnu9r8bOFlUJs2e+Ezvq9Fioas8c16SsWCnJLXUdj/BGNMdmYWyeE+WfJ2apT/bbMuJefvi4cEyqn31719cJAQSMGOFngwxW72Ep3ShwmnXtNesCYOwMJjEY2jsikMnZc5XhyU3u1BvnNWeHwMxc2QHeXFMJ1Wg0/fNbbKbqVgjhbtQgzSwZ6xMTW6p5fv5ls6VD+CfoUGB1bp049JU+ZTBr9U5RSbAsHVO7BIjswa10b7EEoe6CxDtb80okP98myNLNx7VLR53JGawPRBu1V/HqoKfeGTVQXl13Q96JtAMWjLu8LR4Dj90AXRFFIDZnCF47JfQVLbfd/GZEo9C+PuWH2X6f7/TxWAF/zlXDU24K2PIxrBRVlbABScR1VTNGa0KqhMwY7l+4MNKmISDxLZoddboGgYvEpF6wezhqgBVzlzJvbO9uvkSqdS9bvwbpqo5Ce4pXDNOF8uaaYO1U06e4Ff+c04Vm7sWX6Bw0NYqnpnwgMdZmjawjfRkZM3thxXsPFcUB5OTxR+aZ77csCMCDigGJ++JnyanJsumDNDusQUnhCuTbXC1x/XTNEzO5BXJUqxgF2t/f5UIB94OPC1VrW781o6oof92RICAcPxVbQxFQLIfGyoNOJ50d/6CAsYCKXtqpCq4GMOZ2vPAlRLABpkFVLWFIkAcsPzhQRcd23JnQrfm8vDYLloMUWsg2Nt4OFRBF/L0BMQ5/qjbDLjRVi0i5MNJvVSBMRWYsBbRiF1qvBjyiZIyCcTiKJ07BkbaWKymS7by6ZESQPNuxzJ4C0WQXyILJyfL9Xw1bcEr13aW+7mjQLBzkcn3Bs2CBUr8/A2qQOSZ4e39U7cRxWXSqnljOTZjiCqwJnvm1XL3EGwr+YbS7FyDEXRfsKLDENeUQ1gNLayzxxihJh1e2SiHjxXoZtCOCbSCVgZqT3l0iJY88obnNxyVP/G8H82yHddjBCZnWNeYal+745ZYO0rO3UFt6nbBoUUAO6xXrOnX+8zg+5RRi3fJwUN5uluie2JcUnMe+CwGooyPYAWiYiPkyzv6SnJ8pLrBHFtCIM+sPyLPfoAJoH+0iuCNoEohgDg0Ln36YEuVGvH9ibOSyEQSLRVjEV/FibYMxW7nK7dJ4umoBFoL1s2B96VuDikDaLiDRbf3vZA4qg2nIFx+O/v9vSfkMN8/cNZcTePf8czYlk1kYmILeWRAa+nQ1MYRfTdsC4EwO0h1puzK1NOXDMysJpPV0wKUVEgDrOJ3b+kpt/Zorj6sHZo4V+zXB4TitNo+eQIBXHKHK2THfQhI3ZgLy/MkD5TarZv95HaOfcWkTRjcVpZNtI4HfIVzwUQdYSIpwmoLbIFXQnBn9pdp8vbuLMnhCxMKgoGI+zhh8WsWAJ/dlNRSHuzfUka1b6p/5mf4NXYeB992IFc3j9xXe2NsELAWvDYe3uZiS8cdxuuoO2Ufdhqe6ubosRx9bY89+uQ+sfLUsPb6Zz8jfBaCOwewJduVXagtCsL33AnwszzlE1lLpXoLU7D7EWBlFto/5VSEVfy7vnGW99esuwr/sX/dmjX22hRfbvhFCA4/f7wxoA7/xzhCcNBwhOCg4QjBQcMRgoOGIwQHDUcIDkDkf7dGO0kKrVmhAAAAAElFTkSuQmCC'--}}
        {{--    var imgData = 'data:image/png;base64,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'--}}
        {{--    var element = document.getElementById('print');--}}
        {{--    var opt = {--}}
        {{--        margin:      [20, 20, 20, 20] ,--}}
        {{--        enableLinks: true,--}}
        {{--        filename:     '{{$form->title}}.pdf',--}}
        {{--        image:        { type: 'jpeg', quality: .95 },--}}
        {{--        html2canvas:  {scale: 1},--}}
        {{--        jsPDF:        { unit: 'mm', format: 'letter', orientation: 'landscape' }--}}
        {{--    };--}}
        {{--    html2pdf().from(element).set(opt).toPdf().get('pdf').then(function (pdf) {--}}
        {{--        var totalPages = pdf.internal.getNumberOfPages();--}}
        {{--        console.log(totalPages)--}}
        {{--        for (i = 1; i <= totalPages; i++) {--}}
        {{--            console.log('here', i);--}}
        {{--            pdf.setPage(i);--}}
        {{--            pdf.setFont("helvetica");--}}
        {{--            pdf.setFontType("bolditalic");--}}
        {{--            pdf.setFontSize(10);--}}
        {{--            @if( app()->getLocale() === "fr" )--}}
        {{--            pdf.text('Page ' + i + '/' + totalPages,  260, 210);--}}
        {{--            pdf.text('Imprimé le : '+jour+"/"+mois+"/"+annee ,05, 275);--}}
        {{--            @endif--}}
        {{--            @if( app()->getLocale() === "en")--}}
        {{--            pdf.text('Page ' + i + '/' + totalPages,  260, 210);--}}
        {{--            pdf.text('Printed on : '+jour+"/"+mois+"/"+annee, 05, 210);--}}
        {{--            @endif--}}
        {{--            @if( app()->getLocale() === "pt")--}}
        {{--            pdf.text('Página ' + i + '/' + totalPages,  260, 210);--}}
        {{--            pdf.text('Imprima : '+jour+"/"+mois+"/"+annee ,05, 210);--}}
        {{--            @endif--}}
        {{--            pdf.addImage(imgData, "PNG",  260, 0);--}}
        {{--            pdf.text('{{$form->title}}',05,12);--}}
        {{--        }--}}
        {{--    }).save();--}}
        {{--};--}}

    </script>
@endpush
