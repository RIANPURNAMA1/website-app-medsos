@extends('app')

@section('app')
    <div class="card my-3 p-2 form">
        <h1 class="fw-bold ">Setting Profile</h1>
    </div>

    <div class="row">
        <div class="col">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('/post/update-setting/'.$user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <!-- Tambahkan input untuk setiap field yang ingin diedit -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control form" value="{{ $user->name }}" required>
                </div>

                <!-- Input untuk gambar -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" id="image" name="image" class="form-control form">
                </div>

                <!-- Input untuk email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control form" value="{{ $user->email }}" required>
                </div>
                {{-- bio profile --}}
                <div class="mb-3">
                    <label for="bio" class="form-label">Bio:</label>
                    <input type="bio" id="bio" name="bio" class="form-control form" value="{{ $user->bio }}" required>
                </div>

                <!-- Input untuk password lama -->
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password:</label>
                    <input type="password" id="current_password" name="current_password" class="form-control form">
                </div>

                <!-- Input untuk password baru -->
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password:</label>
                    <input type="password" id="new_password" name="new_password" class="form-control form">
                </div>

                <!-- Input untuk verifikasi password baru -->
                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirm New Password:</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control form">
                </div>

                <!-- Button untuk submit -->
                <button type="submit" class="btn btn-light my-3">Update</button>
            </form>
        </div>
    </div>
@endsection
