@php
    $data_for_chart = [];
    $fields = $form->fields;
    $template_alias_no_options = get_form_templates()->where('attribute_type', 'string')->pluck('alias')->all();
@endphp

<div class="panel panel-body" id="print" >
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
                                @if ($loop->index === 10)
                                    <tr><strong>{{ trans('more_info') }}</strong></tr>
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
        document.getElementById('download_pdf').onclick = function () {
            var now = new Date();
            var annee   = now.getFullYear();
            var mois    = now.getMonth() + 1;
            var jour    = now.getDate();
            var heure   = now.getHours();
            var minute  = now.getMinutes();
            var seconde = now.getSeconds();

            var imgData = 'data:image/png;base64,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'
            var element = document.getElementById('print');
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
                console.log(totalPages)
                for (i = 1; i <= totalPages; i++) {
                    console.log('here', i);
                    pdf.setPage(i);
                    pdf.text('Page ' + i + '/' + totalPages, 250, 210);
                    pdf.text('Imprimer le : '+jour+"/"+mois+"/"+annee+" à "+heure+":"+minute+":"+seconde,05, 210);
                    pdf.addImage(imgData, "PNG",  05, 0);
                    pdf.text('{{$form->title}}',40,12);
                }
            }).save();
        };
    </script>
@endpush
