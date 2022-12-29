@extends('auth.auth-app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <h3 class="font-weight-bold text-center margin-top">ប្រព័ន្ធគ្រប់គ្រងប្រាក់កម្ចី</h3>
                        {{-- <h3 class="font-weight-bold">ចូលប្រើប្រាស់ប្រព័ន្ធ</h3> --}}
                        <br/>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="material-icons-outlined">account_circle</span>
                            </span>
                                </div>
                                <input class="form-control" type="text" name="email"
                                       value="" required autofocus>
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="material-icons-outlined">lock</span>
                            </span>
                                </div>
                                <input class="form-control" type="password" name="password" required
                                       value="">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-primary text-center" type="submit">ចូលប្រព័ន្ធ</button>
                                </div>
                            </div>
                        </form>
                        @if ($errors->any())
                            <div class="text-danger text-center"><strong>{{ $errors->first() }}</strong></div>
                        @endif
                    </div>
                </div>

                <div class="card text-white bg-custom py-5 d-md-down-none" style="width:44%">
                    <div class="card-body text-center">
                        <img class="img-fluid max-height" draggable="false" src="{{ asset('assets/brand/brand.jpg') }}"
                             alt="">
                    </div>
                </div>
            </div>
        </div>
@stop
