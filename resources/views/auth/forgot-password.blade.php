<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Ingreso panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('/css/login.css')}}">
    <link rel="icon" type="image/png" href="/img/favicon.ico">
  </head>
<body>
    <div class="pt-5">
        <div class="text-center">
          <img src="/img/logo.jpg" class="mx-auto d-block" alt="Imagen centrada">
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    Panel administrativo - Recuperar contraseña
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        @if (session('status'))
                            <h6 class="alert alert-success">{{ session('status') }}</h6>
                        @endif
                        @error('email')
                                <h6 class="alert alert-danger">{{ $message }}</h6>
                        @enderror
                      <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                      </div>
                      <div class="text-center">
                      <button type="submit" class="btn btn-primary">Recuperar contraseña</button>
                      </div>
                      <a href="/" class="btn btn-primary">Volver</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</body>
</html>
