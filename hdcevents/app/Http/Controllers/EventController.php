<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;



class EventController extends Controller{
    public function main() {
        $user = auth()->user();        
        return view('layouts.main', ['user' => $user]);
    }

    public function index() {
        $search = request('search');
        if($search){
            $events = Event::where([
                ['title', 'like', '%'.$search.'%']
            ])->get();
        }else{
            $events = Event::All();
        }
               
        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create(){
        return view('events.create');
    }

    public function store(Request $request){

        $event = new Event;

        $event->title = $request->title;
        $event->cidade = $request->cidade;
        $event->date = $request->date;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->itens = $request->itens;
        

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

        $user = auth()->user();
        $event->user_id = $user->id;
        $event->save();

        return redirect('/')->with('msg', 'Evento Criado');
    }

    public function show($id){

        $event = Event::findOrFail($id);

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();


        return view('events.show', ['event' => $event, 'eventOwner' =>$eventOwner]);
    }

    public function dashboard() {
        $user = auth()->user();

        $events = $user->events;

        //var_dump($events);exit;

        return view('events.dashboard', ['events' => $events]);
    }

    public function destroy($id) {
        Event::findOrFail($id)->delete();

        return redirect('/dasboard')->with('msg', 'Evento excluido com sucesso');
    }

    public function edit($id) {
        $event = Event::findOrFail($id);

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request) {

        $event = Event::findOrFail($request->id);
        $data = $request->all();
        if($request->hasFile('image') && $request->file('image')->isValid()){
               
            unlink(public_path('img/events/' . $event->image));
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);
            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;
        }
        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso');

    }
}
