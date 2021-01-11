@extends('layouts.app', ['title' => 'Import Buddies data'])

@section('content')
<div class="content container" style="min-height: 80vh">
    <div class="row">
       
                                
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header">
                    Import buddy's data in excel or csv with column (name, batch, api_key)
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" style="display: block">
                            <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="nc-icon nc-simple-remove"></i>
                            </button>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif
                    <form action="{{ route('admin.buddy.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
                        <br>
                        <button class="btn btn-primary">Import Buddy Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection