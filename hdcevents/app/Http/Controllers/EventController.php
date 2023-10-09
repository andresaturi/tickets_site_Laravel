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
        return view('welcome');
    }

    public function produtos() {
        $search = request('search');
        $user = auth()->user();
        if($search){
            $events = Event::where([
                ['title', 'like', '%'.$search.'%'],
                ['user_id', '=', $user->id],
            ])->get();
        }else{
            $events = Event::where('user_id', $user->id)->get();;
        }
               
        return view('events.produtos', ['events' => $events, 'search' => $search]);
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

        $user = auth()->user();
        $hasUserjoined = false;
        $userEvents = $user->eventsAsParticipant->toArray();
        if($user){            
            foreach($userEvents as $userEvent){
                if($userEvent['id'] == $id){
                    $hasUserjoined = true;
                }
            }
        }
        $event = Event::findOrFail($id);
        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', [
            'event' => $event, 
            'eventOwner' =>$eventOwner,
            'hasUserJoined' => $hasUserjoined
        ]);
    }

    public function dashboard() {
        $user = auth()->user();

        $events = $user->events;       

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.dashboard', 
        ['events' => $events, 'eventasparticipant' => $eventsAsParticipant]);
    }

    public function destroy($id) {
        Event::findOrFail($id)->delete();

        return redirect('/dasboard')->with('msg', 'Evento excluido com sucesso');
    }

    public function edit($id) {

        $user = auth()->user();
        $event = Event::findOrFail($id);
        if($user->id != $event->user->id){
            return redirect('/dashboard');
        }else{
            return view('events.edit', ['event' => $event]);
        }        
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
    
    public function joinEvent($id) {
        $user = auth()->user();
        $user->eventsAsParticipant()->attach($id);
        $event = Event::findOrFail($id);
    
        return redirect('/dashboard')->with('msg', 'Sua presença foi confirmada no evento!');
    }

    public function leaveEvent($id){
        $user = auth()->user();
        $user->eventsAsParticipant()->detach($id);
        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença foi Removida do evento!');
    }
    
}
