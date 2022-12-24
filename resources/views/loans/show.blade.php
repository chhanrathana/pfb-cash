@extends('layouts.app')
@section('title', 'តារាង-កម្ចី')

@section('content')
    @include('includes.read-client')

    @include('includes.read-loan')

   

    <div class="card">
        <div class="card-header">
            <div class="float-right">
                  <a href="{{ route('loan.export',['id' => $loan->id])}}"
                class="btn btn-sm btn-info ">
                <span class="material-icons-outlined">file_download</span>
            </a>

            <a class="btn btn-sm btn-warning " target="_blank" href="{{ route('loan.download',['id' => $loan->id ])}}">
                <span class="material-icons-outlined">print</span>
            </a>
            </div>
        </div>
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">តារាងបង់ប្រាក់</a>
                  <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">ប្រវត្តិបង់ប្រាក់</a>                  
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id ="table">
                            <thead>
                                <tr>
                                    <th class="text-center text-nowrap"></th>
                                    <th class="text-center text-nowrap">បង់លើកទី</th>
                                    <th class="text-center text-nowrap">សភាព</th>
                                    <th class="text-center text-nowrap">ថ្ងៃបង់ប្រាក់</th>
                                    <th class="text-center text-nowrap">ប្រាក់ដើម</th>
                                    <th class="text-center text-nowrap">ការប្រាក់</th>
                                    <th class="text-center text-nowrap">សេវាប្រតិបត្តិការ</th>
                                    <th class="text-center text-nowrap">ប្រាក់ត្រូវបង់សរុប</th>
                                    <th class="text-center text-nowrap">ប្រាក់ដើមនៅសល់</th>
                                    <th class="text-center text-nowrap">ពិន័យបង់ផ្តាច់</th>
                                    <th class="text-center text-nowrap">ផ្សេងៗ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loan->payments as $payment)
                                <tr>
                                    <td class="text-center text-nowrap">
                                        <a class="btn btn-sm btn-primary {{ $loan->status <> 'pending'?'disabled':'' }}" href="{{ route('loan.list.edit',['id' => $payment->id ])}}">
                                            <span class="material-icons-outlined">edit_calendar</span>
                                        </a>
                                    </td>
                                    <td class="text-right text-nowrap">{{ $payment->sort }}</td>
                                    <td class="text-center text-nowrap"><span class="{{ $payment->_status->css }}">{{ $payment->_status->name }}</span></td>
                                    <td>{{ convertDaytoKhmer(date('D',strtotime($payment->getRawOriginal('payment_date')))).' '.$payment->payment_date }}</td>
                                    <td class="text-right text-nowrap">{{ number_format($payment->deduct_amount) }}</td>
                                    <td class="text-right text-nowrap">{{ number_format($payment->interest_amount) }}</td>
                                    <td class="text-right text-nowrap">{{ number_format($payment->commission_amount) }}</td>
                                    <td class="text-right text-nowrap">{{ number_format($payment->total_amount) }} </td>
                                    <td class="text-right text-nowrap">{{ number_format($payment->pending_amount) }}</td>
                                    <td class="text-right text-nowrap">{{ number_format($payment->penalty_amount) }}</td>
                                    <td class="text-right text-nowrap"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id ="table">
                            <thead>
                                <tr>
                                    <th class="text-center text-nowrap"></th>
                                    <th class="text-center text-nowrap">បង់លើកទី</th>
                                    <th class="text-center text-nowrap">ថ្ងៃត្រូវបង់ប្រាក់</th>
                                    <th class="text-center text-nowrap">ប្រាក់ត្រូវបង់សរុប</th>
                                    <th class="text-center text-nowrap">ថ្ងៃបានបង់ប្រាក់</th>
                                    <th class="text-center text-nowrap">ទឹកប្រាក់បានបង់</th>                                    
                                    <th class="text-center text-nowrap">ប្រភេទ</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                <tr>                                    
                                    <td class="text-right text-nowrap">{{ $loop->index + 1 }}</td>                                    
                                    <td class="text-right text-nowrap">{{ $log->payment->sort??'' }}</td>
                                    <td class="text-left text-nowrap">{{ $log->payment->payment_date??'' }}</td>
                                    <td class="text-right text-nowrap">{{ number_format($log->payment->total_amount) }} </td>
                                    <td class="text-left text-nowrap">{{ $log->transaction_datetime }}</td>
                                    <td class="text-right text-nowrap">{{ number_format($log->transaction_amount) }}</td>
                                    <td class="text-left text-nowrap">{{ $log->type }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                </div>
              </div>            
        </div>
    </div>
@endsection
