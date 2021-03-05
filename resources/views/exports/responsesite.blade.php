<table>
    <thead>
    <tr>
        @foreach ($fields as $field)
            <th>{{ $field->question }}</th>
        @endforeach
        <th>@lang('Respondent')</th>
        <th>@lang('Site')</th>
        <th>@lang('Date Submitted')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($responses as $response)
        @if($response->respondent_site == $site_id)
            <tr>
                @foreach ($fields as $field)
                    @php
                        $field_responses = $field->responses;
                        $field_response = $field_responses->where('form_response_id', $response->id)->first();
                    @endphp
                    <td>{!! ($field_response) ? $field_response->getAnswerForTemplate($field->template) : '' !!}</td>
                @endforeach

                <td>
                    @php
                        if(!empty($response->respondent_id))
                          {
                               $user = \App\User::findOrFail($response->respondent_id);
                          }
                    @endphp
                    @if(isset($user))
                        {{ $user->first_name }} {{$user->last_name}}
                    @else

                    @endif
                </td>

                <td>
                    @php
                        if(!empty($response->respondent_site))
                          {
                               $site = \App\Site::findOrFail($response->respondent_site);
                          }
                    @endphp
                    @if(isset($site))
                        {{ $site->nom }}
                    @endif
                </td>

                <td>{{ $response->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
