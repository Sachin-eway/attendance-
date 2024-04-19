@extends('admin.index')

@section('content')
<div class="row">
	<div class="col-xl-9 mx-auto">
		<div class="card border-top border-0 border-4 border-info">
			<div class="card-body">
				<div class="border p-4 rounded">
					<div class="card-title d-flex align-items-center">
						<div><i class="bx bxs-user me-1 font-22 text-info"></i>
						</div>
						<h5 class="mb-0 text-info">Employee Registration</h5>
					</div>
					<hr/>
					<form action="{{url('addEmployee')}}" method="POST">
					    @csrf
					<div class="row mb-3">
						<label for="inputEnterYourName" class="col-sm-3 col-form-label">Employee Name</label>
						<div class="col-sm-9">
							<input type="text" value="{{old('name')}}" class="form-control" id="inputEnterYourName" name="name" placeholder="Enter Name">
							@error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
					</div>
					<div class="row mb-3">
						<label for="inputPhoneNo2" class="col-sm-3 col-form-label">Phone No</label>
						<div class="col-sm-9">
							<input type="text" value="{{old('phone')}}" class="form-control" id="inputPhoneNo2" name="phone" placeholder="Phone No">
							 @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                             @enderror
						</div>
					</div>
					<div class="row mb-3">
						<label for="inputEmailAddress2" class="col-sm-3 col-form-label">Email Address</label>
						<div class="col-sm-9">
							<input type="email" value="{{old('email')}}" class="form-control" name="email" id="inputEmailAddress2" placeholder="Email Address">
							 @error('email')
                                <span class="text-danger">{{ $message }}</span>
                             @enderror
						</div>
					</div>
					<div class="row mb-3">
						<label for="inputChoosePassword2" class="col-sm-3 col-form-label">Password</label>
						<div class="col-sm-9">
							<input type="text"  class="form-control" id="inputChoosePassword2" name="password" placeholder="Password">
							 @error('password')
                                <span class="text-danger">{{ $message }}</span>
                             @enderror
						</div>
					</div>
					<!--<div class="row mb-3">-->
					<!--	<label for="inputConfirmPassword2" class="col-sm-3 col-form-label">Confirm Password</label>-->
					<!--	<div class="col-sm-9">-->
					<!--		<input type="email" class="form-control" id="inputConfirmPassword2" placeholder="Confirm Password">-->
					<!--	</div>-->
					<!--</div>-->
					<div class="row mb-3">
						<label for="inputAddress4" class="col-sm-3 col-form-label">Address</label>
						<div class="col-sm-9">
							<textarea class="form-control"  id="inputAddress4" rows="3" name="address" placeholder="Address"></textarea> 
						 @error('address')
                            <span class="text-danger">{{ $message }}</span>
                         @enderror
						</div>
						
					</div>
				
					<div class="row">
						<label class="col-sm-3 col-form-label"></label>
						<div class="col-sm-9">
							<button type="submit" class="text-light btn btn-info px-4">Register</button>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
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
    
    @if (session()->has('error'))
        Toast.fire({
          icon: "error",
          title: "{{session()->get('error')}}"
        });
   @endif
</script>
@endsection