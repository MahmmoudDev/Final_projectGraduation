@extends('dashboard.master')

@section('title', 'Show Consultation')

@section('Main-content', 'Consultations')
@section('breadcrumb-main', 'Consultations')
@section('breadcrumb-sub', 'Consultations')


@section('content')

    <div class="app-content">
        <div class="card">

            <div class="card-header">

                <h3>
                    Consultation Chat
                </h3>

            </div>

            <div class="card-body">

                <!-- User Info -->

                <div class="mb-4">

                    <h5>
                        Mahmoud Akram
                    </h5>

                    <p>
                        Dr. Ahmad Ali
                    </p>

                    <span class="badge
            bg-success">

                        Approved

                    </span>

                </div>

                <!-- Question -->

                <div class="alert
        alert-info">

                    <strong>
                        Question:
                    </strong>

                    I have chest pain
                    for two weeks.

                </div>

                <!-- Messages -->

                <div class="border
        rounded p-3
        mb-4"
                    style="
        height:400px;
        overflow-y:auto;
        background:#f8f9fa;
        ">

                    <!-- User -->

                    <div class="d-flex
            justify-content-end
            mb-3">

                        <div class="bg-primary
                text-white
                p-3 rounded"
                            style="
                max-width:300px;
                ">

                            Hello doctor

                        </div>

                    </div>

                    <!-- Provider -->

                    <div class="d-flex
            justify-content-start
            mb-3">

                        <div class="bg-light
                p-3 rounded"
                            style="
                max-width:300px;
                ">

                            Hello Mahmoud,
                            how can I help?

                        </div>

                    </div>

                </div>

                <!-- Reply -->

                <form>

                    <div class="row">

                        <div class="col-md-10">

                            <input type="text" class="form-control" placeholder="Type reply">

                        </div>

                        <div class="col-md-2">

                            <button class="btn
                    btn-primary
                    w-100">

                                Send

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
