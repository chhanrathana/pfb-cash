@extends('layouts.app')
@section('title','កែប្រែ-ចំណាយ')
    
@section('content')
@include('includes.alert-info')
    <div class="card">
        <div class="card-header"><strong>កែប្រែ-ចំណាយ</strong></div>

        <form action="{{ route('expense.item.update',['id' => $expense->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">

                    <div class="form-group col-sm-4">
                        <label>សាខា</label>
                        <select class="form-control select2 {{ $errors->first('branch_id') ? 'is-invalid':'' }}" name="branch_id" id="branch_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" {{ (old('branch_id')??$expense->branch_id) == $branch->id ? 'selected' :  '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('branch_id') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ប្រភេទចំណាយ <span class="text-danger">*</span></label>
                        <select class="form-control select2 {{ $errors->first('expense_type_id') ? 'is-invalid':'' }}" name="expense_type_id">
                            <option value="" selected>[-- ជ្រើសរើស --]</option>
                            @foreach ($types as $type)
                                @if (old('expense_type_id'))
                                    <option value="{{ $type->id }}" {{ old('expense_type_id') == $type->id ? 'selected' :  '' }}>{{ $type->name_kh }}</option>
                                @else
                                    <option value="{{ $type->id }}" {{ $expense->expense_type_id == $type->id ? 'selected' :  '' }}>{{ $type->name_kh }}</option>
                                @endif

                            @endforeach
                        </select>
                        <div class="invalid-feedback">{{ $errors->first('expense_type_id') }}</div>
                    </div>


                    <div class="form-group col-sm-4">
                        <label>ទឹកប្រាក់ចំណាយ <span class="text-danger">*</span></label>
                        <input
                            class="form-control number {{ $errors->first('expense_amount') ? 'is-invalid':'' }}"
                            name="expense_amount"
                            type="text"
                            placeholder="10000000"
                            value="{{ $expense->expense_amount??old('expense_amount') }}"
                            >
                        <div class="invalid-feedback">{{ $errors->first('expense_amount') }}</div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label>ពណ៍នាចំណាយ</label>
                        <input
                            class="form-control {{ $errors->first('description') ? 'is-invalid':'' }}"
                            name="description"
                            type="text"
                            placeholder="ទិញសម្ភារ"
                            value="{{ $expense->description??old('description') }}"
                            maxlength="250" >
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
