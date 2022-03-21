@if(boolval($beginning ?? false))
    @prepend('style')
        <link rel="stylesheet" href="{{ asset($link) }}?version={{ last_modified_time($link) }}">
    @endprepend
@else
    @push('style')
        <link rel="stylesheet" href="{{ asset($link) }}?version={{ last_modified_time($link) }}">
    @endpush
@endif