    @extends('dashboard.master')
    @section('title', 'Edit Lawyer')
    @section('content')

    @section('Main-content', 'Edit Lawyer')
    @section('breadcrumb-main', 'Lawyers')
    @section('breadcrumb-sub', 'Edit')

    @section('content')

        <div class="card card-primary">
            <div class="card-header" style="background-color: #343a40;">
                <h3 class="card-title text-white mb-0">Update Personal Profile Information</h3>
            </div>

            <form id="form_id" onsubmit="update(event)" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="name" class="fw-bold">Full Name</label>
                            <input type="text" value="{{ old('name', $lawyer->name) }}" name="name" id="lawyer_name"
                                class="form-control" required>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="email" class="fw-bold">Email Address</label>
                            <input type="email" value="{{ old('email', $lawyer->email) }}" name="email"
                                id="lawyer_email" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="mobile" class="fw-bold">Mobile Number</label>
                            <input type="text" value="{{ old('mobile', $lawyer->mobile) }}" name="mobile"
                                id="lawyer_mobile" class="form-control" required>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="experience" class="fw-bold">Experience (Years)</label>
                            <input type="text" value="{{ old('experience', $lawyer->experience) }}" name="experience"
                                id="lawyer_experience" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="specialization_id" class="fw-bold">Specialization</label>

                            <select name="specialization_id" id="lawyer_specialization_id" class="form-control" required>
                                <option value="" disabled>Seletect specialization</option>
                                @if (isset($specializations))
                                    @foreach ($specializations as $specialization)
                                        <option value="{{ $specialization->id }}"
                                            {{ $lawyer->specialization_id == $specialization->id ? 'selected' : '' }}>
                                            {{ $specialization->name }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="{{ $lawyer->specialization_id }}" selected>Current Specialization (ID:
                                        {{ $lawyer->specialization_id }})</option>
                                @endif
                            </select>
                        </div>


                    </div>

                    <div class="form-group mb-3">
                        <label for="image" class="fw-bold">Profile Image</label>
                        <input type="file" name="image" id="image-input" class="form-control">

                        @if ($lawyer->image)
                            <div class="mt-2">
                                @php
                                    $img = $lawyer->image;
                                    $path = Str::contains($img, 'lawyers') ? $img : 'lawyers/' . $img;
                                @endphp
                                <img src="{{ asset('storage/' . $path) }}" class="img-thumbnail"
                                    style="width: 90px; height: 90px; object-fit: cover;">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn text-white fw-bold"
                        style="background-color: #F7941D; border-radius: 4px; padding: 10px 30px;">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

    @endsection


    @section('js')
        <script>
            function update(event) {

                event.preventDefault();

                let formData = new FormData();

                formData.append('name', document.getElementById('lawyer_name').value);
                formData.append('email', document.getElementById('lawyer_email').value);
                formData.append('mobile', document.getElementById('lawyer_mobile').value);
                formData.append(
                    'specialization_id',
                    document.getElementById('lawyer_specialization_id').value
                );
                formData.append(
                    'experience',
                    document.getElementById('lawyer_experience').value
                );

                if (document.getElementById('image-input').files[0]) {
                    formData.append(
                        'image',
                        document.getElementById('image-input').files[0]
                    );
                }

                formData.append('_method', 'PUT');

                axios.post('{{ route('lawyer.update.myprofile') }}', formData)
                    .then(function(response) {

                        let navbarImg =
                            document.querySelector('.user-menu img');

                        let navbarName =
                            document.querySelector('.user-menu span');

                        let pagePreviewImg =
                            document.getElementById('profile-preview-img');


                        // تحديث الاسم
                        if (navbarName) {
                            navbarName.innerText = response.data.name;
                        }

                        // تحديث الصورة
                        if (response.data.image) {

                            if (navbarImg) {
                                navbarImg.src =
                                    response.data.image + '?' + new Date().getTime();
                            }

                            if (pagePreviewImg) {
                                pagePreviewImg.src =
                                    response.data.image + '?' + new Date().getTime();
                            }
                        }

                        Swal.fire({
                            toast: true,
                            position: 'bottom-end',
                            icon: response.data.icon,
                            title: response.data.text,
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true
                        });

                        document.getElementById('image-input').value = '';

                    })
                    .catch(function(error) {

                        let errorText =
                            'حدث خطأ ما أرجو إعادة المحاولة';

                        if (
                            error.response &&
                            error.response.data &&
                            error.response.data.errors
                        ) {
                            errorText = Object.values(
                                error.response.data.errors
                            ).flat().join(' | ');
                        }

                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: errorText,
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true
                        });
                    });
            }
        </script>
    @endsection
