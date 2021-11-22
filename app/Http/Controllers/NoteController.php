<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormNoteRequest;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\User;
use Illuminate\Contracts\Session\Session;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        if ($request->session()->get('user') != null) {
            $notes = Note::where('user_id', $request->session()->get('user')->id)->get();
        } else {
            $email = $request->cookie('email');
            $password = $request->cookie('password');
            $user = User::where('email', $email)->where('password', $password)->first();
            $notes = Note::where('user_id', $user->id)->get();
        }

        return view('index', compact('notes'));
    }

    public function add(FormNoteRequest $request)
    {
        $note = new Note();
        $note->content = $request->content;
        if ($request->session()->get('user') != null) {
            $note->user_id = $request->session()->get('user')->id;
        } else {
            $email = $request->cookie('email');
            $password = $request->cookie('password');
            $user = User::where('email', $email)->where('password', $password)->first();
            $note->user_id = $user->id;
        }
        $note->save();

        return redirect()->route('index');
    }

    public function editNoteview($id)
    {
        $note = Note::find($id);
        if ($note == null) {
            return redirect()->route('index');
        }

        return view('editnote', compact('note'));
    }

    public function editNote(FormNoteRequest $request)
    {
        $note = Note::find($request->id);
        $note->content = $request->content;
        $note->save();

        return redirect()->route('index');
    }

    public function deleteNote($id)
    {
        $note = Note::find($id);
        if ($note == null) {
            return redirect()->route('index');
        }
        $note->delete();

        return redirect()->route('index');
    }
}
