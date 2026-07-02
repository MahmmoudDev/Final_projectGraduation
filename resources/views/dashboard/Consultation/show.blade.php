@extends('dashboard.master')

@section('title', 'Show Consultation')

@section('Main-content', 'Consultations')
@section('breadcrumb-main', 'Consultations')
@section('breadcrumb-sub', 'Consultations')


@section('content')

    <div class="app-content">
        {{-- <div style="height:400px;overflow-y:auto;" id="messagesBox">
            @foreach ($consultation->messages as $message)
                @if ($message->sender_type == 'user')
                    <div class="d-flex justify-content-end mb-3">

                        <div class="bg-primary text-white p-2 rounded d-inline-block">

                            {{ $message->message }}

                        </div>

                    </div>
                @else
                    <div class="d-flex justify-content-start mb-3">

                        <div class="bg-light p-2 rounded d-inline-block">

                            {{ $message->message }}

                        </div>

                    </div>
                @endif
            @endforeach

        </div> --}}

        <div style="height:400px;overflow-y:auto;" id="messagesBox">

            @foreach ($consultation->messages as $message)
                @if ($message->sender_type == 'user')
                    <div class="text-end mb-3">

                        <div class="bg-primary text-white p-2 rounded d-inline-block">

                            {{ $message->message }}

                        </div>

                    </div>
                @else
                    <div class="text-start mb-3">

                        <div class="bg-light p-2 rounded d-inline-block">

                            {{ $message->message }}

                        </div>

                    </div>
                @endif
            @endforeach

        </div>

        <form method="POST" id="chatForm" action="{{ route('consultation.messages.provider.store') }}">

            @csrf

            <input type="hidden" name="consultation_id" value="{{ $consultation->id }}">

            <div class="row">

                <div class="col-md-10">

                    <input type="text" name="message" class="form-control" placeholder="Type reply">

                </div>

                <div class="col-md-2">

                    <button type="submit" class="btn btn-primary w-100">

                        Send

                    </button>

                </div>

            </div>

        </form>

    </div>

@endsection



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {

        loadMessages();

        $('#chatForm').on('submit', function(e) {

            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('consultation.messages.provider.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function(response) {

                    $('input[name="message"]').val('');

                    loadMessages();
                },

                error: function(xhr) {

                    console.log(xhr);

                }
            });

        });

        setInterval(function() {

            loadMessages();

        }, 2000);

        function loadMessages() {

            $.ajax({
                url: "/consultation/{{ $consultation->id }}/messages",
                type: "GET",

                success: function(response) {

                    let html = '';

                    response.forEach(function(msg) {

                        if (msg.sender_type == 'lawyer' || msg.sender_type == 'doctor') {

                            html += `
            <div class="d-flex justify-content-end mb-3">
                <div class="bg-primary text-white p-2 rounded">
                    ${msg.message}
                </div>
            </div>
        `;

                        } else {

                            html += `
            <div class="d-flex justify-content-start mb-3">
                <div class="bg-light border p-2 rounded">
                    ${msg.message}
                </div>
            </div>
        `;
                        }

                    });

                    $('#messagesBox').html(html);

                    $('#messagesBox').scrollTop(
                        $('#messagesBox')[0].scrollHeight
                    );

                },

                error: function(xhr) {

                    console.log(xhr);

                }

            });

        }

    });
</script>
