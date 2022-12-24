@extends('layouts.app')
@section('title')
    អ្នកប្រើប្រាស់
@stop
@section('content')
@include('includes.alert-info')
    <div class="card">
        <div class="card-header">
            <strong>បង្កើតអ្នកប្រើប្រាស់</strong>
        </div>
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label>ប្រភេទ</label>
                        <select class="form-control select2  {{ $errors->first('user_type_id') ? 'is-invalid':'' }}"  name="user_type_id" id="user_type_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ old('user_type_id') == $type->id ? 'selected' :  '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('user_type_id') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>សាខា</label>
                        <select class="form-control select2 {{ $errors->first('branch_id') ? 'is-invalid':'' }}" name="branch_id" id="branch_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' :  '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('branch_id') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ឈ្មោះ</label>
                        <input
                            class="form-control {{ $errors->first('name') ? 'is-invalid':'' }}"
                            name="name"
                            type="text"
                            placeholder="Men"
                            autocomplete="false"
                            value="{{ old('name') }}"
                            maxlength="50" >
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>គណនី</label>
                        <input
                            class="form-control {{ $errors->first('email') ? 'is-invalid':'' }}"
                            name="email"
                            type="text"
                            autocomplete="false"
                            placeholder="BigMen"
                            value="{{ old('email') }}"
                            maxlength="50" >
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>លេខសំងាត់</label>
                        <input
                            class="form-control {{ $errors->first('password') ? 'is-invalid':'' }}"
                            name="password"
                            type="password"
                            autocomplete="false"
                            placeholder="********"
                            value="{{ old('password') }}"
                            maxlength="50" >
                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                    </div>
{{-- 
                    <div class="form-group col-sm-6">
                        <div class="card">
                            <div class="card-header text-center"> <strong>ម៉ឺនុយ</strong> </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($groups as $group)
                                        @foreach( $group->menus as $menus )
                                            @if( count($menus->childs) > 0 )
                                                @foreach( $menus->childs as $child )
                                                <div class="form-group col-sm-3">
                                                    <label class="btn btn-sm">
                                                        <input type="checkbox" name="menu[]" value="{{$child->id??''}}" class="btn-check" id="{{$child->id??''}}" autocomplete="off">
                                                        {{$child->label??''}}
                                                    </label>
                                                </div>
                                                @endforeach
                                            @else
                                                <div class="form-group col-sm-3">
                                                    <label class="btn btn-sm">
                                                        <input type="checkbox" name="menu[]" value="{{$menus->id??''}}" class="btn-check" id="{{$menus->id??''}}" autocomplete="off">
                                                        {{$menus->label??''}}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>

                            </div>
                        </div>

                    </div> --}}
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-sm btn-success float-right" type="submit">
                            <span class="material-icons-outlined">save</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
</div>
@endsection
