@extends('layouts.app')
@section('title','បញ្ចូល-ប្រាក់ដើម')

@section('content')
@include('includes.alert-info')
            
        <form action="{{ route('master-data.deposit.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header bg-custom">
                    ព័ត៌មានផ្ទាល់ខ្លួន <span class="text-danger">*</span>
                </div>            
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
                            <label>ភេទ <span class="text-danger">*</span></label>
                            <select class="form-control select2  {{ $errors->first('sex') ? 'is-invalid':'' }}" name="sex"
                                    id="sex">
                                <option value="" selected disabled>[-- ជ្រើសរើស --]</option>
                                @foreach ($sexes as $sex)
                                    <option value="{{ $sex->id }}" {{ old('sex') == $sex->id ? 'selected' :  '' }}>{{ $sex->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('sex') }}</div>
                        </div>
                        
                        <div class="form-group col-sm-4">
                            <label>ថ្ងៃខែឆ្នាំកំណើត <span class="text-danger">*</span></label>
                            <input
                                    class="form-control {{ $errors->first('date_of_birth') ? 'is-invalid':'' }}"
                                    name="date_of_birth"
                                    type="text"
                                    maxlength="10"
                                    data-inputmask-alias="dd/mm/yyyy"
                                    data-val="true"
                                    data-val-required="Required"
                                    placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                                    value="{{ old('date_of_birth') }}"
                            >
                            <div class="invalid-feedback">{{ $errors->first('date_of_birth') }}</div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ទីកន្លែងកំណើត <span class="text-danger">*</span></label>
                            <input
                                    class="form-control {{ $errors->first('born_place') ? 'is-invalid':'' }}"
                                    name="born_place"
                                    type="text"
                                    placeholder="ភូមិ......,ឃុំ/សង្កាត់......,ស្រុក/ខណ្ឌ......,ខេត្ត/ក្រុង......"
                                    value="{{ old('born_place') }}"
                                    maxlength="250">
                            <div class="invalid-feedback">{{ $errors->first('born_place') }}</div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ឯកសារសម្គាល់ខ្លួន <span class="text-danger">*</span></label>
                            <select class="form-control select2 {{ $errors->first('document_type') ? 'is-invalid':'' }}"
                                    name="document_type" id="document_type">
                                <option value="" selected disabled>[-- ជ្រើសរើស --]</option>
                                @foreach ($documents as $document)
                                    <option value="{{ $document->id }}" {{ old('document_type') == $document->id ? 'selected' :  '' }}>{{ $document->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">{{ $errors->first('document_type') }}</div>
                        </div>
                    
                        <div class="form-group col-sm-4">
                            <label for="document_number" id="document_number_title">លេខសំគាល់ឯកសារ <span class="text-danger">*</span></label>
                            <input
                                    class="form-control {{ $errors->first('document_number') ? 'is-invalid':'' }}"
                                    name="document_number"
                                    id="input_document_number"
                                    type="text"
                                    disabled
                                    placeholder="សូមជ្រើសរើសប្រភេទឯកសារសម្គាល់ខ្លួនមុនសិន"
                                    value="{{ old('document_number') }}"
                                    maxlength="50"
                            >
                            <div class="invalid-feedback">{{ $errors->first('document_number') }}</div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-custom">ទំនាក់ទំនង <span class="text-danger">*</span></div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="phone_number">លេខផ្ទាល់ខ្លួន <span class="text-danger">*</span></label>
                            <input
                                    class="form-control {{ $errors->first('phone_number') ? 'is-invalid':'' }}"
                                    name="phone_number"
                                    type="text"
                                    placeholder="0967623XX"
                                    value="{{ old('phone_number') }}"
                                    maxlength="50"
                            >
                            <div class="invalid-feedback">{{ $errors->first('phone_number') }}</div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="emergency_number">លេខទាក់ទងបន្ទាន់ <span class="text-danger">*</span></label>
                            <input
                                    class="form-control {{ $errors->first('emergency_number') ? 'is-invalid':'' }}"
                                    name="emergency_number"
                                    type="text"
                                    id="emergency_number"
                                    placeholder="0967623XX"
                                    value="{{ old('emergency_number') }}"
                                    maxlength="50"
                            >
                            <div class="invalid-feedback">{{ $errors->first('emergency_number') }}</div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>ទីលំនៅបច្ចុប្បន្ន <span class="text-danger">*</span></label>
                            <input
                                    class="form-control {{ $errors->first('current_place') ? 'is-invalid':'' }}"
                                    name="current_place"
                                    type="text"
                                    placeholder="ផ្ទះលេខ......,ផ្លូវ......,ភូមិ......,ឃុំ/សង្កាត់......,ស្រុក/ខណ្ឌ......,ខេត្ត/ក្រុង......"
                                    value="{{ old('current_place') }}"
                                    maxlength="250">
                            <div class="invalid-feedback">{{ $errors->first('current_place') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-custom">
                    ព័ត៌មានការងារ <span class="text-danger">*</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label>ថ្ងៃខែឆ្នាំចូលបម្រើការងារ <span class="text-danger">*</span></label>
                            <input
                                    class="form-control {{ $errors->first('start_work_date') ? 'is-invalid':'' }}"
                                    name="start_work_date"
                                    type="text"
                                    maxlength="10"
                                    data-inputmask-alias="dd/mm/yyyy"
                                    data-val="true"
                                    data-val-required="Required"
                                    placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                                    value="{{ old('start_work_date') }}"
                            >
                            <div class="invalid-feedback">{{ $errors->first('start_work_date') }}</div>
                        </div>
    
                        <div class="form-group col-sm-4">
                            <label>ទឹកប្រាក់ចូលហ៊ុន <span class="text-danger">*</span></label>
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
            </div>          
        </form>

@endsection
@section('script')
    @include('includes.alert-info-script')
    <script>
        $('#document_type').on('change',function(e) {
            let text = $("#document_type option:selected").text();
            // change title
            $('#document_number_title').html(`លេខ${text} <span class="text-danger">*</span>`);
            // enable input
            $('#input_document_number').prop("disabled",false);
            $('#input_document_number').prop("placeholder",`បញ្ចូលលេខ${text}`);
        })
    </script>
@endsection
