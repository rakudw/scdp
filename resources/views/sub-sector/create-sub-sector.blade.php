@extends('layout.master')

@if(auth()->user()->role_id != '1')
    <script type="text/javascript">
        window.location = "/dashboard";

    </script>
@endif
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Add Sub-Sector</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Master</a></li>
                    <li class="breadcrumb-item active">Add Sub-Sector</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        @if($errors->any())
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                <div class="col-lg-6 alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </div>
            </div>
        @endif
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <!-- /.card-header -->
                    <!-- form start -->
				   <div class="card">
                        <form id="subsectorForm" action="{{ route('sub-sector.store') }}" method="POST">
                            @csrf
                            <input type="hidden" id="department_id" name="department_id" required>
                            <div class="card-body">
    							<div class="row">
        							<div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="service_id">Service*</label>
                                            <select name="service_id" id="service_id" class="form-control">
                                                <option value="">--- Select Service ---</option>
                                            </select>
                                        </div>
        							</div>
        							<div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="sector_id">Sector Name*</label>
                                            <select id="sector_id" name="sector_id" class="form-control">
                                                <option value="">--- Select Sector ---</option>
                                            </select>
                                        </div>
        							</div>
        							<div class="col-lg-3">
                                        <label for="subsectors_name">Sub-Sector Name*</label>
                                        <input type="text" class="form-control" id="subsector_name" name="subsectors_name"
                                            placeholder="Enter subsector name">
                                    </div>
                                </div>
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

@section('scripts')
<script type="text/javascript">

    $('document').ready(function () {
        $.ajax({
            url: "{{ route('get_service_list') }}",
            method: 'GET',
            success: function (data) {
                var serviceList = data.$serviceList;
                var htmlService = "<option value=''>--- Select Service ---</option>";
                for (var i = 0; i < serviceList.length; i++) {
                    htmlService += `<option value="` + serviceList[i]['id'] + `">` +
                        serviceList[i]['service_name'] + `</option>`;
                }
                $('#service_id').html(htmlService);
            }
        });
    });

    $("#service_id").change(function(){
        $.ajax({
            url: "{{ route('get_sector') }}?service_id=" + $(this).val(),
            method: 'GET',
            success: function(data) {
                $('#sector_id').html(data.sectorhtml);
                $('#department_id').val('');
            }
        });
    });

    $("#sector_id").change(function(){
        var sector_id = $(this).val();
        $.ajax({
            url: "{{ url('get_sector_data') }}?sector_id=" + sector_id ,
            method: 'GET',
            success: function(data) {
                var sectorData = data.sectorData;
                $('#department_id').val(sectorData[0]['department_id']);
            }
        });
    });

</script>
@endsection