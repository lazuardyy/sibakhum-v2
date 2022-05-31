@extends('layouts.front')

@section('content')
{{-- <div class="container px-4">
  <div class="row justify-content-center align-items-center gx-0">

    <div class="col-sm-5">
      <div class="card login__main-card shadow rounded">
        <div class="login__img-thumb rounded">
          <img src="{{ asset('img/unj.png') }}" alt="logo" class="rounded">
        </div>

        <div class="card-body border-0 p-5 bg-light">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="column mb-3">
              <label for="username" class="col-form-label text-md-start">{{ __('Username') }}</label>

              <div class="col-md-12">
                <input id="username" type="text" class="form-control
                @error('email') is-invalid @enderror" name="username"
                value="{{ old('username') }}" required autocomplete="username" autofocus>

                @error('username')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="column mb-3">
              <div class="d-flex align-items-center">
                <label for="password" class="col-form-label text-md-start flex-grow-1">{{ __('Password') }}</label>

                @if (Route::has('password.request'))
                  <a class="a-link text-md-start" href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                  </a>
                @endif
              </div>

              <div class="col-md-12">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">


                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="row mb-0">
              <div class="col-md-12 py-2">
                <button type="submit" class="btn btn-primary">
                  {{ __('Login') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-7">
      <div class="card-body border-0 p-5 bg-light">
        <div class="card__title">
          <h1>Informasi Cuti</h1>
        </div>
        <div class="card__content">
          <p>
            PERPANJANGAN PENGAJUAN DAN PEMBAYARAN CUTI SEMESTER GENAP (116) TAHUN AKADEMIK 2021/2022

            Bersama ini disampaikan perpanjangan jadwal pengajuan dan pembayaran biaya cuti semester genap (116) Tahun Akademik 2021/2022 sebagai berikut:

            Demikian edaran ini disampaikan untuk dilaksanakan sebagaimana mestinya. Atas perhatiannya, kami ucapkan terima kasih.
          </p>

          <p>
            Jakarta, 17 Maret 2022
            Wakil Rektor I Bidang Akademik
          </p>
          <p>
            TTD

            Prof. Dr. Suyono, M.Si
            NIP. 196712181993031005
          </p>
        </div>
        <div class="card__signature">

        </div>
      </div>
    </div>
  </div>
</div> --}}
<div class="container-md">
  <div class="row gy-2">
    <div class="col-md-5">
      <div class="card p-4 my-card border-0 shadow h-100" style="border-radius: 2rem">
        <img src="{{ asset('assets/img/unj.png') }}" alt="logo" class="border-0 rounded img-thumbnail bg-transparent p-2" style="width: 7rem">
        <div class="card-body">
          <h5 class="card-title text-uppercase fs-4 fw-bold">{{ config('app.name') }}</h5>
          <p class="card-text">Silahkan masuk dengan akun Siakad-mu</p>

          <form method="POST" action="/" class="d-flex flex-column gap-2">
            @csrf

            <div class="column">
              <label for="username" class="col-form-label text-md-start">{{ __('Username') }}</label>

              <div class="col-md-12">
                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan username-mu disini..."
                 name="username"
                value="{{ old('username') }}" required autocomplete="username" autofocus>

                @error('username')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="column">
              <div class="d-flex align-items-center">
                <label for="password" class="col-form-label text-md-start flex-grow-1">{{ __('Password') }}</label>

                {{-- @if (Route::has('password.request'))
                  <a class="a-link text-md-start" href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                  </a>
                @endif --}}
              </div>

              <div class="col-md-12">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password-mu disini..." name="password" required autocomplete="current-password">


                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="d-flex flex-column">
              <label for="" class="col-form-label text-md-start">
                @if (Route::has('password.request'))
                  <a class="a-link text-md-start" href="{{ route('password.request') }}">
                    {{ __('Forgot Password?') }}
                  </a>
                @endif

              </label>
              <div class="w-100">
                <button type="submit" class="btn btn-success w-100">
                  {{ __('Masuk') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="card p-4 my-card border-0 shadow h-100" style="border-radius: 2rem">
        <div class="card-body">
          <h5 class="card-title text-uppercase fs-4 fw-bold text-center">Informasi Cuti</h5>

          <div class="description mb-4">
            <p class="card-text">
              PERPANJANGAN PENGAJUAN DAN PEMBAYARAN CUTI SEMESTER GENAP (116) TAHUN AKADEMIK 2021/2022
            </p>
            <p class="card-text">
              Bersama ini disampaikan perpanjangan jadwal pengajuan dan pembayaran biaya cuti semester genap (116) Tahun Akademik 2021/2022 sebagai berikut:
            </p>

            <p class="card-text">Demikian edaran ini disampaikan untuk dilaksanakan sebagaimana mestinya. Atas perhatiannya, kami ucapkan terima kasih.</p>
          </div>

          <div class="signature signature d-flex flex-column align-items-end">
            <p class="card-text my__card-text">
              Jakarta, 17 Maret 2022
            </p>

            <p class="card-text">
              Wakil Rektor I Bidang Akademik
            </p>
            <p class="card-text">
              TTD
            </p>

            <p class="card-text my__card-text">
              NIP. 196712181993031005
            </p>

            <p class="card-text">
              Prof. Dr. Suyono, M.Si
            </p>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
