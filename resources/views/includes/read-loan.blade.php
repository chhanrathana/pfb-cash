<div class="card">
    <div class="card-header"><strong>ព័ត៌មានកម្ចី</strong></div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">កូដកិច្ចសន្យា</label>
                <label class="col-sm-8 col-form-label font-weight-bold">{{ $loan->code }}</label>
            </div>

            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ភ្នាក់ងារ</label>
                <label class="col-sm-8 col-form-label font-weight-bold">{{ $loan->staff->name_kh }}</label>
            </div>
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ចំនួនប្រាក់កម្ចី </label>
                <label class="col-sm-8 col-form-label font-weight-bold">{{ number_format($loan->principal_amount) }}</label>
            </div>
            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ប្រាក់ការ​ (%)</label>
                <label class="col-sm-8 col-form-label font-weight-bold">{{ $loan->rate }}</label>
            </div>

            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ប្រាក់សេវា​ (%) </label>
                <label class="col-sm-8 col-form-label font-weight-bold">{{ $loan->interest->commission_rate }}</label>
            </div>

             <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">ថ្ងៃខ្ចី </label>
                <label class="col-sm-8 col-form-label font-weight-bold">{{ $loan->registration_date }}</label>
            </div>

            <div class="col-sm-6 col-md-6 form-group row">
                <label class="col-sm-4 col-form-label">រយះពេល(ដង)</label>
                <label class="col-sm-8 col-form-label font-weight-bold">{{ $loan->term }}</label>
            </div>
        </div>
    </div>
</div>


