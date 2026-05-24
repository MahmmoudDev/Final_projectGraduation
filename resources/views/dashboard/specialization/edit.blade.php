@extends('dashboard.master')
@section('title', 'Edit Specialization')
@section('content')

@section('Main-content', 'Edit Specialization')
@section('breadcrumb-main', 'Specializations')
@section('breadcrumb-sub', 'Edit')

<div class="app-content">
    <form action="{{ route('specializations.update', $specialization->id) }}" method="POST" id="form_id">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" id="specialization_name"
                    value="{{ old('name') ?? $specialization->name }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image-input">
                @if ($specialization->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/specialization/' . $specialization->image) }}" width="100">
                    </div>
                @endif
            </div>
            <div class="form-group mb-3">
                <label>Type</label>
                <select name="type" class="form-control" id="specialization_type">
                    <option value="">Select Type</option>
                    <option value="doctor" {{ old('type') ?? $specialization->type === 'doctor' ? 'selected' : '' }}>
                        Doctor
                    </option>
                    <option value="lawyer" {{ old('type') ?? $specialization->type === 'lawyer' ? 'selected' : '' }}>
                        Lawyer
                    </option>
                </select>
            </div>

        </div>
        <div class="card-footer mt-3">
            <button type="button" class="btn btn-primary" onclick="update()">Save</button>

        </div>
    </form>
</div>

@endsection


@section('js')

<script>
    function update() {

        let formData = new FormData();

        formData.append('name', document.getElementById('specialization_name').value);
        formData.append('type', document.getElementById('specialization_type').value);
        if (document.getElementById('image-input').files[0]) {
            formData.append('image', document.getElementById('image-input').files[0]);
        }
        formData.append('_method', 'PUT');
        axios.post('{{ route('specializations.update', $specialization->id) }}', formData)

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
                    window.location.href = '{{ route('specializations.index') }}';
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

    // function update() {

    //     axios.post('{{ route('specializations.update', $specialization->id) }}', {
    //             _method: 'PUT',
    //             name: document.getElementById('specialization_name').value,
    //             type: document.getElementById('specialization_type').value,
    //         })

    //         .then(function(response) {

    //             Swal.fire({
    //                 toast: true,
    //                 position: 'top-end',
    //                 icon: 'success',
    //                 title: response.data.text,
    //                 showConfirmButton: false,
    //                 timer: 2000,
    //                 timerProgressBar: true
    //             }, 2000);



    //             setTimeout(() => {
    //                 window.location.href = '{{ route('specializations.index') }}';
    //             }, 2000);

    //         })

    //         .catch(function(error) {

    //             Swal.fire({
    //                 toast: true,
    //                 position: 'top-end',
    //                 icon: 'error',
    //                 title: Object.values(error.response.data.errors)
    //                     .flat()
    //                     .join(' | '),
    //                 showConfirmButton: false,
    //                 timer: 4000,
    //                 timerProgressBar: true
    //             });

    //         });
    // }
</script>


@endsection
