@extends('dashboard.master')
@section('title', 'Edit Doctor')
@section('content')

@section('Main-content', 'Edit Doctor')
@section('breadcrumb-main', 'Doctors')
@section('breadcrumb-sub', 'Edit')

<div class="app-content">
    <form action="{{ route('doctors.update', $doctor->id) }}" method="POST" id="form_id" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" id="doctor_name"
                    value="{{ old('name', $doctor->name) }}">
            </div>
            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" id="doctor_email"
                    value="{{ old('email', $doctor->email) }}">

                <div class="col-md-6">

                    <label>

                        Password

                    </label>

                    <input value="{{ old('password', $doctor->password) }}" type="password" id="password_doctor"
                        name="password" class="form-control">

                </div>
            </div>
            <div class="form-group mb-3">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" id="doctor_mobile"
                    value="{{ old('mobile', $doctor->mobile) }}">
            </div>
            <div class="form-group mb-3">
                <label>Specialization</label>
                <select name="specialization_id" class="form-control" id="doctor_specialization_id">
                    <option value="">Select Specialization</option>
                    @foreach ($specializations as $spec)
                        <option value="{{ $spec->id }}"
                            {{ old('specialization_id', $doctor->specialization_id) == $spec->id ? 'selected' : '' }}>
                            {{ $spec->type }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Experience</label>
                <input type="text" name="experience" class="form-control" id="doctor_experience"
                    value="{{ old('experience', $doctor->experience) }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image-input">
                @if ($doctor->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/doctors/' . $doctor->image) }}" width="100">
                    </div>
                @endif
            </div>
            <div class="form-group mb-3">
                <label>status</label>
                <select name="status" class="form-control" id="doctor_status">
                    <option value="">Select status</option>

                    <option value="active"
                        {{ old('status', $doctor->status ? 'active' : 'inactive') == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive"
                        {{ old('status', $doctor->status ? 'active' : 'inactive') == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" onclick="update()">Save</button>

            </div>
    </form>
</div>

@endsection


@section('js')

<script>
    function update() {

        let formData = new FormData();

        formData.append('name', document.getElementById('doctor_name').value);
        formData.append('email', document.getElementById('doctor_email').value);
        fromData.append('password', document.getElementById('password_doctor').value);
        formData.append('mobile', document.getElementById('doctor_mobile').value);
        formData.append('specialization_id', document.getElementById('doctor_specialization_id').value);
        formData.append('experience', document.getElementById('doctor_experience').value);
        if (document.getElementById('image-input').files[0]) {
            formData.append('image', document.getElementById('image-input').files[0]);
        }
        formData.append('status', document.getElementById('doctor_status').value);
        formData.append('_method', 'PUT');
        axios.post('{{ route('doctors.update', $doctor->id) }}', formData)

            .then(function(response) {

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: response.data.text,
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });

                setTimeout(() => {
                    window.location.href = '{{ route('doctors.index') }}';
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
</script>


@endsection
