@extends('admin.index')

@section('content')
<div class="row">
<div class="col-xl-7 mx-auto">
	<h6 class="mb-0 text-uppercase">Location</h6>
	<hr/>
	<div class="card border-top border-0 border-4 border-primary">
		<div class="card-body p-5">
			<div class="card-title d-flex align-items-center">
				<div><i class="lni lni-map-marker text-primary" style="font-size: 20px;"></i>
				</div>
				<h5 class="mb-0 text-primary">Update Location</h5>
			</div>
			<hr>
			<form class="row g-3 submit-form" action="{{url('updateLocation')}}">
			    @csrf
			    <input type="hidden"  value="{{$location->id}}" name="id"/>
				<div class="col-md-6">
					<label for="inputFirstName" class="form-label">Latitude <span>*</span></label>
					<input type="text" value="{{$location->latitude}}" class="form-control" name="latitude">
				</div>
				<div class="col-md-6">
					<label for="inputLastName" class="form-label">Longitude</label>
					<input type="text" value="{{$location->longitude}}" class="form-control" name="longitude">
				</div>
				<div class="col-12">
					<label for="inputAddress" class="form-label">Distance</label>
					<input class="form-control" value="{{$location->minDistance}}" name="minDistance">
				</div>
				<div class="col-12">
					<button type="submit" class="btn btn-primary px-5">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<script>

</script>
@endsection