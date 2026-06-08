@extends('front.layouts.master')
@section('title', 'Consultaion Room')

<body>

    @section('content')
        <section class="consultation-section">

            <div class="container">

                <!-- Consultation Header -->

                <div class="consultation-header">

                    <div>

                        <h2 class="mb-2">
                            Consultation Room
                        </h2>

                        <p class="mb-0">
                            @if ($consultation->service_type == 'doctor')
                                Dr. {{ $consultation->doctor->name }}
                            @else
                                {{ $consultation->lawyer->name }}
                            @endif
                        </p>

                    </div>

                    <span class="status-badge">
                        Approved
                    </span>

                </div>

                <!-- Question / Answer -->

                <div class="consultation-card">

                    <h4 class="mb-4">
                        Consultation Details
                    </h4>

                    <div class="qa-box question-box">

                        <h6>
                            Your Question
                        </h6>

                        <p>
                            {{ $consultation->question }}
                        </p>

                    </div>

                    {{-- <div class="qa-box answer-box">

                        <h6>
                            Doctor Answer
                        </h6>

                        <p>
                            {{ $consultation->answer ?? 'No answer yet' }}
                        </p>

                    </div> --}}

                </div>

                <!-- Chat Box -->

                <div class="consultation-card">

                    <h4 class="mb-4">
                        Messages
                    </h4>

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

                    @if ($consultation->appointment->status == 'approved')
                        <form id="chatForm" method="POST" action="{{ route('consultation.messages.store') }}"
                            onsubmit="return false;">
                            @csrf

                            <input type="hidden" name="consultation_id" value="{{ $consultation->id }}">

                            <div class="row mt-3">

                                <div class="col-md-10">

                                    <input type="text" name="message" class="form-control"
                                        placeholder="Type your message">

                                </div>

                                <div class="col-md-2">

                                    <button type="submit" class="btn btn-primary w-100">

                                        Send

                                    </button>

                                </div>

                            </div>

                        </form>
                    @else
                        <div class="alert alert-warning mt-3">

                            You can send messages only after the consultation is approved.

                        </div>
                    @endif

                </div>

            </div>






        </section>

    @endsection


</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {
        loadMessages();

        $('#chatForm').on('submit', function(e) {

            e.preventDefault();

            let formData = new FormData(this);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/consultation-messages',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {

                    $('input[name="message"]').val('');

                    loadMessages();

                },
                error: function(xhr) {

                    console.log(xhr.responseJSON);

                }
            });

        });

        setInterval(function() {
            loadMessages();

            $.ajax({
                url: '/consultation/{{ $consultation->id }}/messages',
                type: 'GET',
                success: function(response) {

                    console.log(response);

                },
                error: function(xhr) {

                    console.log(xhr.responseJSON);

                }
            });

        }, 2000);

        function loadMessages() {

            $.ajax({
                url: '/consultation/{{ $consultation->id }}/messages',
                type: 'GET',
                success: function(response) {

                    let html = '';

                    response.forEach(function(msg) {

                        if (msg.sender_type == 'user') {

                            html += `
                        <div class="text-end mb-3">
                            <div class="bg-primary text-white p-2 rounded d-inline-block">
                                ${msg.message}
                            </div>
                        </div>
                    `;

                        } else {

                            html += `
                        <div class="text-start mb-3">
                            <div class="bg-light p-2 rounded d-inline-block">
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

                }
            });

        }

    });
</script>
