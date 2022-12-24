<div class="card">
    <div class="card-header"><strong>ព័ត៌មានអ្នកខ្ចីប្រាក់</strong></div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">កូដអតិថិជន</label>
                <label class="col-sm-8 col-form-label font-weight-bold">{{ $client->code }}</label>
            </div>
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ឈ្មោះជាភាសាខ្មែរ</label>
                <label class="col-sm-8 col-form-label font-weight-bold">{{ $client->name_kh }}</label>
            </div>
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ឈ្មោះជាឡាតាំង</label>
                <label class="col-sm-8 col-form-label font-weight-bold">{{ $client->name_en }}</label>
            </div>

            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ភេទ</label>
                <label class="col-sm-8 col-form-label font-weight-bold">{{ $client->_sex->name }}</label>
            </div>

            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ថ្ងៃខែឆ្នាំកំណើត</label>
                <label class="col-sm-8 col-form-label font-weight-bold">{{ $client->date_of_birth }}</label>
            </div>

            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">លេខទំនាក់ទំនង</label>
                <label class="col-sm-8 col-form-label font-weight-bold">{{ $client->phone_number }}</label>
            </div>
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">អាស័យដ្ឋាន</label>
                <label class="col-sm-8 col-form-label font-weight-bold">
                    {{ $client->address }}
                </label>
            </div>
            
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">បង់លើកទី</label>
                <label class="col-sm-8 col-form-label font-weight-bold">
                    @isset($payment)
                        {{($payment->sort??'') }}/{{ ($payment->loan->term??'') }}
                    @endisset
                    @isset($loan)
                        {{ ($loan->payments->where('status','paid')->count()) }}/{{ ($loan->term??'') }}
                    @endisset
                </label>
            </div>
        </div>
    </div>
</div>


