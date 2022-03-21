<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Event;

class Calendar extends Component
{
    public $events = '';

    public function getevent()
    {       
        $events = Event::select('id','title','start')->get();

        return  json_encode($events);
    }

    /**
    * Write code on Method
    *
    * @return response()
    */ 
    public function addevent($event)
    {
        // dd($event);
        $input['title'] = $event['title'];
        $input['start'] = $event['start'];
        Event::create($input);
    }

    public function eventDataDel($event)
    {
            // $event1 = Event::find($event);
            // dd($event1);
            $events = Event::find($event)->delete();
              return  redirect()->route('calendar');
            // $dd = Event::find($value['id']);
            // $dd->delete();
    }

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function eventDrop($event, $oldEvent)
    {
       
      $eventdata = Event::find($event['id']);
      $eventdata->start = $event['start'];
      $eventdata->save();
       return  redirect()->route('calendar');
    }

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function render()
    {       
        $events = Event::select('id','title','start')->get();

        $this->events = json_encode($events);

        return view('livewire.calendar');
    }
}