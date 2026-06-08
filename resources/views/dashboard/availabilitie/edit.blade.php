@extends('dashboard.master')
@section('title', 'Edit Availability')
@section('content')

@section('Main-content', 'Edit Availability')
@section('breadcrumb-main', 'Availabilities')
@section('breadcrumb-sub', 'Edit')

<div class="app-content">
    <form action="{{ route('availabilities.update', $availabilitie->id) }}" method="POST" id="form_id">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group mb-3">
                <label>Service Type</label>
                <select name="service_type" class="form-control" id="service_type">
                    <option value="">Select Type</option>
                    <option value="doctor"
                        {{ old('service_type', $availabilitie->service_type) == 'doctor' ? 'selected' : '' }}>Doctor
                    </option>
                    <option value="lawyer"
                        {{ old('service_type', $availabilitie->service_type) == 'lawyer' ? 'selected' : '' }}>Lawyer
                    </option>
                </select>
            </div>
            <select name="service_provider_id" class="form-control" id="service_provider_id">

                <option value="">
                    Select Provider
                </option>


            </select>
            {{-- <div class="form-group mb-3">
                <label>Service Type</label>
                <input type="text" name="service_type" class="form-control" id="service_type"
                    value="{{ old('service_type', $availabilitie->service_type) }}">
            </div> --}}
            <div class="form-group mb-3">
                <label>Day From</label>
                @php
                    $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                @endphp
                <select name="day_from" class="form-control" id="day_from">
                    <option value="" id="select_day"> Select Day </option>
                    @foreach ($days as $day)
                        <option value="{{ $day }}"
                            {{ old('day_from', $availabilitie->day_from ?? '') == $day ? 'selected' : '' }}>
                            {{ $day }}
                        </option>
                    @endforeach

                </select>
            </div>
            <div class="form-group mb-3">
                <label>Day To</label>
                @php
                    $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                @endphp
                <select name="day_to" class="form-control" id="day_to">
                    <option value=""> Select Day </option>
                    @foreach ($days as $day)
                        <option value="{{ $day }}"
                            {{ old('day_to', $availabilitie->day_to ?? '') == $day ? 'selected' : '' }}>
                            {{ $day }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label>Start Time</label>

                        <div class="input-group date" id="start_time_picker" data-target-input="nearest">

                            <input type="text" id="start_time" name="start_time"
                                class="form-control datetimepicker-input" data-target="#start_time_picker" value="{{ old('start_time', $availabilitie->start_time) }}" />

                            <div class="input-group-append" data-target="#start_time_picker"
                                data-toggle="datetimepicker">


                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group">
                        <label>End Time</label>

                        <div class="input-group date" id="end_time_picker" data-target-input="nearest">

                            <input type="text" id="end_time" name="end_time"
                                class="form-control datetimepicker-input" data-target="#end_time_picker" value="{{ old('end_time', $availabilitie->end_time) }}" />

                            <div class="input-group-append" data-target="#end_time_picker" data-toggle="datetimepicker">


                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <div class="form-group mb-3">
                <label>Status</label>
                <select name="is_available" class="form-control" id="is_available">
                    <option value="1"
                        {{ old('is_available', $availabilitie->is_available) == '1' ? 'selected' : '' }}>Available
                    </option>
                    <option value="0"
                        {{ old('is_available', $availabilitie->is_available) == '0' ? 'selected' : '' }}>Unavailable
                    </option>
                </select>
            </div>
            <button type="button" class="btn btn-primary" onclick="update()">
                Update
            </button>
        @endsection


        @section('js')
            <script src="{{ asset('adminlte/js/jquery-3.7.1.min.js') }}"></script>
            <script src="{{ asset('adminlte/js/jquery.timepicker.min.js') }}"></script>
            <script>
                function update() {

                    let formData = new FormData();
                    formData.append('service_type', document.getElementById('service_type').value);
                    formData.append('service_provider_id', document.getElementById('service_provider_id').value);
                    formData.append('day_from', document.getElementById('day_from').value);
                    formData.append('day_to', document.getElementById('day_to').value);
                    formData.append('start_time', document.getElementById('start_time').value);
                    formData.append('end_time', document.getElementById('end_time').value);
                    formData.append('is_available', document.getElementById('is_available').value);
                    formData.append('_method', 'PUT');
                    axios.post('{{ route('availabilities.update', $availabilitie->id) }}', formData)


                        .then(function(response) {

                            Swal.fire({
                                icon: response.data.icon || 'success',
                                title: response.data.title || 'Created',
                                text: response.data.text ||
                                    'Availability updated successfully',
                            });

                            setTimeout(() => {
                                window.location.href = '{{ route('availabilities.index') }}';
                            }, 2000);
                        })

                        .catch(function(error) {

                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: Object.values(error.response.data.errors)
                                    .flat()
                                    .join(' | '),
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true
                            });

                        });
                }
                $(function() {

                    function loadProviders(
                        selectedType,
                        selectedProviderId = null
                    ) {

                        $.ajax({
                            url: "{{ route('get.specializations') }}",
                            type: "GET",
                            data: {
                                type: selectedType
                            },
                            success: function(data) {
                                let providerSelect =
                                    $("#service_provider_id");
                                providerSelect.empty();
                                providerSelect.append(
                                    '<option value="">Select Provider</option>'
                                );
                                data.forEach(function(
                                    provider
                                ) {
                                    providerSelect.append(
                                        '<option value="' +
                                        provider.id +
                                        '"' +
                                        (
                                            provider.id ==
                                            selectedProviderId ?
                                            ' selected' :
                                            ''
                                        ) +
                                        '>' +
                                        provider.id +
                                        '</option>'
                                    );
                                });
                            }
                        });
                    }

                    $("#service_type").change(
                        function() {

                            loadProviders(
                                $(this).val()
                            );
                        }
                    );

                    loadProviders(
                        $("#service_type").val(),
                        "{{ $availabilitie->service_provider_id }}"
                    );

                });

                $(function() {

                    $('#start_time').timepicker({
                        timeFormat: 'h:mm p',
                        interval: 60,
                        dynamic: false,
                        dropdown: true,
                        scrollbar: true
                    });

                    $('#end_time').timepicker({
                        timeFormat: 'h:mm p',
                        interval: 60,
                        dynamic: false,
                        dropdown: true,
                        scrollbar: true
                    });

                });
            </script>


        @endsection
