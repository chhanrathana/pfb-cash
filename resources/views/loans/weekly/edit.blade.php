@extends('layouts.app')
@section('title', 'កែប្រែ-ប្រាក់កម្ចី')

@section('content')
    @include('includes.alert-info')

    <form action="{{ route('loan.weekly.update',['id' => $loan->id ]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('includes.create-client')
        <input type="hidden" name="loan_id" value="{{ $loan->id }}">
        <div class="card">
            <div class="card-header"> <strong>ព័ត៌មានប្រាក់កម្ចីសប្តាហ៍</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label>មន្រ្តីឥណទាន <span class="text-danger">*</span></label>
                        <select class="form-control select2 {{ $errors->first('staff_id') ? 'is-invalid':'' }}" name="staff_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            @foreach ($staffs as $staff)
                                @if (old('staff_id'))
                                    <option value="{{ $staff->id }}" {{ old('staff_id') == $staff->id ? 'selected' :  '' }}>{{ $staff->name_kh }}</option>
                                @else
                                    <option value="{{ $staff->id }}" {{ $loan->staff_id == $staff->id ? 'selected' :  '' }}>{{ $staff->name_kh }}</option>
                                @endif

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
                            value="{{ old('principal_amount')??$loan->principal_amount }}"
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
                            value="{{ old('admin_rate')??$loan->admin_rate }}"
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
                            value="{{ $loan->rate }}"
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
                            value="{{ $loan->commission_rate }}"
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
                            value="{{ old('registration_date')??$loan->registration_date }}"
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
                            value="{{ old('started_payment_date')??$loan->started_payment_date }}"
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
                            value="{{ old('term')??$loan->term }}"
                            maxlength="2">
                        <div class="invalid-feedback">{{ $errors->first('term') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>សាខា <span class="text-danger">*</span></label>
                        <select class="form-control select2 {{ $errors->first('branch_id') ? 'is-invalid':'' }}" name="branch_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            @foreach ($branches as $branch)
                                @if (old('branch_id'))
                                    <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' :  '' }}>{{ $branch->name }}</option>
                                @else
                                    <option value="{{ $branch->id }}" {{ $loan->branch_id == $branch->id ? 'selected' :  '' }}>{{ $branch->name }}</option>
                                @endif

                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('branch_id') }}</div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <a class="btn btn-sm btn-warning float-left" href="{{ route('loan.list.index') }}">
                            <span class="material-icons-outlined">arrow_back</span>
                        </a>
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
