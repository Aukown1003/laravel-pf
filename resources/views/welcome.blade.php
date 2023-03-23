@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6 text-center mx-auto">
        <h1>ようこそlaravel-Pfへ</h1>
        <p>以下か、上部ヘッダーより、ログインもしくは、新規登録を行ってください</p>
        <div class="d-flex justify-content-center">
          <div class="me-2">
            <a href="{{ route('login') }}" class="btn btn-primary">{{ __('ログイン') }}</a>
          </div>
          <div class="ms-2">
            <a href="{{ route('register') }}" class="btn btn-success">{{ __('登録') }}</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
