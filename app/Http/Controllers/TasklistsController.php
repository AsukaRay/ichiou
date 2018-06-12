<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
    
use App\Tasklists;    // add

class TasklistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasklists = Tasklist::all();

        return view('tasklists.index', [
            'tasklists' => $tasklists,
        ]);
    }

// omission

    // "New registration screen display processing" when `messages/create` is accessed with GET
     public function create()
    {
        $tasklist = new Tasklist;

        return view('tasklists.create', [
            'tasklist' => $tasklist,
        ]);
    }

    // "New registration processing" when `messages/` is accessed by POST
 public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:10',   
            'content' => 'required|max:191',
        ]);

        $tasklist = new Tasklist;
        $request->user()->tasklists()->create([
            'content' => $request->content,
            'status' => $request->status,
        ]);


        return redirect('/');
    }

    // "Acquisition display process" when accessing `messages/id` with GET
    public function show($id)
    {
        $tasklist = Tasklist::find($id);

        return view('tasklists.show', [
            'tasklist' => $tasklist,
        ]);
    }


    // "Update screen display processing" when accessing `messages/id/edit` with GET
   public function edit($id)
    {
        $tasklist = Tasklist::find($id);

        return view('tasklists.edit', [
            'tasklist' => $tasklist,
        ]);
    }

    // "Update process" when `s/id` are accessed by PUT or PATCH
  public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|max:10',   // add
            'content' => 'required|max:191',
        ]);


        $tasklist = Tasklist::find($id);
        $tasklist->status = $request->status;    // add
        $tasklist->content = $request->content;
        $tasklist->save();


        return redirect('/');
    }

    // "Delete processing" when `messages/id` is accessed by DELETE
     public function destroy($id)
    {
        $tasklist = Tasklist::find($id);
        $tasklist->delete();

        return redirect('/');
    }
}