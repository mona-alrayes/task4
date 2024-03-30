
@extends('layouts.app')
@section('content')
<section class="vh-100" style="background-color: #9A616D;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                @if(session('status'))
                <div class="alert alert-success">{{session('status')}}</div>
                @endif
                <form action="{{url('admin/register')}}" method="POST">
                  @csrf
                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Logo</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign Up New Account </h5>
                  
                  <div class="form-outline mb-4">
                    <input type="text" id="form2Example17" class="form-control form-control-lg" value="{{(old('name'))}}" name="name" placeholder="Name"/>
                    @error('name')
                    <span class="text-danger">{{$message}}</span> 
                    @enderror
                  </div>

                  <div class="form-outline mb-4">
                    <input type="email" id="form2Example17" class="form-control form-control-lg " value="{{(old('email'))}}" name="email" placeholder="Email" />
                    @error('email')
                    <span class="text-danger">{{$message}}</span> 
                    @enderror
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="Password" class="form-control form-control-lg" name="password" placeholder="Password"/>
                    @error('password')
                    <span class="text-danger">{{$message}}</span> 
                    @enderror
                 </div>

                 <div class="form-outline mb-4">
                    <input type="password" id="confirmPassword" class="form-control form-control-lg" name="confirm_password" placeholder="Confirm New Password"/>
                    @error('confirm_password')
                    <span class="text-danger">{{$message}}</span> 
                    @enderror
                 </div>

                  <div class="mb-4 ">
                    <input type="radio" id="form2Example2" name="role"  value="1" />
                    <label class="form-label" for="form2Example27">Admin</label>
                    <input type="radio" id="form2Example7" name="role"  value="0" checked />
                    <label class="form-label" for="form2Example27">client</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <input type="submit" class="btn btn-dark btn-lg btn-block" type="button" value="Sign Up">
                    <a class="btn btn-dark btn-lg btn-block" href="{{url('admin')}}" role="button">back</a>
                  </div>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
