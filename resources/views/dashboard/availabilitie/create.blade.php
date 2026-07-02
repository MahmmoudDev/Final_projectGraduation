@extends('dashboard.master')
@section('title', 'Create Availability')

@section('content')

@section('Main-content', 'Create Availability')
@section('breadcrumb-main', 'Availabilities')
@section('breadcrumb-sub', 'Create')

<div class="app-content">

    <form id="form_id">
        @csrf

        <div class="card-body">

            <div class="form-group mb-3">
                <label>Service Type</label>
                <select name="service_type" class="form-control" id="service_type">
                    <option value="">Select Type</option>
                    <option value="doctor">Doctor</option>
                    <option value="lawyer">Lawyer</option>
                </select>
            </div>

            <div class="form-group mb-3">

                <label>Service Provider</label>

                <select name="service_provider_id" class="form-control" id="service_provider_id">

                    <option value="">
                        Select Provider
                    </option>

                </select>

            </div>

            <div class="form-group mb-3">
                <label>Day From</label>
                <select name="day_from" class="form-control" id="day_from">
                    <option value="">Select Day</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Day To</label>
                <select name="day_to" class="form-control" id="day_to">
                    <option value="">Select Day</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                </select>
            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">
                        <label>Start Time</label>

                        <div class="input-group date" id="start_time_picker" data-target-input="nearest">

                            <input type="text" id="start_time" name="start_time"
                                class="form-control datetimepicker-input" data-target="#start_time_picker" />

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
                                class="form-control datetimepicker-input" data-target="#end_time_picker" />

                            <div class="input-group-append" data-target="#end_time_picker" data-toggle="datetimepicker">


                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <div class="form-group mb-3">
                <label>Status</label>
                <select name="is_available" class="form-control" id="is_available">
                    <option value="1">Available</option>
                    <option value="0">Unavailable</option>
                </select>
            </div>

        </div>

        <div class="card-footer">
            <button type="button" class="btn btn-primary" onclick="Store()">
                Save
            </button>
        </div>

    </form>

</div>

@endsection

@section('js')
<script src="{{ asset('adminlte/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('adminlte/js/jquery.timepicker.min.js') }}"></script>

<script>
    function Store() {
        // dd($request - > all());
        let formData = new FormData();

        formData.append('service_type',
            document.getElementById('service_type').value);

        formData.append('service_provider_id',
            document.getElementById('service_provider_id').value);

        formData.append('day_from',
            document.getElementById('day_from').value);

        formData.append('day_to',
            document.getElementById('day_to').value);

        formData.append('start_time',
            document.getElementById('start_time').value);

        formData.append('end_time',
            document.getElementById('end_time').value);

        formData.append('is_available',
            document.getElementById('is_available').value);

        axios.post('/admin/availabilities', formData)
            // alert(dd('store method'));

            .then(function(response) {

                Swal.fire({
                    icon: response.data.icon || 'success',
                    title: response.data.title || 'Created',
                    text: response.data.text ||
                        'Availability created successfully',
                });

                document.getElementById('form_id').reset();

                window.location.href =
                    '/admin/availabilities';
            })

            .catch(function(error) {

                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    icon: 'error',
                    title: error.response.data.text ||
                        'Server Error',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true
                });

            });
    }

    $(function() {


        $("#service_type").change(function() {

            let selectedType =
                $(this).val();



            $.ajax({

                url: "{{ route('get.providers') }}",

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
                            '<option value="' + provider.id + '">' +
                            provider.name + ' - ' +
                            provider.specialization.name +
                            '</option>'
                        );
                    });

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: "Service Provider Loaded",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                },

                error: function(
                    error
                ) {

                    console.log(error);

                    toastr.error(
                        'Failed to fetch providers'
                    );
                }
            });
        });
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
