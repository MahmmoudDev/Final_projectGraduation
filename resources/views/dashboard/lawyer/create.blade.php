@extends('dashboard.master')
@section('title', 'Create lawyer')
@section('content')

@section('Main-content', 'Create lawyer')
@section('breadcrumb-main', 'Lawyers')
@section('breadcrumb-sub', 'Create')

<div class="app-content">
    <form action="{{ route('lawyers.store') }}" method="POST" id="form_id" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" id="lawyer_name" value="{{ old('name') }}">
            </div>
            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" id="lawyer_email" value="{{ old('email') }}">
            </div>
            <div class="form-group mb-3">

                <label>
                    Password
                </label>

                <input type="password" name="password" class="form-control" id="lawyer_password">

            </div>
            <div class="form-group mb-3">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" id="lawyer_mobile"
                    value="{{ old('mobile') }}">
            </div>

            <div class="form-group mb-3">
                <label>About Lawyer</label>
                <textarea rows="3" id="about_lawyer" name="about_lawyers" class="form-control contact-input"
                    placeholder="About me">

                </textarea>
            </div>
            <div class="form-group mb-3">
                <label>Specialization</label>
                <select name="specialization_id" class="form-control" id="lawyer_specialization_id">
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
                <input type="text" name="experience" class="form-control" id="lawyer_experience"
                    value="{{ old('experience') }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image-input">
            </div>
            <div class="form-group mb-3">
                <label>status</label>
                <select name="status" class="form-control" id="lawyer_status">
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
        // alert('hi');
        fromData.append('name', document.getElementById('lawyer_name').value);
        fromData.append('email', document.getElementById('lawyer_email').value);
        fromData.append(
            'password',
            document.getElementById(
                'lawyer_password'
            ).value
        );
        fromData.append('mobile', document.getElementById('lawyer_mobile').value);
        fromData.append('about_lawyers', document.getElementById('about_lawyer').value);
        fromData.append('specialization_id', document.getElementById('lawyer_specialization_id').value);
        fromData.append('experience', document.getElementById('lawyer_experience').value);
        fromData.append('image', document.getElementById('image-input').files[0]);
        fromData.append('status', document.getElementById('lawyer_status').value);

        axios.post('/admin/lawyers', fromData)
            .then(function(response) {
                Swal.fire({
                    icon: response.data.icon || 'success',
                    title: response.data.title || 'Created',
                    text: response.data.text || 'Lawyer created successfully.',
                });

                document.getElementById('form_id').reset();
                window.location.href = '/admin/lawyers';

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
