<script src="https://js.pusher.com/5.0/pusher.min.js"></script>

<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;
    var pusher = new Pusher("{{ config('chatify.pusher.key') }}", {
        encrypted: true,
        cluster: "{{ config('chatify.pusher.options.cluster') }}",
        authEndpoint: '{{ route('pusher.auth') }}',
        auth: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }
    });
</script>
<script src="{{ asset('js/chatify/code.js') }}"></script>
<script>
    // Messenger global variable - 0 by default
    messenger = "{{ @$id }}";
</script>
