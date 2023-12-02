<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<body style=" background-color: rgb(0, 0, 20) !important;">
<div class="row d-flex justify-content-center mt-5" style="height: 80vh; align-items :center;">
        <div class="col-sm-10 col-md-10 col-lg-4">
            @if (session('success'))
           <div class="alert alert-info">
            {{session('success')}}
           </div>
            @endif
            <div class="p-3 text-center fs-3 text-light fw-bold">Form Registrasi</div>
            <form action="/register/store" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="">Username</label>
                    <input type="text" name="name" id="" class="form-control form {{$errors->has('name') ? 'is-invalid' : ''}}">
                </div>
                @error('name')
                <div class="text-danger ">
                    {{$message}}
                </div>
                @enderror
                <div>
                    <label for="">Image</label>
                    <input type="file" name="image" id="" class="form-control form ">
                </div>
                @error('image')
                <div class="text-danger ">
                    {{$message}}
                </div>
                @enderror
                <div>
                    <label for="">Email</label>
                    <input type="email" name="email" id="" class="form-control form {{$errors->has('email') ? 'is-invalid' : ''}}">
                </div>
                @error('email')
                <div class="text-danger ">
                    {{$message}}
                </div>
                @enderror
                <div>
                    <label for="">Password</label>
                    <input type="password" name="password" id="" class="form-control form {{$errors->has('password') ? 'is-invalid' : ''}}">
                </div>
                @error('password')
                <div class="text-danger ">
                    {{$message}}
                </div>
                @enderror
                <p>Silahkan anda <a href="/login">Login</a></p>
                <div>
                    <button class="btn btn-info my-2" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
