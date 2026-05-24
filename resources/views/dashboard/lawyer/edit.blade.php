@extends('dashboard.master')
@section('title', 'Edit Lawyer')
@section('content')

@section('Main-content', 'Edit Lawyer')
@section('breadcrumb-main', 'Lawyers')
@section('breadcrumb-sub', 'Edit')

<div class="app-content">
    <form action="{{ route('lawyers.update', $lawyer->id) }}" method="POST" id="form_id" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" id="lawyer_name"
                    value="{{ old('name', $lawyer->name) }}">
            </div>
            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" id="lawyer_email"
                    value="{{ old('email', $lawyer->email) }}">
            </div>
            <div class="form-group mb-3">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" id="lawyer_mobile"
                    value="{{ old('mobile', $lawyer->mobile) }}">
            </div>
            <div class="form-group mb-3">
                <label>Specialization</label>
                <select name="specialization_id" class="form-control" id="lawyer_specialization_id">
                    <option value="">Select Specialization</option>
                    @foreach ($specializations as $spec)
                        <option value="{{ $spec->id }}"
                            {{ old('specialization_id', $lawyer->specialization_id) == $spec->id ? 'selected' : '' }}>
                            {{ $spec->type }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3">
                <label>Experience</label>
                <input type="text" name="experience" class="form-control" id="lawyer_experience"
                    value="{{ old('experience', $lawyer->experience) }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image-input">
                @if ($lawyer->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/lawyers/' . $lawyer->image) }}" width="100">
                    </div>
                @endif
            </div>
            <div class="form-group mb-3">
                <label>status</label>
                <select name="status" class="form-control" id="lawyer_status">
                    <option value="">Select status</option>

                    <option value="active"
                        {{ old('status', $lawyer->status ? 'active' : 'inactive') == 'active' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="inactive"
                        {{ old('status', $lawyer->status ? 'active' : 'inactive') == 'inactive' ? 'selected' : '' }}>
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

        formData.append('name', document.getElementById('lawyer_name').value);
        formData.append('email', document.getElementById('lawyer_email').value);
        formData.append('mobile', document.getElementById('lawyer_mobile').value);
        formData.append('specialization_id', document.getElementById('lawyer_specialization_id').value);
        formData.append('experience', document.getElementById('lawyer_experience').value);
        if (document.getElementById('image-input').files[0]) {
            formData.append('image', document.getElementById('image-input').files[0]);
        }
        formData.append('status', document.getElementById('lawyer_status').value);
        formData.append('_method', 'PUT');
        axios.post('{{ route('lawyers.update', $lawyer->id) }}', formData)

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
                    window.location.href = '{{ route('lawyers.index') }}';
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
