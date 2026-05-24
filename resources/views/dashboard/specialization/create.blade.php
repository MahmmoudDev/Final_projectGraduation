@extends('dashboard.master')
@section('title', 'Create specialization')
@section('content')

@section('Main-content', 'Create Specialization')
@section('breadcrumb-main', 'Specializations')
@section('breadcrumb-sub', 'Create')

<div class="app-content">
    <form action="{{ route('specializations.store') }}" method="POST" id="form_id">
        @csrf
        <div class="card-body">
            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" id="specialization_name"
                    value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image-input">
            </div>
            <div class="form-group mb-3">
                <label>Type</label>
                <select name="type" class="form-control" id="specialization_type">
                    <option value="">Select Type</option>
                    <option value="doctor">Doctor</option>
                    <option value="lawyer">Lawyer</option>
                </select>
            </div>
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
        fromData.append('name', document.getElementById('specialization_name').value);
        fromData.append('type', document.getElementById('specialization_type').value);
        fromData.append('image', document.getElementById('image-input').files[0]);

        axios.post('/admin/specializations', fromData)
            .then(function(response) {
                Swal.fire({
                    icon: response.data.icon || 'success',
                    title: response.data.title || 'Created',
                    text: response.data.text || 'Doctor created successfully.',
                });

                document.getElementById('form_id').reset();
                window.location.href = '/admin/specializations  ';

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
    // function Store() {

    //     axios.post('{{ route('specializations.store') }}', {
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
    //                 timer: 3000,
    //                 timerProgressBar: true
    //             });

    //             document.getElementById('form_id').reset();

    //             setTimeout(() => {
    //                 window.location.href = '{{ route('specializations.index') }}';
    //             }, 1000);

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
    //             }, 3000);

    //         });
    // }
</script>
@endsection
