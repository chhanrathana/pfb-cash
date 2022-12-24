<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>តារាង-ចំណាយ</strong></div>
            <div class="col">
                <a class="float-right btn btn-md btn-info" href="{{ route('master-data.expense-type.create') }}">
                     <strong>បញ្ចូលថ្មី</strong>
                </a>
            </div>
        </div>
    </div>    
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap"></th>
                        {{-- <th class="text-center text-nowrap">ល.រ</th> --}}
                        <th class="text-center text-nowrap">ប្រភេទចំណាយ</th>                                             
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $expense)
                    <tr>
                        <td class="text-center text-nowrap">
                            <a class="btn btn-sm btn-primary" href="{{ route('master-data.expense-type.edit',['id' => $expense->id]) }}" type="button">
                                <span class="material-icons-outlined">edit</span>
                            </a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $expense->id }}">
                                <span class="material-icons-outlined">delete_outline</span>
                            </button>
                        </td>
                        
                        {{-- <td class="text-right">{{ $loop->index + 1 }}</td>                         --}}
                        <td>{{$expense->name_kh}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>