<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>ស្វែងរក</strong></div>            
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('master-data.deposit.index') }}" method="GET">
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
                    <button type="submit" class="btn btn-primary mb-2">ស្វែងរក</button>
                    <a href="{{route('master-data.deposit.index')}}" class="btn btn-warning mb-2">សំអាត</a>                    
                </div>
            </div>
        </form>
    </div>
</div>