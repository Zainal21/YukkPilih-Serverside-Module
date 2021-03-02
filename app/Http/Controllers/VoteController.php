<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\Choice;
use App\Vote;
use Carbon;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vote( Request $request,$poll_id,$choice_id)
    {

        // return $request;
        // check is Admin
        if(auth()->user()->role == 'admin'){
            return redirect()->back()->with('warning', 'You cannot vote this polling, because your role is admin');
        }

        $poll = Poll::where(['id' => $poll_id])->first();
        $choice = Choice::where(['id' => $choice_id])->first();

        $isVote = Vote::where([
            'user_id' => auth()->user()->id,
            'poll_id' => $poll->id
        ])->first();
        if($isVote){
            return redirect()->back()->with('warning', 'You Already vote');
        }
        // check deadline
        if(\Carbon::parse($poll->deadline)->isAftrer(now())){
            return redirect()->back()->with('status', 'Voting deadline');
        }
        // created vote
        // return $request;
       $data  =  vote::create([
            'choices_id' => $choice->id,
            'user_id' => auth()->user()->id,
            'poll_id' => $poll->id,
            'division_id' => auth()->user()->division_id
        ]);
        return redirect()->back()->with('status' , 'Voting Successfully');
    }

 
}
