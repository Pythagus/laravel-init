@push('script')
    <script type="{{ boolval($module ?? false) ? 'module' : "text/javascript" }}" src="{{ asset($link) }}" defer></script>
@endpush
