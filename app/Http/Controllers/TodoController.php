<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Timezone;


class TodoController extends Controller
{
    public function index(){
        $tasks=Todo::where('completed',false)->get()->all();
        return view('todo.create')->with(['tasks'=>$tasks]);

    }
    public function create(Request $request){
        $request->validate([
        'title'=>"required|string|max:50",
        'deadline'=>'required'
        ]);
        $title=$request->title;
        $deadline=$request->deadline;
        Todo::create([
        'title'=>$title,
        'deadline'=>Timezone::convertFromLocal($deadline)
    ]);
    return redirect()->back()->with('success',"Task created successfully");
    }

    public function completed(Request $request){
      
        $request->validate([
        'completed'=>"required|boolean"
        ]);
        $completed=$request->completed;
        $id=$request->id;
        Todo::where('id',$id)->update([
        'completed'=>$completed,
    ]);
      return ['true','Task updated successfully.'];
    }
   
}
