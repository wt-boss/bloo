<table style='width=100%' class='datatable table stripe' id='table'>
    <thead>
     <tr>
        <th></th>
        <th>Nom</th>
        <th>Pays</th>
         <th>Region</th>
     </tr>
    </thead>
    <tbody>
    @foreach($opusers as $item)
        <tr>
            <td></td>
            <td id='{{$item->id}}'><input type='checkbox' name='lecteurs[]' value='{{$item->id}}' {{$item->status}}>
                {{$item->first_name }} {{$item->last_name}}
            </td>
            <td>
                @if ($item->country)
                    {{ trans($item->country->name) }}
                @endif
            </td>
            <td>
                @if ($item->state)
                    {{ $item->state->name }}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<script>
    $('#table').DataTable({
        "language": {
            @if( app()->getLocale() === "fr" )
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
            @endif
                @if( app()->getLocale() === "en")
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/English.json"
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
    })
</script>
