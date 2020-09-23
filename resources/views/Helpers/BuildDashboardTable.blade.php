
<table style='width=100%' class='datatable table stripe dataTable no-footer dtr-column' id='table'>
    <thead>
    <tr>
        <th></th>
    </tr>
    </thead>
    <tbody id='showall'>
     @foreach($countries as $item)
         <tr><td  id={{$item->id}} class='{{$class}}'>{{ trans($item->name) }}</td></tr>
     @endforeach
    </tbody>
</table>

<script>
    $('#table').DataTable(
        {
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
            "bLengthChange" : false, //thought this line could hide the LengthMenu
            "bInfo":false,
        }
    );
</script>
