<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;



class EventController extends Controller{
    public function index() {
        $events = Event::All();

        return view('welcome', ['events' => $events]);
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){

        $event = new Event;

        $event->title = $request->title;
        $event->cidade = $request->cidade;
        $event->private = $request->private;
        $event->description =$request->description;

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()){
               
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);
            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;
        }else{
            $event->image = 'null.png';
        }

        $event->save();

        return redirect('/')->with('msg', 'Evento Criado');
    }

    public function show($id){

        $event = Event::findOrFail($id);

        return view('events.show', ['event' => $event]);
    }
}
