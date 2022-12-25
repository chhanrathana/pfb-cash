@extends('layouts.app')
@section('title','កែប្រែ-ប្រភេទចំណាយ')
    
@section('content')
@include('includes.alert-info')
    <div class="card">
        <div class="card-header bg-custom"><strong>កែប្រែ-ប្រភេទចំណាយ</strong></div>

        <form action="{{ route('master-data.expense-type.update',['id' => $expense->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">                   
                    <div class="form-group col-sm-4">
                        <label>ឈ្មោះ</label>
                        <input
                            class="form-control {{ $errors->first('name_kh') ? 'is-invalid':'' }}"
                            name="name_kh"
                            type="text"
                            placeholder="ទិញសម្ភារ"
                            value="{{ $expense->name_kh??old('name_kh') }}"
                            maxlength="250" >
                        <div class="invalid-feedback">{{ $errors->first('name_kh') }}</div>
                    </div>                                         
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
