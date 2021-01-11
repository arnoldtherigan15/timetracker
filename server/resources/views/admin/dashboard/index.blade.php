@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
<!-- main content -->

      <!-- End Navbar -->
      <div class="content" style="min-height: 80vh">
        {{-- <div class="container-fluid"> --}}
            <div class="row justify-content-center align-items-center" style="height: 80vh">
                <h1>Track your buddies coding time</h1>
              <div class="col-md-12 text-center">
                  <img src="{{ asset('assets/img/time.svg') }}" alt="" style="width: 50%">
              </div>
          </div>
        {{-- </div> --}}
      </div>

<!-- end main content -->
@endsection