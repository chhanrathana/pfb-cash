<div class="card">
    <div class="card-header"><strong>ស្វែងរក</strong></div>
    <div class="card-body">

        <form action="{{ route('payment.list.index') }}" class="mt-2" id="frmSearch" method="GET">
            <div class="form-row">
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <select class="form-control select2" name="branch_id" >
                        <option value="" disabled selected>[-- សាខា --]</option>
                        <option value="all" {{ request('branch_id') == 'all'?'selected':'' }}>ទាំងអស់</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id?'selected':'' }}>{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <select class="form-control select2" name="staff_id" >
                        <option value="" disabled selected>[-- ភ្នាក់ងារ	 --]</option>
                        <option value="all" {{ request('staff_id') == 'all'?'selected':'' }}>ទាំងអស់</option>
                        @foreach ($staffs as $staff)
                            <option value="{{ $staff->id }}" {{ request('staff_id') == $staff->id?'selected':'' }}>{{ $staff->name_kh }}</option>
                        @endforeach
                    </select>
                </div>
        
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <select class="form-control select2" name="interest_rate_id" >
                        <option value="" disabled selected>[-- ប្រភេទកម្ចី --]</option>
                        <option value="all" {{ request('interest_rate_id') == 'all'?'selected':'' }}>ទាំងអស់</option>
                        @foreach ($interests as $interest)
                            <option value="{{ $interest->id }}" {{ request('interest_rate_id') == $interest->id?'selected':'' }}>{{ $interest->name }}</option>
                        @endforeach
                    </select>
                </div>
        
                 <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <select class="form-control select2" name="status" >
                        <option value="" disabled selected>[-- សភាព --]</option>
                        <option value="all" {{ request('status') == 'all'?'selected':'' }}>ទាំងអស់</option>
                        @foreach ($status as $st)
                            <option value="{{ $st->id }}" {{ request('status') == $st->id?'selected':'' }}>{{ $st->name }}</option>
                        @endforeach
                    </select>
                </div>
        
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        class="form-control"
                        name="payment_date"
                        value="{{ request('payment_date')??$paymeneDate }}"
                        placeholder="ថ្ងៃត្រូវបង់ប្រាក់">
                </div>
        
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        class="form-control"
                        name="​client_code"
                        maxlength="50"
                        value="{{ request('​client_code') }}"
                        placeholder="កូដអតិថិជន">
                </div>
                
                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        class="form-control"
                        name="name"
                        maxlength="50"
                        value="{{ request('name') }}"
                        placeholder="ឈ្មោះ">
                </div>       
                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <button type="submit" class="btn btn-primary mb-2">ស្វែងរក</button>
                    <a href="{{ route('payment.list.index') }}" class="btn btn-warning mb-2">សំអាត</a>
                </div>
            </div>
        </form>
    </div>
</div>