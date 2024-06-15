@extends('layout.master')

@if (auth()->user()->role_id != '1')
    <script type="text/javascript">
        window.location = "/dashboard";
    </script>
@endif
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Plan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Master</a></li>
                        <li class="breadcrumb-item active">Add Plan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            @if ($errors->any())
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                    <div class="col-lg-6 alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </div>
                </div>
            @endif
            <section class="content">
                <div class="row">
                    <div class="col-lg-4">
                        <!-- /.card-header -->
                        <!-- form start -->
						<div class="card">
                        <form id="planForm" action="{{ route('plan.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
								<div class="row">
								<div class="col-lg-12">
                                <div class="form-group">
                                    <label for="plan_name">Plan Name</label>
                                    <input type="text" class="form-control" id="plan_name" name="plan_name"
                                        placeholder="Enter plan name">
                                </div>
								</div>
								</div>
                                <!-- /.card-body -->
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-success">Add</button>
								</div>
                        </form>
                    
					</div>
                </div>
        </div>
    </section>
    </div>
    </section>
@endsection