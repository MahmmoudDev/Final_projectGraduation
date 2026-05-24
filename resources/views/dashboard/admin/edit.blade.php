@extends('dashboard.master')
@section('title', 'Edit Admin')
@section('content')

@section('Main-content', 'Edit Admin')
@section('breadcrumb-main', 'Dashboard')
@section('breadcrumb-sub', 'Edit')

<div class="app-content">
    <form action="{{ route('admins.update', $admin->id) }}" method="POST" id="form_id">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" id="admin_name"
                    value="{{ old('name') ?? $admin->name }}">
            </div>
            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" id="admin_email"
                    value="{{ old('email') ?? $admin->email }}">
            </div>
            <div class="form-group mb-3">
                <label>Mobile</label>
                <input type="text" name="mobile" class="form-control" id="admin_mobile"
                    value="{{ old('mobile') ?? $admin->mobile }}">
            </div>
            <div class="form-group mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" id="admin_password">
                <small class="text-muted mb-3">
                    Leave blank if you don't want to change password
                </small>
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

        axios.post('{{ route('admins.update', $admin->id) }}', {
                _method: 'PUT',
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
                    timer: 2000,
                    timerProgressBar: true
                },2000);



                setTimeout(() => {
                    window.location.href = '{{ route('admins.index') }}';
                },2000);

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
