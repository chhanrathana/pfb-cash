@extends('layouts.app')
@section('title','បង់ប្រាក់')

@section('content')

    @include('includes.alert-info')
    <div class="alert alert-{{ $payment-> status }} alert-dismissible fade show" role="alert">
        ស្ថានភាព ៖ <strong>{{ $payment->_status->name }}</strong>
    </div>
    @include('includes.read-client',['payment' => $payment])

    <form action="{{ route('payment.interest.update',['id' => $payment->id]) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header bg-custom"> <strong>បង់ការប្រាក់</strong></div>
            <div class="card-body">
                <div class="row">
                     <div class="form-group col-sm-4">
                        <label>មន្រ្តីឥណទាន</label>
                        <select disabled class="form-control select2 {{ $errors->first('staff_id') ? 'is-invalid':'' }}" name="staff_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            @foreach ($staffs as $staff)
                                <option value="{{ $staff->id }}" {{ $payment->loan->staff_id == $staff->id ? 'selected' :  '' }}>{{ $staff->name_kh }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('staff_id') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ចំនួនប្រាក់ត្រូវបង់</label>
                        <input
                            class="form-control {{ $errors->first('principal_amount') ? 'is-invalid':'' }}"
                            name="principal_amount"
                            type="text"
                            readonly
                            placeholder="10000000"
                            value="{{ number_format($payment->total_amount) }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('principal_amount') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ថ្ងៃត្រូវបង់ការ</label>
                        <input
                            class="form-control {{ $errors->first('payment_date') ? 'is-invalid':'' }}"
                            name="payment_date"
                            type="text"
                            maxlength="10"
                            data-inputmask-alias="dd/mm/yyyy"
                            data-val="true"
                            disabled
                            placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                            value="{{ $payment->payment_date }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('payment_date') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ចំនួនប្រាក់បានបង់</label>
                        <input
                            class="form-control {{ $errors->first('total_paid_amount') ? 'is-invalid':'' }}"
                            name="total_paid_amount"
                            type="text"
                            placeholder="10000000"
                            disabled
                            value="{{ number_format($payment->total_paid_amount) }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('total_paid_amount') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ការបង់ប្រាក់</label>
                        <select class="form-control select2 {{ $errors->first('status') ? 'is-invalid':'' }}" name="status">
                            <option value="" selected disabled>[-- ជ្រើសរើស --]</option>
                            @foreach ($status as $st)
                                <option value="{{ $st->id }}" {{ $payment->status == $st->id?'selected':'' }}>{{ $st->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                    </div>
                   
                    <div class="form-group col-sm-4">
                        <label>ចំនួនប្រាក់ត្រូវបង់</label>
                        <input
                            class="form-control number {{ $errors->first('transaction_amount') ? 'is-invalid':'' }}"
                            name="transaction_amount"
                            type="text"
                            placeholder="10000000"
                            value="{{ $payment->total_amount - $payment->total_paid_amount }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('transaction_amount') }}</div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                            <a class="btn btn-sm btn-warning float-left" href="{{ route('payment.interest.index')}}">
                                <span class="material-icons-outlined">chevron_left</span>
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
