<div class="card">
    <div class="card-header"><strong>តារាង-អ្នកប្រើប្រាស់</strong></div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover" id ="table">
            <thead>
                <tr>
                    <th class="text-center text-nowrap"></th>
                    <th class="text-center text-nowrap">ល.រ</th>
                    <th class="text-center text-nowrap">សភាព</th>      
                    <th class="text-center text-nowrap">សិទ្ធិ</th>                        
                    <th class="text-center text-nowrap">សាខា</th>
                    <th class="text-center text-nowrap">គណនី</th>
                    <th class="text-center text-nowrap">ឈ្មោះ</th>                    
                                      
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="text-center text-nowrap">
                        <a class="btn btn-sm btn-primary" href="{{ route('user.edit',['id' => $user->id]) }}" type="button">
                            <span class="material-icons-outlined">edit</span>
                        </a>

                        <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $user->id }}">
                            <span class="material-icons-outlined">delete_outline</span>
                        </button>
                    </td>
                    <td class="text-right">{{ $loop->index + 1 }}</td>
                    <td><span class="badge {{$user->status? 'badge-success':'badge-danger'}}">{{$user->status?'active':'inactive'}}</span></td>                        
                    <td>{{$user->type->name??''}}</td>                        
                    <td>{{$user->branch->name??''}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->name}}</td>                    
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>