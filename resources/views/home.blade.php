@extends('layouts.admin')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <h5>Hai, {{ Auth::user()->name }}</h5>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection