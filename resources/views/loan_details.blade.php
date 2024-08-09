@extends('layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Loan Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('loan-details')}}"> Home</a></li>
              <li class="breadcrumb-item active">Loan Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('success') }}
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ Session::get('error') }}
            </div>
        @endif

        {{-- @php Session::forget('success'); Session::forget('error'); @endphp --}}
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Loan details</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">

                    <div class="input-group-append">
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" id="loan-details">
                <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Sr No.</th>
                        <th>No. of Payment</th>
                        <th>First Payment Date</th>
                        <th>Last Payment Date</th>
                        <th>Loan Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($data as $key => $value)
                          <tr>
                              <td>{{ $key+1 }}</td>
                              <td>{{ $value->num_of_payment }}</td>
                              <td>{{ date('d-M-Y', strtotime($value->first_payment_date)) }}</td>
                              <td>{{ date('d-M-Y', strtotime($value->last_payment_date)) }}</td>
                              <td>{{ $value->loan_amount }}</td>
                          </tr>                        
                      @empty
                          <tr>
                              <td colspan="4">No Products found</td>
                          </tr>
                      @endforelse
                    </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection