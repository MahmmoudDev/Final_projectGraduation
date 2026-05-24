@extends('dashboard.master')
@section('title', 'Create Doctor')
@section('content')

@section('Main-content', 'Create Doctor')
@section('breadcrumb-main', 'Doctors')
@section('breadcrumb-sub', 'Create')

<div class="app-content">
    <form action="{{ route('doctors.store') }}" method="POST" id="form_id" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" id="doctor_name" value="{{ old('name') }}">
            </div>
            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" id="doctor_email" value="{{ old('email') }}">
            </div>
            <div class="col-md-6">

                <label>

                    Password

                </label>

                <input type="password" id="password_doctor" name="password" class="form-control">

            </div>
            <div class="form-group mb-3">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" id="doctor_mobile"
                    value="{{ old('mobile') }}">
            </div>
            <div class="form-group mb-3">
                <label>Specialization</label>
                <select name="specialization_id" class="form-control" id="doctor_specialization_id">
                    <option value="">Select Specialization</option>
                    @foreach ($specializations as $spec)
                        <option value="{{ $spec->id }}"
                            {{ old('specialization_id') == $spec->id ? 'selected' : '' }}>
                            {{ $spec->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Experience</label>
                <input type="text" name="experience" class="form-control" id="doctor_experience"
                    value="{{ old('experience') }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image-input">
            </div>
            <div class="form-group mb-3">
                <label>status</label>
                <select name="status" class="form-control" id="doctor_status">
                    <option value="">Select status</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                    </option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                    </option>
                </select>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" onclick="Store()">Save</button>

            </div>
    </form>
</div>

@endsection


@section('js')
<script>
    function Store() {
        let fromData = new FormData();
        fromData.append('name', document.getElementById('doctor_name').value);
        fromData.append('email', document.getElementById('doctor_email').value);
        fromData.append(
            'password',
            document
            .getElementById(
                'password_doctor'
            )
            .value
        );
        fromData.append('mobile', document.getElementById('doctor_mobile').value);
        fromData.append('specialization_id', document.getElementById('doctor_specialization_id').value);
        fromData.append('experience', document.getElementById('doctor_experience').value);
        fromData.append('image', document.getElementById('image-input').files[0]);
        fromData.append('status', document.getElementById('doctor_status').value);

        axios.post('/admin/doctors', fromData)
            .then(function(response) {
                Swal.fire({
                    icon: response.data.icon || 'success',
                    title: response.data.title || 'Created',
                    text: response.data.text || 'Doctor created successfully.',
                });

                document.getElementById('form_id').reset();
                window.location.href = '/admin/doctors';

            })
            .catch(function(error) {
                Swal.fire({
                    toast: true,
                    position: 'bottom-end',
                    icon: error.response.data.icon,
                    title: error.response.data.text || 'Server Error',
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true
                });
            });
    }
</script>

@endsection
