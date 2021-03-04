<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poll;
use App\Choice;
use App\Vote;
use Auth;
use App\Http\Resources\PollResource;
class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return  PollResource::collection(Poll::with(['choices','user'])->get());
    //    return Vote::where([
    //         'user_id' => auth()->user()->id,
    //         'poll_id' => 1
    //     ])->first();
        // return ( Poll::with(['choices','user'])->get());
        return view('poll.index', ['poll' => Poll::with(['choices'])->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('poll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request;
        // dd($request);
        $request->validate([
            'title' => 'string|required',
            'description' => 'string|required',
            'deadline' => 'date|required',
        ]);
        // created poll
        // $data = $request->all();
        $poll = Poll::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'created_by'  => auth()->user()->id
        ]);
        // dd($poll);
        // created choice
        foreach($request->choices as $choice){
            Choice::create([
                'poll_id' => $poll->id,
                'choices' => $choice
            ]);
        }
        return redirect()->route('poll.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('poll.show', ['poll' => Poll::with('choices')->finOrfail($id)]);
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(\Auth::user()->role !== 'admin'){
            return redirect()->back()->with('status', 'Cannot deleted vote because your not admin');
        }
        Poll::destroy($id);
        return redirect()->back()->with('status', 'Deleted Vote Successfully');
    }
}
