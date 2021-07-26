@extends('layouts.app')
@section('content')
<title>Lupa Password | SIMRSKU</title>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <h1>
                            <div class="login-logo">
                                <img src="{{ asset('css-landing/img/landing-logotext.png') }}" alt="">
                            </div>
                        </h1>
                        <p class="text-muted"></p><br>
                        <div>
                            {{ csrf_field() }}
                            <div class="form-group has-feedback">
                                <input type="email" name="email" class="form-control" required="autofocus" placeholder="Masukkan Email Sesuai Akun Anda...">
                                @if($errors->has('email'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </em>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-dark btn-flat pull-left" id="btn-reset">
                                    <i class="fa-fw fas fa-refresh nav-icon"></i> Reset
                                </button>
                                <button type="button" onclick="window.location.href='{{ url('/') }}'" class="btn btn-info pull-right text-white">
                                    <i class="fa-fw fas fa-caret-left nav-icon"></i> Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script>
    $(document).ready( function () {
        $( "#btn-reset" ).click(function() {
            $(this).find("i").toggleClass("fa-refresh fa-refresh fa-spin");
        });
    });
</script>
@endsection