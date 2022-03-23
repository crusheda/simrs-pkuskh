@extends('layouts.newAdmin')

@section('content')
<div class="card">
  <div class="col-12">
    <div class="card-header">
        <h4>Bcrypt Hash Password Laravel</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('auth.change_password') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group {{ $errors->has('current_password') ? 'has-error' : '' }}">
                <label for="current_password">Password sekarang *</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
                @if($errors->has('current_password'))
                    <em class="invalid-feedback">
                        {{ $errors->first('current_password') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
                <label for="new_password">Password baru *</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
                @if($errors->has('new_password'))
                    <em class="invalid-feedback">
                        {{ $errors->first('new_password') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
                <label for="new_password_confirmation">Konfirmasi password baru *</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                @if($errors->has('new_password_confirmation'))
                    <em class="invalid-feedback">
                        {{ $errors->first('new_password_confirmation') }}
                    </em>
                @endif
            </div>
            <p><b>Catatan :</b> Jangan bagikan password anda kepada orang lain.</p>
            <div>
                <input class="btn btn-danger" type="submit" value="Submit">
            </div>
        </form>

    </div>
  </div>
</div>
@endsection