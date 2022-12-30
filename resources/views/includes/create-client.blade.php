<div class="card">
    <div class="card-header bg-custom"><strong>ជ្រើសរើសប្រភេទកម្ចី <span class="text-danger">*</span></strong></div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-sm-12 d-inline">
                @foreach($loanTypes as $type)
                    <div class="form-check mt-3">
                        @if($loan)
                            <input onclick="location.href=`/loan/daily/create?type={{$type->id}}`" class="form-check-input" type="radio" name="loan_type" id="{{ $type -> id }}"
                                   value="{{ $type -> id }}" {{ $loan -> loan_type_id == $type -> id ? 'checked' : '' }}>
                        @else
                            <input onclick="location.href=`/loan/daily/create?type={{$type->id}}`" class="form-check-input" type="radio" name="loan_type" id="{{ $type -> id }}"
                                   value="{{ $type -> id }}" {{ request('type') == $type -> id ? 'checked' : '' }}>
                        @endif
                        <label class="form-check-label cursor-pointer {{ request('type') == $type -> id ? 'text-primary' : '' }}"
                               for="{{ $type -> id }}">
                            {{ $type -> name_kh }} / {{ $type -> name_en }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
{{--loaner--}}
<div class="card">
    <div class="card-header bg-custom"><strong>ព័ត៌មានអ្នកខ្ចីប្រាក់ {{ request('type') == 'group' ? '(មេក្រុម)' : '' }}
            <span class="text-danger">*</span></strong></div>
    <div class="card-body">
        <div class="row">
            <input type="hidden" value="{{ $client->id??'' }}" name="client_id">
            <div class="form-group col-sm-4">
                <label>ឈ្មោះជាភាសាខ្មែរ <span class="text-danger">*</span></label>
                <input
                        class="form-control {{ $errors->first('loaner_name_kh') ? 'is-invalid':'' }}"
                        name="loaner_name_kh"
                        type="text"
                        placeholder="យិនប៊ុនណា"
                        value="{{ $client->name_kh??old('loaner_name_kh') }}"
                        maxlength="50">
                <div class="invalid-feedback">{{ $errors->first('loaner_name_kh') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label>ឈ្មោះជាឡាតាំង <span class="text-danger">*</span></label>
                <input
                        class="form-control {{ $errors->first('loaner_name_en') ? 'is-invalid':'' }}"
                        name="loaner_name_en"
                        type="text"
                        placeholder="YIN BUNNA"
                        value="{{ $client->name_en??old('loaner_name_en') }}"
                        maxlength="50">
                <div class="invalid-feedback">{{ $errors->first('loaner_name_en') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label>ភេទ <span class="text-danger">*</span></label>
                <select class="form-control select2  {{ $errors->first('loaner_sex') ? 'is-invalid':'' }}"
                        name="loaner_sex" id="sex">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    @foreach ($sexes as $sex)
                        @if ($client)
                            <option value="{{ $sex->id }}" {{ $client->sex == $sex->id ? 'selected' :  '' }} >{{ $sex->name }}</option>
                        @else
                            <option value="{{ $sex->id }}" {{  old('sex') == $sex->id ? 'selected' :  '' }} >{{ $sex->name }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('loaner_sex') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>ថ្ងៃខែឆ្នាំកំណើត <span class="text-danger">*</span></label>
                <input
                        class="form-control {{ $errors->first('loaner_date_of_birth') ? 'is-invalid':'' }}"
                        name="loaner_date_of_birth"
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                        value="{{ $client->date_of_birth??old('loaner_date_of_birth') }}"
                >
                <div class="invalid-feedback">{{ $errors->first('loaner_date_of_birth') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label for="phone_number">លេខទំនាក់ទំនង <span class="text-danger">*</span></label>
                <input
                        class="form-control {{ $errors->first('loaner_phone_number') ? 'is-invalid':'' }}"
                        name="loaner_phone_number"
                        type="text"
                        placeholder="0817623XX"
                        value="{{ $client->phone_number??old('loaner_phone_number') }}"
                        maxlength="50"
                >
                <div class="invalid-feedback">{{ $errors->first('loaner_phone_number') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label>ឯកសារសម្គាល់ខ្លួន <span class="text-danger">*</span></label>
                <select class="form-control select2 {{ $errors->first('loaner_document_type') ? 'is-invalid':'' }}"
                        name="loaner_document_type" id="document_type_1">
                    <option value="" selected disabled>[-- ជ្រើសរើស --]</option>
                    @foreach ($documents as $document)
                        @if($client)
                            <option value="{{ $document->id }}" {{ $client -> document_type_id == $document->id ? 'selected' :  '' }}>{{ $document->name }}</option>
                        @else
                            <option value="{{ $document->id }}" {{ old('loaner_document_type') == $document->id ? 'selected' :  '' }}>{{ $document->name }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('loaner_document_type') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label for="input_document_number_1" id="document_number_title_1">លេខសំគាល់ឯកសារ <span
                            class="text-danger">*</span></label>
                <input
                        class="form-control {{ $errors->first('loaner_document_number') ? 'is-invalid':'' }}"
                        name="loaner_document_number"
                        id="input_document_number_1"
                        type="text"
                        placeholder="សូមជ្រើសរើសប្រភេទឯកសារសម្គាល់ខ្លួនមុនសិន"
                        value="{{ $client -> document_number ?? old('loaner_document_number') }}"
                        maxlength="50"
                >
                <div class="invalid-feedback">{{ $errors->first('loaner_document_number') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label>ខេត្ត <span class="text-danger">*</span></label>
                <select class="form-control select2 {{ $errors->first('loaner_province_id') ? 'is-invalid':'' }}"
                        name="loaner_province_id" id="province_id">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    @foreach ($provinces as $province)
                        @if ($client)
                            <option value="{{ $province->id }}" {{ $client->village->commune->district->province->id == $province->id ? 'selected' :  '' }}>{{ $province->name_kh }}</option>
                        @else
                            <option value="{{ $province->id }}" {{ old('loaner_province_id') == $province->id ? 'selected' :  '' }}>{{ $province->name_kh }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('loaner_province_id') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>ស្រុក <span class="text-danger">*</span></label>
                <select class="form-control select2 {{ $errors->first('district_id') ? 'is-invalid':'' }}"
                        name="loaner_district_id" id="district_id">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    @if ($client)
                        @foreach ($districts as $district)
                            <option value="{{ $district->id }}" {{ $client->village->commune->district->id == $district->id ? 'selected' :  '' }}>{{ $district->name_kh }}</option>
                        @endforeach
                    @endif
                </select>
                <div class="invalid-feedback">{{ $errors->first('district_id') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label>ឃុំ <span class="text-danger">*</span></label>
                <select class="form-control select2 {{ $errors->first('commune_id') ? 'is-invalid':'' }}"
                        name="loaner_commune_id" id="commune_id">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    @if ($client)
                        @foreach ($communes as $commune)
                            <option value="{{ $commune->id }}" {{ $client->village->commune->id == $commune->id ? 'selected' :  '' }}>{{ $commune->name_kh }}</option>
                        @endforeach
                    @endif

                </select>
                <div class="invalid-feedback">{{ $errors->first('commune_id') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label>ភូមិ <span class="text-danger">*</span></label>
                <select class="form-control select2 {{ $errors->first('village_id') ? 'is-invalid':'' }}"
                        name="loaner_village_id" id="village_id">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    @if ($client)
                        @foreach ($villages as $village)
                            <option value="{{ $village->id }}" {{ $client->village->id == $village->id ? 'selected' :  '' }}>{{ $village->name_kh }}</option>
                        @endforeach
                    @endif

                </select>
                <div class="invalid-feedback">{{ $errors->first('village_id') }}</div>
            </div>
        </div>
    </div>
</div>
@if(request('type') == 'group' || ($loan && $loan -> loan_type_id == 'group'))
    {{-- loan member --}}
    <div class="card">
        <div class="card-header bg-custom"><strong>ព័ត៌មានសមាជិកខ្ចីប្រាក់ <span class="text-danger">*</span></strong>
        </div>
        <div class="card-body">
            @if($loan && ($loan -> members) )
                @foreach( $loan -> members as $key => $member)
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>សមាជិកទី {{$key + 1}} -ឈ្មោះជាភាសាខ្មែរ @if($key==0)
                                    <span class="text-danger">*</span>
                                @endif</label>
                            <input
                                    class="form-control {{ $errors->first('member_name_kh') ? 'is-invalid':'' }}"
                                    name="member_name_kh[]"
                                    type="text"
                                    placeholder=""
                                    value="{{ $member->name_kh??old('member_name_kh') }}"
                                    maxlength="50">
                            <div class="invalid-feedback">{{ $errors->first('member_name_kh') }}</div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>សមាជិកទី {{$key + 1}} -ឈ្មោះជាឡាតាំង @if($key==0)
                                    <span class="text-danger">*</span>
                                @endif</label>
                            <input
                                    class="form-control {{ $errors->first('member_name_en') ? 'is-invalid':'' }}"
                                    name="member_name_en[]"
                                    type="text"
                                    placeholder=""
                                    value="{{ $member->name_en??old('member_name_en') }}"
                                    maxlength="50">
                            <div class="invalid-feedback">{{ $errors->first('member_name_en') }}</div>
                        </div>
                    </div>
                @endforeach
            @else
                @for($i=1; $i<5; $i++)
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>សមាជិកទី {{$i}} -ឈ្មោះជាភាសាខ្មែរ @if($i==1)
                                    <span class="text-danger">*</span>
                                @endif</label>
                            <input
                                    class="form-control {{ $errors->first('member_name_kh') ? 'is-invalid':'' }}"
                                    name="member_name_kh[]"
                                    type="text"
                                    placeholder=""
                                    value="{{ $client->name_kh??old('member_name_kh') }}"
                                    maxlength="50">
                            <div class="invalid-feedback">{{ $errors->first('member_name_kh') }}</div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>សមាជិកទី {{$i}} -ឈ្មោះជាឡាតាំង @if($i==1)
                                    <span class="text-danger">*</span>
                                @endif</label>
                            <input
                                    class="form-control {{ $errors->first('member_name_en') ? 'is-invalid':'' }}"
                                    name="member_name_en[]"
                                    type="text"
                                    placeholder=""
                                    value="{{ $client->name_kh??old('member_name_en') }}"
                                    maxlength="50">
                            <div class="invalid-feedback">{{ $errors->first('member_name_en') }}</div>
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    </div>
@endif
{{--first guarantor--}}
<div class="card">
    <div class="card-header bg-custom"><strong>ព័ត៌មានអ្នកធានា</strong></div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-sm-4">
                <label>ឈ្មោះអ្នកធានាទី១</label>
                <input
                        class="form-control {{ $errors->first('first_guarantor_name') ? 'is-invalid':'' }}"
                        name="first_guarantor_name"
                        type="text"
                        placeholder="យិនប៊ុនណា"
                        value="{{ $first_guarantor->full_name??old('first_guarantor_name') }}"
                        maxlength="50">
                <div class="invalid-feedback">{{ $errors->first('first_guarantor_name') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label>ភេទ</label>
                <select class="form-control select2  {{ $errors->first('first_guarantor_sex') ? 'is-invalid':'' }}"
                        name="first_guarantor_sex" id="sex">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    @foreach ($sexes as $sex)
                        @if ($first_guarantor)
                            <option value="{{ $sex->id }}" {{ $first_guarantor->sex == $sex->id ? 'selected' :  '' }} >{{ $sex->name }}</option>
                        @else
                            <option value="{{ $sex->id }}" {{  old('first_guarantor_sex') == $sex->id ? 'selected' :  '' }} >{{ $sex->name }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('first_guarantor_sex') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>ថ្ងៃខែឆ្នាំកំណើត</label>
                <input
                        class="form-control {{ $errors->first('first_guarantor_date_of_birth') ? 'is-invalid':'' }}"
                        name="first_guarantor_date_of_birth"
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                        value="{{ $first_guarantor->date_of_birth??old('first_guarantor_date_of_birth') }}"
                >
                <div class="invalid-feedback">{{ $errors->first('first_guarantor_date_of_birth') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label for="phone_number">លេខទំនាក់ទំនង</label>
                <input
                        class="form-control {{ $errors->first('first_guarantor_date_of_phone_number') ? 'is-invalid':'' }}"
                        name="first_guarantor_date_of_phone_number"
                        type="text"
                        placeholder="0817623XX"
                        value="{{ $first_guarantor->phone_number??old('first_guarantor_date_of_phone_number') }}"
                        maxlength="50"
                >
                <div class="invalid-feedback">{{ $errors->first('first_guarantor_date_of_phone_number') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label>ឯកសារសម្គាល់ខ្លួន</label>
                <select class="form-control select2 {{ $errors->first('first_guarantor_document_type') ? 'is-invalid':'' }}"
                        name="first_guarantor_document_type" id="document_type_2">
                    <option value="" selected disabled>[-- ជ្រើសរើស --]</option>
                    @foreach ($documents as $document)
                        @if($first_guarantor)
                            <option value="{{ $document->id }}" {{ $first_guarantor -> document_type == $document->id ? 'selected' :  '' }}>{{ $document->name }}</option>
                        @else
                            <option value="{{ $document->id }}" {{ old('first_guarantor_document_type') == $document->id ? 'selected' :  '' }}>{{ $document->name }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('first_guarantor_document_type') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label for="document_number" id="document_number_title_2">លេខសំគាល់ឯកសារ </label>
                <input
                        class="form-control {{ $errors->first('first_guarantor_document_number') ? 'is-invalid':'' }}"
                        name="first_guarantor_document_number"
                        id="input_document_number_2"
                        type="text"
                        placeholder="សូមជ្រើសរើសប្រភេទឯកសារសម្គាល់ខ្លួនមុនសិន"
                        value="{{ $first_guarantor -> document_number ?? old('first_guarantor_document_number') }}"
                        maxlength="50"
                >
                <div class="invalid-feedback">{{ $errors->first('first_guarantor_document_number') }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            {{-- second gurantor--}}
            <div class="form-group col-sm-4">
                <label>ឈ្មោះអ្នកធានាទី២</label>
                <input
                        class="form-control {{ $errors->first('second_guarantor_name') ? 'is-invalid':'' }}"
                        name="second_guarantor_name"
                        type="text"
                        placeholder="យិនប៊ុនណា"
                        value="{{ $second_guarantor->full_name??old('second_guarantor_name') }}"
                        maxlength="50">
                <div class="invalid-feedback">{{ $errors->first('second_guarantor_name') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label>ភេទ</label>
                <select class="form-control select2  {{ $errors->first('second_guarantor_sex') ? 'is-invalid':'' }}"
                        name="second_guarantor_sex" id="sex">
                    <option value="" selected>[-- ជ្រើសរើស --]</option>
                    @foreach ($sexes as $sex)
                        @if ($second_guarantor)
                            <option value="{{ $sex->id }}" {{ $second_guarantor->sex == $sex->id ? 'selected' :  '' }} >{{ $sex->name }}</option>
                        @else
                            <option value="{{ $sex->id }}" {{  old('second_guarantor_sex') == $sex->id ? 'selected' :  '' }} >{{ $sex->name }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('second_guarantor_sex') }}</div>
            </div>

            <div class="form-group col-sm-4">
                <label>ថ្ងៃខែឆ្នាំកំណើត</label>
                <input
                        class="form-control {{ $errors->first('second_guarantor_date_of_birth') ? 'is-invalid':'' }}"
                        name="second_guarantor_date_of_birth"
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        placeholder="ថ្ងៃ/ខែ/ឆ្នាំ"
                        value="{{ $second_guarantor->date_of_birth??old('second_guarantor_date_of_birth') }}"
                >
                <div class="invalid-feedback">{{ $errors->first('second_guarantor_date_of_birth') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label for="phone_number">លេខទំនាក់ទំនង</label>
                <input
                        class="form-control {{ $errors->first('second_guarantor_phone_number') ? 'is-invalid':'' }}"
                        name="second_guarantor_phone_number"
                        type="text"
                        placeholder="0817623XX"
                        value="{{ $second_guarantor->phone_number??old('second_guarantor_phone_number') }}"
                        maxlength="50"
                >
                <div class="invalid-feedback">{{ $errors->first('second_guarantor_phone_number') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label>ឯកសារសម្គាល់ខ្លួន</label>
                <select class="form-control select2 {{ $errors->first('second_guarantor_document_type') ? 'is-invalid':'' }}"
                        name="second_guarantor_document_type" id="document_type_2">
                    <option value="" selected disabled>[-- ជ្រើសរើស --]</option>
                    @foreach ($documents as $document)
                        @if($second_guarantor)
                            <option value="{{ $document->id }}" {{ $second_guarantor -> document_type == $document->id ? 'selected' :  '' }}>{{ $document->name }}</option>
                        @else
                            <option value="{{ $document->id }}" {{ old('second_guarantor_document_type') == $document->id ? 'selected' :  '' }}>{{ $document->name }}</option>
                        @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">{{ $errors->first('second_guarantor_document_type') }}</div>
            </div>
            <div class="form-group col-sm-4">
                <label for="document_number" id="document_number_title_2">លេខសំគាល់ឯកសារ </label>
                <input
                        class="form-control {{ $errors->first('second_guarantor_document_number') ? 'is-invalid':'' }}"
                        name="second_guarantor_document_number"
                        id="input_document_number_2"
                        type="text"
                        placeholder="សូមជ្រើសរើសប្រភេទឯកសារសម្គាល់ខ្លួនមុនសិន"
                        value="{{ $second_guarantor -> document_number ?? old('second_guarantor_document_number') }}"
                        maxlength="50"
                >
                <div class="invalid-feedback">{{ $errors->first('second_guarantor_document_number') }}</div>
            </div>
        </div>
    </div>
</div>
@section('script')
    @include('includes.alert-info-script')
    <script>
        $('#document_type_1').on('change', function (e) {
            let text = $("#document_type_1 option:selected").text();
            // change title
            $('#document_number_title_1').html(`លេខ${text} <span class="text-danger">*</span>`);
            // enable input
            $('#input_document_number_1').prop("disabled", false);
            $('#input_document_number_1').prop("placeholder", `បញ្ចូលលេខ${text}`);
        });
        $('#document_type_2').on('change', function (e) {
            let text = $("#document_type_2 option:selected").text();
            // change title
            $('#document_number_title_2').html(`លេខ${text} <span class="text-danger">*</span>`);
            // enable input
            $('#input_document_number_2').prop("disabled", false);
            $('#input_document_number_2').prop("placeholder", `បញ្ចូលលេខ${text}`);
        })
    </script>
@endsection
