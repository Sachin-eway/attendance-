@extends('admin.index')

@section('content')
<style>
    #example_filter{
       float: inline-end;
       padding: 12px;
    }
    #example_filter label{
       display: flex;
       justify-content: center;
       align-items: center;
    }
</style>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Employee</div>
					<div class="ms-auto">
						<div class="btn-group">
						    <a href="{{url('addEmployee')}}">
							<button type="button" class="btn btn-primary"><i class="lni lni-circle-plus"></i> Add</button>
							</a>
						</div>
					</div>
				</div>
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="example" class="table table-striped table-bordered" style="width:100%">
				<thead>
					<tr>
						<th>Name</th>
						<th>Organization</th>
						<th>Phone</th>
						<th>email</th>
					</tr>
				</thead>
				<tbody>
				   @foreach($employee as $data)
					<tr role="row" class="odd">
						<td class="sorting_1">{{$data->name}}</td>
						<td>{{$data->organization_name}}</td>
						<td>{{$data->phone}}</td>
						<td>{{$data->email}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="{{asset('public/admin/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script>
   const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 5000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          }
        });
    
    @if (session()->has('success'))
        Toast.fire({
          icon: "success",
          title: "{{session()->get('success')}}"
        });
   @endif

    $('#example').DataTable();

	
</script>
@endsection