@extends('layouts.app', ['title' => 'Input Score'])

@section('content')

<div class="content container" style="min-height: 80vh">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-user">
                <div class="card-header">
                  <h5 class="card-title">Input Score {{ $buddy->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.score.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="buddy_id" value="{{ $buddy->id }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Phase</label>
                                    <select name="phase_id" class="custom-select">
                                        @foreach($phase as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('phase')
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
                                    <label>Week</label>
                                    <select name="week" class="custom-select">
                                        @foreach($week as $name => $id)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('week')
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
                                    <label>Score</label>
                                    <input type="number" name="score" step=any class="form-control @error('score') is-invalid @enderror" placeholder="ex: 43.77" value="{{ old('score') }}" min=0 max=115>
                                </div>
                                @error('score')
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
                                    <label for="exampleFormControlTextarea1">Note</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="notes" rows="3" placeholder="Ex: Absent 0, late 0, this student is amazing"></textarea>
                                </div>
                                @error('score')
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
                                <button type="submit" class="btn btn-primary btn-round btn-block">Submit</button>
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