@extends('layouts.app')
@section('title')
    បង្កើតប្រតិទិនឈប់សម្រាក់
@stop
@section('content')
@include('includes.alert-info')
    <div class="card">
        <div class="card-header">
            <strong>បង្កើតប្រតិទិនឈប់សម្រាក់</strong>
        </div>
        <form action="{{ route('master-data.calendar.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">                   
                    <div class="form-group col-sm-3">
                        <label>ថ្ងៃ</label>
                        <input
                            class="form-control {{ $errors->first('date') ? 'is-invalid':'' }}"
                            name="date"
                            type="text"
                            autocomplete="false"
                            placeholder="07/01/2023"                            
                            maxlength="10"
                            data-inputmask-alias="dd/mm/yyyy"
                            data-val="true"
                            value="{{ old('date') }}"
                            maxlength="50" >
                        <div class="invalid-feedback">{{ $errors->first('date') }}</div>
                    </div>
                    <div class="form-group col-sm-5">
                        <label>ពិពណ៍នា</label>
                        <input
                            class="form-control {{ $errors->first('description') ? 'is-invalid':'' }}"
                            name="description"
                            type="text"
                            autocomplete="false"
                            placeholder="បុណ្យ...."
                            maxlength="500"
                            value="{{ old('description') }}"
                            maxlength="50" >
                        <div class="invalid-feedback">{{ $errors->first('description') }}</div>
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
