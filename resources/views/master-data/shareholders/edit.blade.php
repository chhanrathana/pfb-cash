@extends('layouts.app')
@section('title','កែប្រែ-ម្ចាស់ភាគហ៊ុន')
    
@section('content')
@include('includes.alert-info')
    <div class="card">
        <div class="card-header"><strong>កែប្រែ-ម្ចាស់ភាគហ៊ុន</strong></div>

        <form action="{{ route('shareholder.update',['id' => $shareholder->id]) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label>ឈ្មោះជាភាសាខ្មែរ</label>
                        <input
                            class="form-control {{ $errors->first('name_kh') ? 'is-invalid':'' }}"
                            name="name_kh"
                            type="text"
                            placeholder="មាន ចិត្ត"
                            value="{{ old('name_kh')??$shareholder->name_kh }}"
                            maxlength="50" >
                        <div class="invalid-feedback">{{ $errors->first('name_kh') }}</div>
                    </div>
    
                    <div class="form-group col-sm-4">
                        <label>ឈ្មោះជាឡាតាំង</label>
                        <input
                            class="form-control {{ $errors->first('name_en') ? 'is-invalid':'' }}"
                            name="name_en"
                            type="text"
                            placeholder="MEAN CHET"
                            value="{{ old('name_en')??$shareholder->name_en }}"
                            maxlength="50">
                        <div class="invalid-feedback">{{ $errors->first('name_en') }}</div>
                    </div>                    
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col">
                        <button class="btn btn-sm btn-success float-right" type="submit">
                            <span class="material-icons-outlined">save</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
</div>
@endsection
