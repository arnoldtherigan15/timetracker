@extends('layouts.app', ['title' => $buddy->name."'s Coding Time"])

@section('content')

<div class="content container" style="min-height: 80vh">
    <div class="row">
        @forelse (array_reverse($records) as $record)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-text card-header-primary">
                    <div class="card-text">
                        <h4 class="card-title">{{ $record['date'] }}</h4>
                    </div>
                    </div>
                    <div class="card-body text-center">
                        <span class="badge badge-primary" style="font-size:20px">{{ $record['total_time'] }}</span>
                    </div>
                    <div class="card-footer row" style="height: 200px;overflow-y:auto">
                        @forelse ($record['projects'] as $project)
                            <div class="col-md-12 my-4">
                                <h5 style="width: 320px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">Repo Name : {{ $project['name'] }}</h5>
                                <div class="progress-container progress-success">
                                    <span class="progress-badge">Total Time : {{ $project['text'] }}</span>
                                </div>
                            </div>  
                        @empty 
                            <div class="col-md-12 flex-column d-flex align-items-center justify-content-center">
                                <p>Not Productive</p>
                                <img src="{{ asset('assets/img/sleep.svg') }}" style="width: 50%">
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
        @empty
        
        @endforelse
    </div>
</div>

@endsection