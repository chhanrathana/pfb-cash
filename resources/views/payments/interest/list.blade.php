<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>តារាង-បង់ការប្រាក់</strong></div>
        </div>
    </div>
    <div class="card-body">
           <div class="table-responsive">
               <table class="table table-bordered table-striped table-hover" id ="table">
                   <thead>
                       <tr>
                           <th class="text-center text-nowrap"></th>
                           <th class="text-center text-nowrap">ល.រ</th>
                           <th class="text-center text-nowrap">សភាព</th>
                           <th class="text-center text-nowrap">សាខា</th>
                           <th class="text-center text-nowrap">មន្រ្តីឥណទាន</th>
                           <th class="text-center text-nowrap">ថ្ងៃត្រូវបង់</th>
                           <th class="text-center text-nowrap">កូដអតិថិជន</th>
                           <th class="text-center text-nowrap">កូដកិច្ចសន្យា</th>
                           <th class="text-center text-nowrap">ឈ្មោះអតិថិជន</th>
                           <th class="text-center text-nowrap">ប្រាក់ត្រូវបង់សរុប</th>
                           <th class="text-center text-nowrap">ប្រាក់បានបង់សរុប</th>
                           <th class="text-center text-nowrap">ប្រាក់មិនទាន់បង់សរុប</th>
                           <th class="text-center text-nowrap">ប្រាក់ដើមនៅសល់</th>
                       </tr>
                   </thead>
                   <tbody>
                       @foreach ($payments as $payment)
                       @php
                           $unPaidAmount = $payment->total_amount - $payment->total_paid_amount;
                       @endphp
   
                       <tr class="{{ $payment->isOverDate()?'table-danger':'' }}">
                           <td class="text-center text-nowrap">
                                <a class="btn btn-sm btn-primary" {{ $payment->status <> 'pending'?'disabled':'' }}  href="{{ route('payment.interest.edit',['id' => $payment->id ])}}">
                                   <span class="material-icons-outlined">edit</span>
                               </a>
                           </td>
                           <td class="text-right text-nowrap">{{ $loop->index + 1 }}</td>
                           <td class="text-center text-nowrap"><span class="{{ $payment->_status->css }}">{{ $payment->_status->name }}</span></td>
                           <td class="text-left text-nowrap">{{ $payment->loan->branch->name??''}}</td>
                           <td class="text-left text-nowrap">{{ $payment->loan->staff->name_kh??''}}</td>
                           <td class="text-center text-nowrap">{{ $payment->payment_date??''}}</td>
                           <td class="text-center text-nowrap">{{ $payment->loan->client->code??''}}</td>
                           <td class="text-center text-nowrap">{{ $payment->loan->code??''}}</td>
                           <td class="text-left text-nowrap">{{ $payment->loan->client->name_kh??''}}</td>
                           <td class="text-right text-nowrap">{{ number_format($payment->total_amount??'')}}</td>
                           <td class="text-right text-nowrap">{{ number_format($payment->total_paid_amount??0)}}</td>
                           <td class="text-right text-nowrap">{{ number_format($unPaidAmount)}}</td>
                           <td class="text-right text-nowrap">{{ number_format($payment->loan->pending_amount??0) }}</td>
                       </tr>
                       @endforeach
                   </tbody>
               </table>
               <div class="text-center">{{$payments->appends($_GET)->links()}}</div>            
           </div>
           
       </div>
   </div>