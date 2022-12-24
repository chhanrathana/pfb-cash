@extends('layouts.app')
@section('title','បញ្ចូល-កម្ចីកន្លះខែ')
@section('content')
    @include('includes.alert-info')

    @include('includes.search-client', ['url' => route('loan.half-monthly.create')])
    
    <form action="{{ route('loan.half-monthly.store') }}" method="POST">
        @csrf
        @include('includes.create-client')

        <div class="card">
            <div class="card-header"> <strong>ព័ត៌មានប្រាក់កម្ចីកន្លះខែ</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label>មន្រ្តីឥណទាន <span class="text-danger">*</span></label>
                        <select class="form-control select2 {{ $errors->first('staff_id') ? 'is-invalid':'' }}" name="staff_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            @foreach ($staffs as $staff)
                                <option value="{{ $staff->id }}" {{ old('staff_id') == $staff->id ? 'selected' :  '' }}>{{ $staff->name_kh }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('staff_id') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ចំនួនប្រាក់កម្ចី <span class="text-danger">*</span></label>
                        <input
                            class="form-control number {{ $errors->first('principal_amount') ? 'is-invalid':'' }}"
                            name="principal_amount"
                            type="text"
                            placeholder="10000000"
                            value="{{ $loan->principal_amount??old('principal_amount') }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('principal_amount') }}</div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>សេវារដ្ឋបាល(%) <span class="text-danger">*</span></label>
                        <input
                            class="form-control number {{ $errors->first('admin_rate') ? 'is-invalid':'' }}"
                            name="admin_rate"
                            type="text"
                            placeholder="2.3"
                            required
                            value="{{ $loan->admin_rate??old('admin_rate') }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('admin_rate') }}</div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>ប្រាក់ការ​ (%) <span class="text-danger">*</span></label>
                        <input
                            class="form-control number {{ $errors->first('rate') ? 'is-invalid':'' }}"
                            name="rate"
                            type="text"
                            placeholder="0.7"
                            value="{{ $loan->rate??$interest->rate }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('rate') }}</div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>សេវាប្រតិបត្តិការ(%) <span class="text-danger">*</span></label>
                        <input
                            class="form-control number {{ $errors->first('commission_rate') ? 'is-invalid':'' }}"
                            name="commission_rate"
                            type="text"
                            placeholder="2.3"
                            value="{{ $loan->commission_rate??$interest->commission_rate }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('commission_rate') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ថ្ងៃខ្ចី <span class="text-danger">*</span></label>
                        <input
                            class="form-control {{ $errors->first('registration_date') ? 'is-invalid':'' }}"
                            name="registration_date"
                            type="text"
                            maxlength="10"
                            data-inputmask-alias="dd/mm/yyyy"
                            data-val="true"
                            placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                            value="{{ old('registration_date') }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('registration_date') }}</div>
                    </div>

                     <div class="form-group col-sm-4">
                        <label>ថ្ងៃបង់ការដំបូង <span class="text-danger">*</span></label>
                        <input
                            class="form-control {{ $errors->first('started_payment_date') ? 'is-invalid':'' }}"
                            name="started_payment_date"
                            type="text"
                            maxlength="10"
                            data-inputmask-alias="dd/mm/yyyy"
                            data-val="true"
                            placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                            value="{{ old('started_payment_date') }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('started_payment_date') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>រយះពេល(ដង) <span class="text-danger">*</span></label>
                        <input
                            class="form-control term {{ $errors->first('term') ? 'is-invalid':'' }}"
                            name="term"
                            type="text"
                            placeholder="12"
                            value="{{ $loan->term??old('term') }}"
                            maxlength="2">
                        <div class="invalid-feedback">{{ $errors->first('term') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>សាខា <span class="text-danger">*</span></label>
                        <select class="form-control select2 {{ $errors->first('branch_id') ? 'is-invalid':'' }}" name="branch_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            @foreach ($branches as $branch)                                
                                <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' :  '' }}>{{ $branch->name }}</option>                                
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('branch_id') }}</div>
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
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('/js/geolocation.js') }}"></script>
@endsection
