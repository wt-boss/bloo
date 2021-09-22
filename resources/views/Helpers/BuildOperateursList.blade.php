<table style='width=100%' class='datatable table stripe' id='table26'>
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
            <td> <input type="hidden" name="operation" value="{{ $operation->id }}" /></td>
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
    $(document).ready(function (){
        var table =  $('#table26').DataTable({
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
        });

        // Handle form submission event
        $('#lecteur').on('submit', function(e){
            // Prevent actual form submission
            e.preventDefault();

            // Serialize form data
            var data = table.$('input').serialize();

            // Submit form data via Ajax
            $.ajax({
                url: '/addlecteurs',
                data: data,
                success: function(data){
                    console.log('Server response', data);
                }
            });
            setInterval(reload, 3000);

            // FOR DEMONSTRATION ONLY
            // The code below is not needed in production

            // Output form data to a console
            $('#example-console-form').text(data);
        });

        $('#operateur').on('submit', function(e){
            // Prevent actual form submission
            e.preventDefault();

            // Serialize form data
            var data = table.$('input').serialize();

            // Submit form data via Ajax
            $.ajax({
                url: '/addoperateurs',
                data: data,
                success: function(data){
                    console.log('Server response', data);
                }
            });
            setInterval(reload, 3000);

            // FOR DEMONSTRATION ONLY
            // The code below is not needed in production

            // Output form data to a console
            $('#example-console-form').text(data);
        });
    });
</script>
