@extends('layouts.app', ['title' => "Edit Buddy's Data"])

@section('content')

<div class="content container" style="min-height: 80vh">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-user">
                <div class="card-header">
                  <h5 class="card-title">Buddy Data</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.buddy.update', $buddy->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="ex: John Doe" value="{{ old('name',$buddy->name) }}" >
                                </div>
                                @error('name')
                                    <div class="alert alert-danger alert-dismissible fade show" style="display: block">
                                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                        </button>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Batch Name</label>
                                    <input type="text" name="batch" class="form-control @error('batch') is-invalid @enderror" placeholder="ex: Infinity Fox" value="{{ old('batch',$buddy->batch) }}" >
                                </div>
                                @error('batch')
                                    <div class="alert alert-danger alert-dismissible fade show" style="display: block">
                                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                        </button>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>API_KEY</label>
                                    <input name="api_key" type="password" class="form-control @error('api_key') is-invalid @enderror" value="{{ old('api_key', $buddy->api_key) }}" >
                                </div>
                                @error('api_key')
                                    <div class="alert alert-danger alert-dismissible fade show" style="display: block">
                                        <button type="button" aria-hidden="true" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="nc-icon nc-simple-remove"></i>
                                        </button>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <button type="submit" class="btn btn-primary btn-round btn-block">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('assets/img/add.svg') }}" alt="thumbnail" style="width: 90%">
        </div>
    </div>
</div>

@endsection