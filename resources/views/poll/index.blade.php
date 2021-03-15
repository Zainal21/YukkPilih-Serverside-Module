@extends('layout')
@section('content')

<div class="container">
    @if(auth()->user()->role === 'admin')
    <button class="btn btn-primary btn-create-poll" id="btn-create-poll">+</button>
    <div class="card mt-5 isVisible" id="dialog_box">
        <div class="card-header">Create a new Poll 
            <button class="btn btn-primary float-right" id="btn-cancel" type="button">Cancel</button>
        </div>
        <div class="card-body">
            <div class="card-body">
                <form action="{{route('poll.store')}}" class="form-group" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="">Desciption</label>
                        <textarea name="description" class="form-control" id="" cols="30" rows="10" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Deadline</label>
                        <input type="date" name="deadline" id="deadline" class="form-control" required>
                    </div>
                    <div class="form-input-choice" id="form-input-choice">
                        <div class="form-group">
                            <label for="">Choice</label>
                            <input type="text" name="choices[]" id="input-choice" class="form-control">
                        </div>
                    </div>
                        <a href="" class="nav-link text-black" id="add-input-choice">Add Choice</a>
                    <button class="btn btn-primary" type="submit">Add Poll</button>
                </form>
            </div>
        </div>
    </div>
    @endif
    </div>
        <div class="row justify-content-center mt-5" id="poll_dialog">
            <div class="col-md-6">
              <!-- alert check if user successfully vote -->
            @if(session('status'))
            <div class="alert alert-success">{{session('status')}}</div>
            @endif
            <!-- alert check is deadline and user is vote -->
            @if(session('warning'))
            <div class="alert alert-danger">{{session('warning')}}</div>
            @endif
            @forelse($poll as $item)
                <div class="card shadow mt-4">
                    <div class="card-header">
                    <h2 class="text-center">{{$item->title}}</h2>
                    <p>Deadline : <strong>{{$item->deadline}}</strong> | Created By : <strong>{{$item->creator}}</strong></p>
                    @if(auth()->user()->role == 'admin')
                        <form action="{{route('poll.destroy', $item->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger float-right" type="submit">Delete</button>
                        </form>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="card-title">{{$item->description}}</div>
                        <!-- check user if role user can vote the polling -->
                    @if(auth()->user()->role == 'user' )
                        @foreach($item->choices as $choice)
                        <form
                        action="{{url('poll/'. $item->id .'/vote/'. $choice->id)}}" method="post" class="d-inline">
                        @csrf
                            <input type="hidden" name="poll_id" value="{{$item->id}}">
                            <input type="hidden" name="choices_id" value="{{$choice->id}}">
                            <button class="btn btn-primary mx-2 my-2">{{$choice->choices}}</button>
                        </form>
                        @endforeach
                    @endif    
                
                <!-- check if admin and user isVote show persentage -->
                @if(auth()->user()->role === 'admin' ||  \App\Vote::where('poll_id', $item->id)->where('user_id', auth()->user()->id)->first() || Carbon\Carbon::now()->gte(Carbon::parse($item->deadline)))
                    @foreach($item->choices as $choice)
                <!-- result adalah jumlah point choice dibagi dengan total point di kali 100% -->
                <!-- count choice -->               
                        <?php 
                            $vote = \DB::table('votes')->where(['choices_id' => $choice->id])->sum('point'); // jumlah point choice
                            $all_point = \DB::table('votes')->where(['poll_id' => $item->id])->sum('point'); // jumlah semua point  berdasarkan poll_id
                            $vote && $all_point ? $total = $vote / $all_point * 100 :$total = 0;
                        ?>
                        <div class="progress mt-2">
                            <div class="progress-bar" style="width:{{$total}}%">{{$choice->choices}} {{$total}}%</div>
                        </div>
                    @endforeach
                @endif
                    </div>
                </div>
                @empty
                <div class="card shadow mt-4">
                    <div class="card-header">
                        polling not found
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    @endsection
