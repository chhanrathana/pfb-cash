@extends('layouts.app')
@section('title','កែប្រែ-ថ្ងៃបង់ការប្រាក់​')

@section('content')

    @include('includes.alert-info')

    @include('includes.read-client')

    <form action="{{ route('loan.list.update',['id' => $payment->id]) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header bg-custom"> <strong>កែប្រែ-ថ្ងៃបង់ការប្រាក់​</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label>ចំនួនប្រាក់កម្ចី</label>
                        <input
                            class="form-control {{ $errors->first('principal_amount') ? 'is-invalid':'' }}"
                            name="principal_amount"
                            type="text"
                            readonly
                            placeholder="10000000"
                            value="{{ number_format(($payment->loan->principal_amount??0)) }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('principal_amount') }}</div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>ប្រាក់ការ​ (%)</label>
                        <input
                            class="form-control number {{ $errors->first('rate') ? 'is-invalid':'' }}"
                            name="rate"
                            type="text"
                            readonly
                            placeholder="0.7"
                            value="{{ $payment->loan->rate }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('rate') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ថ្ងៃបង់ការ</label>
                        <input
                            class="form-control {{ $errors->first('payment_date') ? 'is-invalid':'' }}"
                            name="payment_date"
                            type="text"
                            maxlength="10"
                            data-inputmask-alias="dd/mm/yyyy"
                            data-val="true"
                            placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                            value="{{ $payment->payment_date }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('payment_date') }}</div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                            <a class="btn btn-sm btn-warning float-left" href="{{ route('loan.list.show',['id' => $payment->loan_id ])}}">
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
