<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;
use App\Tag;
use App\ThreadFilters;
use Illuminate\Support\Facades\Input;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

 public function __construct()
    {
        return $this->middleware('auth')->except('index');
    }

    public function index(ThreadFilters $filters)
    {
      // $tags= Tag::all();
        $threads=Thread::filter($filters)->paginate(15);

        return view('thread.index', compact('threads','tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      // $tags= Tag::all();
        return view('thread.create',compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|min:5',
            'tags'    => 'required',
            'thread'  => 'required|min:10',
//            'g-recaptcha-response' => 'required|captcha'
        ]);

        //store
        $thread = auth()->user()->threads()->create($request->all());

        $thread->tags()->attach($request->tags);

        //redirect
        return back()->withMessage('Thread Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        return view('thread.single', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        return view('thread.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {


       $this->authorize('update', $thread);
        //validate
        $this->validate($request, [
            'subject' => 'required|min:10',
            'type'    => 'required',
            'thread'  => 'required|min:20'
        ]);


        $thread->update($request->all());

        return redirect()->route('thread.show', $thread->id)->withMessage('Thread Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {

       $this->authorize('update', $thread);

        $thread->delete();

        return redirect()->route('thread.index')->withMessage("Thread Deleted!");
    }
}
