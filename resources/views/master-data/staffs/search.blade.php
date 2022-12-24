<div class="card">
        
    <div class="card-body">
        <form action="{{ route('master-data.staff.index') }}" class="mt-2" id="frmSearch" method="GET">
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
                    <select class="form-control select2" name="status" >
                        <option value="" disabled selected>[-- សភាព --]</option>
                        <option value="all" {{ request('status') == 'all'?'selected':'' }}>ទាំងអស់</option>
                        @foreach ($status as $st)
                            <option value="{{ $st->id }}"   {{ request('status') == $st->id ? 'selected' :  '' }}>{{ $st->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        class="form-control"
                        name="name_kh"
                        maxlength="50"
                        value="{{ request('name_kh') }}"
                        placeholder="ឈ្មោះជាភាសាខ្មែរ">
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3 mb-1">
                    <input
                        type="text"
                        class="form-control"
                        name="name_en"
                        maxlength="50"
                        value="{{ request('name_en') }}"
                        placeholder="ឈ្មោះជាឡាតាំង">
                </div>

                <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-1">
                    <button type="submit" class="btn btn-primary mb-2">ស្វែងរក</button>
                    <a href="{{route('master-data.staff.index')}}" class="btn btn-warning mb-2">សំអាត</a>
                </div>
            </div>
        </form>
    </div>
</div>