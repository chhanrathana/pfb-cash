<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>ស្វែងរក</strong></div>            
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('expense.item.index') }}" method="GET">
            @csrf
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
                    <select class="form-control select2" name="expense_type_id" >
                        <option value="" disabled selected>[-- ប្រភេទចំណាយ --]</option>
                        <option value="all" {{ request('expense_type_id') == 'all'?'selected':'' }}>ទាំងអស់</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" {{ request('expense_type_id') == $type->id?'selected':'' }}>{{ $type->name_kh }}</option>
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
                        name="from_date"
                        value="{{ request('from_date')??$fromDate }}"
                        placeholder="ចាប់ពីថ្ងៃបង់ប្រាក់">
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        maxlength="10"
                        data-inputmask-alias="dd/mm/yyyy"
                        data-val="true"
                        data-val-required="Required"
                        class="form-control"
                        name="to_date"
                        value="{{ request('to_date')??$toDate }}"
                        placeholder="ដល់ថ្ងៃបង់ប្រាក់">
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <button type="submit" class="btn btn-primary mb-2">ស្វែងរក</button>
                    <a href="{{route('expense.item.index')}}" class="btn btn-warning mb-2">សំអាត</a>                    
                </div>
            </div>
        </form>
    </div>
</div>