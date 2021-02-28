@extends('layouts.app', ['title' => 'Log Time ' . $buddy->name])

@section('content')
<!-- main content -->

<div class="content container" style="min-height: 80vh">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.time.export', $buddy->id) }}" class="btn btn-primary float-right">Download Excel</a>

            {{-- TABLE --}}
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                        @if ($buddy->log->count())
                        <thead class="text-primary text-center">
                            <th>
                                No
                            </th>
                            <th>
                            Date
                            </th>
                            <th>
                            Total Time
                            </th>
                        </thead>
                        @endif
                        <tbody>
                            @forelse ($buddy->log as $no => $log)
                            <tr class="text-center">
                                <th>
                                    {{ ++$no }}
                                </th>
                            <td>
                                {{ dateID($log->date) }}
                            </td>
                            <td>
                                {{ $log->total_hours }} Hours {{ $log->total_minutes }} Minutes
                            </td>
                            </tr>
                            @empty
                            <div style="display: flex; align-items:center;flex-direction:column;">
                                <p class="alert alert-danger" style="width:100%">No Data Found - Track your buddies coding time first</p>
                                <img src="{{ asset('assets/img/empty.svg') }}" alt="empty" style="margin-top: 10px; width:40%">
                            </div>
                            @endforelse
                        </tbody>
                        </table>
                        {{-- <div class="mt-2" style="display:flex; justify-content:center;">
                            {{ $buddies->links("vendor.pagination.bootstrap-4") }}
                        </div> --}}
                    </div>
                </div>
              </div>
              
            {{-- END TABLE --}}
        </div>
    </div>
</div>

<!-- end main content -->
@endsection