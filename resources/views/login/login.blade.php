<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<body style=" background-color: rgb(0, 0, 20) !important;">

      <div class="row d-flex justify-content-center mt-5" style="height: 80vh; align-items :center;">
          <div class=" col-sm-12 col-md-10 col-lg-4">
            @if (session('success'))
           <div class="alert alert-info">
            {{session('success')}}
           </div>
            @endif
            <div class="p-3 text-center fs-3 text-light fw-bold">Form Login</div>
            <form action="/login/store" method="post" autocomplete="on">
                @csrf
                <div>
                    <label for="">email</label>
                    <input type="text" name="email" id="" class="form-control form {{$errors->has('email') ? 'is-invalid' : ''}}" autocomplete="off" style="">
                </div>

                <div>
                    <label for="">Password</label>
                    <input type="password" name="password" id="" class="form-control form {{$errors->has('password') ? 'is-invalid' : ''}}" autocomplete="off" >
                </div>
                <p class="text-light">Belum punya akun ? silahkan <a href="/register">Register</a></p>
                <div>
                    <button class="btn btn-info my-2" type="submit">Login</button>
                </div>
                @if (session('error'))
                  <div class="alert alert-danger">
                    {{session('error')}}
                  </div>
                @endif
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

