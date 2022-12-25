@extends('layouts.app')
@section('title','បង់ផ្តាច់កម្ចី')

@section('content')

    @include('includes.alert-info')

    @include('includes.read-client',['loan' => $loan])

    <form action="{{ route('payment.deduction.update',['id' => $loan->id]) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="card">
            <div class="card-header bg-custom"> <strong>បង់ប្រាក់ផ្តាច់</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label>មន្រ្តីឥណទាន</label>
                        <select disabled class="form-control select2 {{ $errors->first('staff_id') ? 'is-invalid':'' }}" name="staff_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            @foreach ($staffs as $staff)
                                <option value="{{ $staff->id }}" {{ $loan->staff_id == $staff->id ? 'selected' :  '' }}>{{ $staff->name_kh }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('staff_id') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ថ្ងៃត្រូវបង់ផ្តាច់</label>
                        <input
                            class="form-control {{ $errors->first('payment_date') ? 'is-invalid':'' }}"
                            name="payment_date"
                            type="text"
                            maxlength="10"
                            data-inputmask-alias="dd/mm/yyyy"
                            data-val="true"
                            disabled
                            placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                            value="{{ $loan->last_payment_date }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('payment_date') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ប្រាក់ដើមនៅសល់</label>
                        <input
                            class="form-control {{ $errors->first('pending_amount') ? 'is-invalid':'' }}"
                            name="pending_amount"
                            id="pending_amount"
                            type="text"
                            readonly
                            placeholder="10000000"
                            value="{{ number_format($loan->pending_amount) }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('pending_amount') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ប្រាក់សេវាត្រូវបង់ផ្តាច់</label>
                        <input
                            class="form-control {{ $errors->first('commission_amount') ? 'is-invalid':'' }}"
                            name="commission_amount"
                            id="commission_amount"
                            type="text"
                            readonly
                            placeholder="10000000"
                            value="{{ number_format($loan->payments->where('status','<>','paid')->sum('commission_amount')) }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('commission_amount') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ប្រាក់ការត្រូវបង់ផ្តាច់</label>
                        <input
                            class="form-control {{ $errors->first('interest_amount') ? 'is-invalid':'' }}"
                            name="interest_amount"
                            id="interest_amount"
                            type="text"
                            readonly
                            placeholder="10000000"
                            value="{{ number_format($loan->payments->where('status','<>','paid')->sum('interest_amount')) }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('interest_amount') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>បញ្ចុះតម្លៃប្រាក់ការ (%)</label>
                        <input
                            class="form-control number {{ $errors->first('finish_discount') ? 'is-invalid':'' }}"
                            name="finish_discount"
                            id="finish_discount"
                            type="text"
                            placeholder="20"
                            value="{{ $loan->finish_discount }}"
                            maxlength="4"
                            >
                        <div class="invalid-feedback">{{ $errors->first('finish_discount') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ត្រូវបង់សរុប</label>
                        <input type="hidden" name="orgin_total_amount" id="orgin_total_amount" value="{{ number_format($loan->payments->sum('total_amount') - $loan->payments->sum('total_paid_amount') ) }}">
                        <input
                            class="form-control {{ $errors->first('total_amount') ? 'is-invalid':'' }}"
                            name="total_amount"
                            id="total_amount"
                            type="text"
                            readonly
                            placeholder="10000000"
                            value="{{ number_format($loan->payments->sum('total_amount') - $loan->payments->sum('total_paid_amount') ) }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('total_amount') }}</div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <a class="btn btn-sm btn-warning float-left" href="{{ route('payment.deduction.index')}}">
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
    <script>
        $(document).ready(function () {

            $("#finish_discount").change(function() { 
                var hiddentotalAmount = Number($("#orgin_total_amount").val().split(",").join(""))  ;

                var interest = Number($("#interest_amount").val().split(",").join(""))  ;
                var commission = Number($("#commission_amount").val().split(",").join(""));
                var pending = Number($("#pending_amount").val().split(",").join(""));
                var dicounst =  Number($(this).val());
                var afterDiscount = (interest *(100 - dicounst)/100) + commission + pending;
                if (dicounst > 0) {
                    $("#total_amount").val(addCommas(afterDiscount));                    
                }                 
                else{
                    $("#total_amount").val(addCommas(hiddentotalAmount));
                }
            });             
        });

        function addCommas(nStr)
            {
                nStr += '';
                x = nStr.split('.');
                x1 = x[0];
                x2 = x.length > 1 ? '.' + x[1] : '';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
                }
                return x1 + x2;
            }
    </script>
@endsection
