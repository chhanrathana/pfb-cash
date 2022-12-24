<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>តារាង-មន្ដ្រីឥណទាន</strong></div>
            <div class="col">
                <a
                href="{{ route('report-operation.loan-export',$_GET)}}"
                class="btn btn-sm btn-info float-right mb-2">
                <span class="material-icons-outlined">file_download</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id ="table">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap">ល.រ</th>
                        <th class="text-center text-nowrap">សភាព</th>
                        <th class="text-center text-nowrap">កូដអតិថិជន</th>
                        <th class="text-center text-nowrap">ឈ្មោះអតិថិជន</th>
                        <th class="text-center text-nowrap">ប្រភេទកម្ចី</th>
                        <th class="text-center text-nowrap">ថ្ងៃខ្ចី</th>
                        <th class="text-center text-nowrap">ចំនួនកម្ចី</th>
                        <th class="text-center text-nowrap">ប្រាក់ដើមនៅសល់</th>
                        <th class="text-center text-nowrap">ការបរិច្ឆេទបង់ផ្តាច់</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loans as $key => $loan)
                    <tr>
                        <td class="text-right text-nowrap">{{ $loans->firstItem() + $key}}</td>
                        <td class="text-center text-nowrap"><span class="{{ $loan->_status->css }}">{{ $loan->_status->name }}</span></td>
                        <td class="text-left text-nowrap">{{ $loan->client->code??''}}</td>
                        <td class="text-left text-nowrap">{{ $loan->client->name_kh??''}}</td>
                        <td class="text-center text-nowrap">{{ $loan->interest->name??''}}</td>
                        <td class="text-center text-nowrap">{{ $loan->registration_date??''}}</td>
                        <td class="text-right text-nowrap">{{ number_format($loan->principal_amount) }}</td>
                        <td class="text-right text-nowrap">{{ number_format($loan->pending_amount) }}</td>
                        <td class="text-center text-nowrap">{{ $loan->last_payment_date??''}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">{{$loans->appends($_GET)->links()}}</div>
        </div>        
    </div>
</div>