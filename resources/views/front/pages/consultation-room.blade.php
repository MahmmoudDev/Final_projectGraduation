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
                            Dr. Ahmad Ali -
                            Cardiology Consultation
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
                            I have chest pain for two weeks,
                            and I feel tired most of the time.
                        </p>

                    </div>

                    <div class="qa-box answer-box">

                        <h6>
                            Doctor Answer
                        </h6>

                        <p>
                            Please do a blood test and ECG
                            to better understand your case.
                        </p>

                    </div>

                </div>

                <!-- Chat Box -->

                <div class="chat-card">

                    <h4 class="mb-4">
                        Live Consultation Chat
                    </h4>

                    <div class="chat-box">

                        <!-- User -->

                        <div class="message user-message">

                            <div class="message-content">
                                Hello doctor,
                                I still feel pain.
                            </div>

                        </div>

                        <!-- Doctor -->

                        <div class="message doctor-message">

                            <div class="message-content">
                                Hello Mahmoud,
                                can you describe the pain?
                            </div>

                        </div>

                        <!-- User -->

                        <div class="message user-message">

                            <div class="message-content">
                                It feels like pressure
                                in my chest.
                            </div>

                        </div>

                    </div>

                    <!-- Input -->

                    <div class="chat-input-box">

                        <input type="text" class="form-control chat-input" placeholder="Type your message...">

                        <button class="send-btn">
                            Send
                        </button>

                    </div>

                </div>

            </div>

        </section>

    @endsection
</body>
