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
    public function __contruct()
    {
        // call midleware for admin and users
        $this->middleware(['admin'])->only(['destroy', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Poll::with(['choices', 'user'])->orderBy('created_at', 'desc')->get();
        $poll =  PollResource::collection($data);
        return $poll;
        return view('poll.index', ['poll' => $poll]);
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
        Poll::destroy($id);
        return redirect()->back()->with('status', 'Deleted Vote Successfully');
    }
}
