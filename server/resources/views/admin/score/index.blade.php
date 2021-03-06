@extends('layouts.app', ['title' => 'Score - '.$buddy->name])

@section('content')
<!-- main content -->

<div class="content container" style="min-height: 80vh">
    <div class="row">
        <div class="col-md-12">
            
            {{-- TABLE --}}
            <div class="card">
                <div class="card-header">
                   <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Score Lists</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('admin.score.create', $buddy->id) }}" class="btn btn-default">Input Score</a>
                        </div>
                   </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                        @if ($buddy->score->count())
                        <thead class=" text-primary">
                            <th>
                            No
                            </th>
                            <th>
                            Phase
                            </th>
                            <th>
                            Week
                            </th>
                            <th>
                            Score
                            </th>
                            <th>
                            Action
                            </th>
                        </thead>
                        @endif
                        <tbody>
                            @forelse ($buddy->score as $no => $item)
                            <tr>
                                <th>
                                    {{ $no+1 }}
                                </th>
                            <td>
                                {{ $item->phase->name }}
                            </td>
                            <td>
                                {{ $item->week }}
                            </td>
                            <td>
                                {{ $item->score }}
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('admin.buddy.score.report', $item->id) }}"  title="See Report">
                                    <i class="fa fa-file"></i>
                                </a>
                                <a class="btn btn-success" href="{{ route('admin.score.edit', $item->id) }}"  title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                            </tr>
                            @empty
                            <div style="display: flex; align-items:center;flex-direction:column;">
                                <p class="alert alert-danger" style="width:100%">No Data Found</p>
                                <img src="{{ asset('assets/img/empty.svg') }}" alt="empty" style="margin-top: 10px; width:40%">
                            </div>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
              </div>
              
            {{-- END TABLE --}}
        </div>
    </div>
</div>

<!-- end main content -->
@endsection