<div class="card-body">
		<div class="" >
		<table id="example2" class="table table-striped table-bordered">
        	<thead>
        		<tr>
        			<th>Name</th>
        			<th>Date</th>
        			<th>Time</th>
        			<th>Activity</th>
        		</tr>
        	</thead>
        	<tbody>
        	  @foreach($attendance as $data)
        		<tr role="row" class="odd">
        			<td class="sorting_1">{{$data->user->name}}</td>
        		    <td>{{ \Carbon\Carbon::parse($data->dateToday)->format('d-m-Y') }}</td>
        		    <td>{{ \Carbon\Carbon::parse($data->dateToday)->format('h:i A') }}</td>
        			<td>{{$data->activity}}</td>
        		</tr>
        		@endforeach
        	</tbody>
        </table>
	</div>
</div>
<script src="{{asset('public/admin/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
<script> 
    var table = $('#example2').DataTable( {
    	lengthChange: false,
    	buttons: [
            { extend: 'csv', exportOptions: { modifier: {page: 'all'} } },
            { extend: 'excel', exportOptions: { modifier: {page: 'all'} } },
            { extend: 'pdf', exportOptions: { modifier: {page: 'all'} } }
        ]
    } );
    
    table.buttons().container()
    	.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
	
</script>