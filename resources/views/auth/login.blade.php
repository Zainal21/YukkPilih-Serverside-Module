@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-8 ">
            @if(session('danger'))
            <div class="alert alert-danger">{{session('danger')}}</div>
            @endif
            <div class="card shadow">
                <div class="card-header">
                   <h2 class="text-center"> login <strong>Yukk Pilih</strong></h2>
                </div>
                <div class="card-body">
                    <form action="{{route('action.login')}}" method="post" class="form-group">
                        @csrf
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('username') is-invalid @enderror">
                        </div>
                        <button class="btn btn-primary" type="submit">Login</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
