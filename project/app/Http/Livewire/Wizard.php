<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation;
use App\Models\Event;
class Wizard extends Component
{
	 public $currentStep = 1;
    public $name;
    public $email;
    public $numberOfGuest;
    public $number;
    public $date;
    public $time;
    public $msg;
    public $successMsg = '';
    public $events = '';
    public $showDate = true;


    public function getevent()
    {
        $events = Event::select('id','title','start')->get();

        return  json_encode($events);
    }


    public function render()
    {
      $events = Event::select('id','title','start')->get();

        $this->events = json_encode($events);
        return view('livewire.wizard');
    }

    public function eventDataGet($value)
    {

      $this->date = date('y-m-d', strtotime($value));
    }

     /**
     * Write code on Method
     */
    public function firstStepSubmit()
    {
      // dd($this->date);
        $validatedData = $this->validate([
            'date' => 'required',
        ]);
 
        $this->currentStep = 2;
    }
  
    /**
     * Write code on Method
     */
    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'numberOfGuest' => 'required',
            'number' => 'required',
            'time' => 'required',
        ]);
  
        $this->currentStep = 3;
    }
  
    /**
     * Write code on Method
     */


    public function hey()
    {
    	dd('dfjngkjfgn');
    }

    public function submitForm()
    {
    	// dd($this->date);
        // $this->validate($request, [
        //     'name' => 'required',
        //     'numberOfGuest' => 'required',
        //     'number' => 'required',
        //     'date' => 'required',
        //     'time' => 'required'

        // ]);
        $validatedData = $this->validate([
            'name' => 'required',
        ]);


        $reservation = new Reservation();
        $reservation->name = $this->name;
        $reservation->numberOfGuest = $this->numberOfGuest;
        $reservation->email = $this->email;
        $reservation->number = $this->number;
        $reservation->date = $this->date;
        $reservation->time = $this->time;
        $reservation->msg = $this->msg;
        $reservation->save();


        $details = [
                  'title' => 'Mail from Restaurant Raj Mahal',
                  'body' => 'you have just received a reservation form- '. $this->name . ' phone number-'.$this->number,
                  'priority' => 'This is for testing email using smtp',
                  'from' => 'from',
                  'sender' => 'Restaurant Raj Mahal',
                  'to' => 'to',
                  'cc' => 'cc',
                  'bcc' => 'bcc',
                  'replyTo' => 'replyTo',
                  'subject' => 'subject',
                  ];


                  \Mail::to(['info@restaurantrajmahal.fr'])->send(new \App\Mail\OrderMail($details));


  
        $this->successMsg = 'Votre réservation créée avec succès.';
  
        $this->clearForm();
  
        $this->currentStep = 1;
    }
  
    /**
     * Write code on Method
     */
    public function back($step)
    {
        $this->currentStep = $step;    
    }
  
    /**
     * Write code on Method
     */
    public function clearForm()
    {
        $this->name = '';
        $this->price = '';
        $this->detail = '';
        $this->status = 1;
    }
}
