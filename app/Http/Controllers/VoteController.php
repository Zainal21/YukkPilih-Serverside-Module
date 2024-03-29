<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\Choice;
use App\Vote;
use Carbon\Carbon;

class VoteController extends Controller
{

    public function __contruct()
    {
        $this->middleware(['user']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vote( Request $request,$poll_id,$choice_id)
    {
        // get poll and choice
        $poll = Poll::where(['id' => $poll_id])->first();
        $choice = Choice::where(['id' => $choice_id])->first();
        // get isvote user
        $isVote = Vote::where([
            'user_id' => auth()->user()->id,
            'poll_id' => $poll->id
        ])->first();

        // check is Admin
        if(auth()->user()->role == 'admin'){
            return redirect()->back()->with('warning', 'You cannot vote this polling, because your role is admin');
        }
        // check user isVote
        if($isVote){
            return redirect()->back()->with('warning', 'You Already vote');
        }
        // check deadline using carbon
        if(Carbon::now()->gte(Carbon::parse($poll->deadline))) {
            return redirect()->back()->with('warning', 'Voting Deadline');
        }
        // created vote
        // return $request;
       $data  =  vote::create([
            'choices_id' => $choice->id,
            'user_id' => auth()->user()->id,
            'poll_id' => $poll->id,
            'division_id' => auth()->user()->division_id,
            'point' => 1
        ]);
        return redirect()->back()->with('status' , 'Voting Successfully');
    }
}
