<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col"><strong>តារាង-បង់ផ្តាច់</strong></div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
               <table class="table table-bordered table-striped table-hover" id ="table">
                   <thead>
                       <tr>
                           <th></th>
                           <th class="text-center text-nowrap">ល.រ</th>
                           <th class="text-center text-nowrap">សភាព</th>
                           <th class="text-center text-nowrap">សាខា</th>
                           <th class="text-center text-nowrap">កូដអតិថិជន</th>
                           <th class="text-center text-nowrap">ឈ្មោះអតិថិជន</th>
                           <th class="text-center text-nowrap">មន្រ្តីឥណទាន</th>
                           <th class="text-center text-nowrap">ប្រភេទកម្ចី</th>                        
                           <th class="text-center text-nowrap">ថ្ងៃខ្ចី</th>
                           <th class="text-center text-nowrap">ថ្ងៃត្រូវបង់ផ្តាច់</th>
                           <th class="text-center text-nowrap">ប្រាក់ការ</th>
                           <th class="text-center text-nowrap">ប្រាក់សេវា</th>
                           <th class="text-center text-nowrap">ចំនួនប្រាក់កម្ចី</th>
                           <th class="text-center text-nowrap">ប្រាក់ដើមនៅសល់</th>
                           <th class="text-center text-nowrap">ប្រាក់ការត្រូវបង់ផ្តាច់</th>
                           <th class="text-center text-nowrap">ប្រាក់សេវាត្រូវបង់ផ្តាច់</th>
                       </tr>
                   </thead>
                   <tbody>
   
                   @foreach ($loans as $loan)
                       <tr>
                           <td class="text-center text-nowrap">
                               <a class="btn btn-sm btn-primary" href="{{ route('payment.deduction.edit',['id' => $loan->id ])}}">
                                   <span class="material-icons-outlined">edit</span>
                               </a>
                           </td>
                           <td class="text-right text-nowrap">{{ $loop->index + 1 }}</td>
                           <td class="text-center text-nowrap"><span class="{{ $loan->_status->css }}">{{ $loan->_status->name }}</span></td>
                           <td class="text-left text-nowrap">{{ $loan->branch->name??''}}</td>
                           <td class="text-left text-nowrap">{{ $loan->client->code??''}}</td>
                           <td class="text-left text-nowrap">{{ $loan->client->name_kh??''}}</td>
                           <td class="text-left text-nowrap">{{ $loan->staff->name_kh??''}}</td>
                           <td class="text-left text-nowrap">{{ $loan->interest->name??''}}</td>                        
                           <td class="text-center text-nowrap">{{ $loan->registration_date??''}}</td>
                           <td class="text-center text-nowrap">{{ $loan->last_payment_date??''}}</td>
                           <td class="text-right text-nowrap">{{ number_format($loan->rate,2)}} %</td>
                           <td class="text-right text-nowrap">{{ number_format($loan->interest->commission_rate,2)}} %</td>
                           <td class="text-right text-nowrap">{{ number_format($loan->principal_amount) }}</td>
                           <td class="text-right text-nowrap">{{ number_format($loan->pending_amount) }}</td>
                           <td class="text-right text-nowrap">{{ number_format($loan->payments->where('status','<>','paid')->sum('interest_amount')) }}</td>
                           <td class="text-right text-nowrap">{{ number_format($loan->payments->where('status','<>','paid')->sum('commission_amount')) }}</td>
                       </tr>
                   @endforeach
                   </tbody>
               </table>
               <div class="text-center">{{$loans->appends($_GET)->links()}}</div>            
           </div>
          
       </div>
   </div>