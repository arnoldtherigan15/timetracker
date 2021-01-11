@extends('layouts.app', ['title' => 'Time Tracker'])

@section('content')

<div class="content container" style="min-height: 80vh">
    <div class="row">
        @forelse ($buddies as $buddy)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header card-header-icon card-header-primary">
                    <div class="card-icon">
                        <i class="material-icons">face</i>
                    </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title" style="width: 220px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{ $buddy->name }}</h4>
                        {{ $buddy->batch }}
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.time.detail', $buddy->id) }}" class="btn btn-default">Coding Time</a>
                    </div>
                </div>
            </div>
            
        @empty
        <div style="display: flex; align-items:center;flex-direction:column; width:100%" >
            <p class="alert alert-danger" style="width:100%">Add Buddy First !!</p>
            <img src="{{ asset('assets/img/empty.svg') }}" alt="empty" style="margin-top: 10px; width:40%">
        </div>
        @endforelse
    </div>
</div>

@endsection