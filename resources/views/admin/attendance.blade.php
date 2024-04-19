@extends('admin.index')

@section('content')
<link rel="stylesheet" href="{{asset('public/admin/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css')}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
    #example2_filter{
       float: inline-end;
       padding: 12px;
    }
    #example2_filter label{
       display: flex;
       justify-content: center;
       align-items: center;
    }
    .fiter-table{
        display:flex;
        gap:10px;
    }
    #tabledata{
       width: 98%;
       margin: auto;
       margin-bottom: 60px;
    }
</style>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Attendance</div>
					<div class="ms-auto">
			    <form class="fiter-table">
			        @csrf
			       <input class="result form-control" type="text" id="startDate" name="startDate" style="width:150px;" placeholder="Start Date">
			       <input class="result form-control" type="text" id="endDate" name="endDate" style="width:150px;" placeholder="End Date">
			       <select class="single-select" name="user_id" style="width:200px;">
    					<option disabled selected >Select employee</option>
    					@foreach($employee as $data)
    				     	<option value="{{$data->id}}">{{$data->name}}</option>
    				    @endforeach
				   </select>
				   	
			    </form>
			
						</div>
					</div>
				</div>
<div class="card" id="tabledata">
	
</div>
<script src="{{asset('public/admin/assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('public/admin/assets/plugins/datetimepicker/js/picker.js')}}"></script>
<script src="{{asset('public/admin/assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js')}}"></script>
<script src="{{asset('public/admin/assets/plugins/datetimepicker/js/picker.date.js')}}"></script>
<script src="{{asset('public/admin/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js')}}"></script>
<script>
$('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
$('#startDate').bootstrapMaterialDatePicker({
				time: false
			});
$('#endDate').bootstrapMaterialDatePicker({
				time: false
			});
$('#endDate').change(function(){
	getdata();
});
$('#startDate').change(function(){
	getdata();
});
		
function getdata() {
    let formdata = new FormData($('.fiter-table')[0]);
    $.ajax({
        url: "/getAttendanceData", // Specify the URL directly
        method: "post",
        data: formdata,
        processData: false, // Prevent jQuery from processing data
        contentType: false, // Prevent jQuery from setting content type
        success: function(data) {
            $("#tabledata").html(data);
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
            // Handle error appropriately
        }
    });
}

getdata();
$('.single-select').change(function(){
	getdata()
	});

	
</script>

<script src="{{asset('public/admin/assets/js/app.js')}}"></script>
@endsection