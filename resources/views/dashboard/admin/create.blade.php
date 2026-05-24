@extends('dashboard.master')
@section('title', 'Create Admin')
@section('content')

@section('Main-content', 'Create Admin')
@section('breadcrumb-main', 'Dashboard')
@section('breadcrumb-sub', 'Create')

<div class="app-content">
    <form action="{{ route('admins.store') }}" method="POST" id="form_id">
        @csrf
        <div class="card-body">
            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" id="admin_name" value="{{ old('name') }}">
            </div>
            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" id="admin_email" value="{{ old('email') }}">
            </div>
            <div class="form-group mb-3">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" id="admin_mobile" value="{{ old('mobile') }}">
            </div>
            <div class="form-group mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" id="admin_password"
                    value="{{ old('password') }}">
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

        axios.post('{{ route('admins.store') }}', {
                name: document.getElementById('admin_name').value,
                email: document.getElementById('admin_email').value,
                mobile: document.getElementById('admin_mobile').value,
                password: document.getElementById('admin_password').value,
            })

            .then(function(response) {

                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: response.data.text,
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });

                document.getElementById('form_id').reset();

                setTimeout(() => {
                    window.location.href = '{{ route('admins.index') }}';
                });

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
