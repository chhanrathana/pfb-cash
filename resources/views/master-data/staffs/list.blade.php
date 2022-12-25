<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>តារាង-ភ្នាក់ងារ</strong></div>
            <div class="col">
                <a class="float-right btn btn-md btn-info" href="{{ route('master-data.staff.create') }}">
                     <strong>បញ្ចូលថ្មី</strong>
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="table">
                <thead>
                    <tr>
                        <th ></th>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">សភាព</th>
                        <th class="text-center text-nowrap">សាខា</th>
                        <th class="text-center text-nowrap">ឈ្មោះជាភាសាខ្មែរ</th>
                        <th class="text-center text-nowrap">ឈ្មោះជាឡាតាំង</th>
                        <th class="text-center text-nowrap">ភេទ</th>
                        <th class="text-center text-nowrap">ថ្ងៃខែឆ្នាំកំណើត</th>
                        <th class="text-center text-nowrap">លេខទំនាក់ទំនង</th>
                        <th class="text-center text-nowrap">ថ្ងៃខែឆ្នាំចូលបម្រើការងារ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staffs as $staff)
                    <tr>
                         <td class="text-center text-nowrap">
                            <a class="btn btn-sm btn-primary" href="{{ route('master-data.staff.edit',['id' => $staff->id]) }}" type="button">
                                <span class="material-icons-outlined">edit</span>
                            </a>

                            <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $staff->id }}">
                                <span class="material-icons-outlined">delete_outline</span>
                            </button>
                        </td>
                        <td class="text-right text-nowrap">{{ $loop->index + 1 }}</td>
                        <td class="text-center text-nowrap"><span class="{{ $staff->_status->css }}">{{ $staff->_status->name }}</span></td>
                        <td class="text-left text-nowrap">{{$staff->branch->name??''}}</td>
                        <td class="text-left text-nowrap">{{ $staff->name_kh??''}}</td>
                        <td class="text-left text-nowrap">{{ $staff->name_en??''}}</td>
                        <td class="text-center text-nowrap">{{ $staff->_sex->name??''}}</td>
                        <td class="text-center text-nowrap">{{ $staff->date_of_birth??''}}</td>
                        <td class="text-center text-nowrap">{{ $staff->phone_number??''}}</td>
                        <td class="text-center text-nowrap">{{ $staff->start_work_date??''}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">{{$staffs->appends($_GET)->links()}}</div>            
        </div>        
    </div>
</div>