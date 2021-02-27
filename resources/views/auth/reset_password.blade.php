@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-8 ">
            <div class="card shadow">
                <div class="card-header">
                   <h2 class="text-center"> Reset Password <strong>Yukk Pilih</strong></h2>
                </div>
                <div class="card-body">
                    <form action="{{url('/reset')}}" method="post" class="form-group">
                        @csrf
                        <div class="form-group">
                            <label for="">Old Password</label>
                            <input type="password" name="old_password" id="password" class="form-control @error('old_password') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password') 
                            <div class=" invalid-feedback"></div>
                            @enderror
                        </div>
                        <button class="btn btn-primary" type="submit">Reset</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection