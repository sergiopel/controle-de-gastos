@extends('layouts.auth')

@section('body-class', 'register-page')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ route('login') }}"><b>Admin</b>LTE</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="register-box-msg">Reset password</p>
                <form action="{{ route('password.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->token }}">
                    <div class="mb-3 input-group">
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                        <input type="email" name="email" value= "{{ request()->email ?? old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Email" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="mb-3 input-group">
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Password" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 input-group">
                        <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
                        <input type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Password Confirmation" />
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="gap-2 d-grid">
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>
@endsection

