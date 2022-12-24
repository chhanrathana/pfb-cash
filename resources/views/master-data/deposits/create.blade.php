@extends('layouts.app')
@section('title','បញ្ចូល-ប្រាក់ដើម')

@section('content')
@include('includes.alert-info')
    <div class="card">
        <div class="card-header"><strong>បញ្ចូលប្រាក់ដើម</strong></div>
        <form action="{{ route('master-data.deposit.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">         
                    
                    <div class="form-group col-sm-4">
                        <label>សាខា <span class="text-danger">*</span></label>
                        <select class="form-control select2 {{ $errors->first('branch_id') ? 'is-invalid':'' }}" name="branch_id" id="branch_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' :  '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('branch_id') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ឈ្មោះជាភាសាខ្មែរ <span class="text-danger">*</span></label>
                        <input
                            class="form-control {{ $errors->first('name_kh') ? 'is-invalid':'' }}"
                            name="name_kh"
                            type="text"
                            placeholder="មាន ចិត្ត"
                            value="{{ old('name_kh') }}"
                            maxlength="50" >
                        <div class="invalid-feedback">{{ $errors->first('name_kh') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ឈ្មោះជាឡាតាំង <span class="text-danger">*</span></label>
                        <input
                            class="form-control {{ $errors->first('name_en') ? 'is-invalid':'' }}"
                            name="name_en"
                            type="text"
                            placeholder="MEAN CHET"
                            value="{{ old('name_en') }}"
                            maxlength="50">
                        <div class="invalid-feedback">{{ $errors->first('name_en') }}</div>
                    </div>  

                    <div class="form-group col-sm-4">
                        <label>ទឹកប្រាក់ <span class="text-danger">*</span></label>
                        <input
                            class="form-control number {{ $errors->first('deposit_amount') ? 'is-invalid':'' }}"
                            name="deposit_amount"
                            type="text"
                            placeholder="10000000"
                            value="{{ $deposit->deposit_amount??old('deposit_amount') }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('deposit_amount') }}</div>
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
