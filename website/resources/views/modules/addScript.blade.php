@if(boolval($beginning ?? false))
    @prepend('script')
        <script type="{{ boolval($module ?? false)?'module':"text/javascript" }}" src="{{ asset($link) }}?version={{ last_modified_time($link) }}"></script>
    @endprepend
@else
    @push('script')
        <script type="{{ boolval($module ?? false)?'module':"text/javascript" }}" src="{{ asset($link) }}?version={{ last_modified_time($link) }}"></script>
    @endpush
@endif