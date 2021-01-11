@extends('layouts.app', ['title' => 'Buddies'])

@section('content')
<!-- main content -->

<div class="content container" style="min-height: 80vh">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.buddy.create') }}" class="btn btn-primary">Add student</a>
        </div>
        <div class="col-md-12">
            <form action="{{ route('admin.buddy.index') }}" method="GET">
                <div class="input-group no-border">
                    <input name="q" type="text" class="form-control" placeholder="Search by name ...">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <i class="nc-icon nc-zoom-split"></i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            
            {{-- TABLE --}}
            <div class="card">
                <div class="card-header">
                   <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Buddy Lists</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('admin.buddy.showImport') }}" class="btn btn-default">Upload Excel</a>
                        </div>
                   </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                        @if ($buddies->count())
                        <thead class=" text-primary">
                            <th>
                                No
                            </th>
                            <th>
                            Name
                            </th>
                            <th>
                            Batch
                            </th>
                            <th>
                            api_key
                            </th>
                            <th class="text-right">
                            Action
                            </th>
                        </thead>
                        @endif
                        <tbody>
                            @forelse ($buddies as $no => $buddy)
                            <tr>
                                <th>
                                    {{ ++$no + ($buddies->currentPage()-1) * $buddies->perPage() }}
                                </th>
                            <td>
                                {{ $buddy->name }}
                            </td>
                            <td>
                                {{ $buddy->batch }}
                            </td>
                            <td>
                                {{ $buddy->api_key }}
                            </td>
                            <td class="text-right">
                                <a class="btn btn-success" href="{{ route('admin.buddy.edit', $buddy->id) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <button class="btn btn-danger" onClick="Delete({{ $buddy->id }})">
                                    <i class="fa fa-trash"></i>
                                </button>
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
                        <div class="mt-2" style="display:flex; justify-content:center;">
                            {{ $buddies->links("vendor.pagination.bootstrap-4") }}
                        </div>
                    </div>
                </div>
              </div>
              
            {{-- END TABLE --}}
        </div>
    </div>
</div>

<!-- end main content -->
@endsection