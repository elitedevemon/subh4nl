<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shipping;
class ShippingCost extends Component
{
	public  $getOrder;
	public  $geoCodinate;
	public  $totalDistance;
	public  $shippingCost;
	public  $isSHowALert = false;

	public function mount()
	{
		$this->getOrder = session('orderPart');
		// dd($getOrder);
	}
	protected $listeners = ['getLat' => 'getLat'];

	public function getLat($value)
	{
			// $orderPart2 = session()->get('orderPart');
			//   $orderPart = [
	  //               'discount' => 0,
	  //               'grand' => $this->grandTotal,
	  //               'total' => $this->total,
	  //               'qty' => $this->qty,
	  //               'shipping' => $this->shippingCost,
	  //               'orderType' => 'order',
	  //               'lat' => $this->lat,
	  //               'lon' => $this->lon,
	  //           ];
   //      	session()->put('orderPart', $orderPart);
		$this->updatedGeoDala($value);
	}


	public function updatedGeoDala($value)
	{
		$this->geoCodinate = $value;
		$this->getKm();
	}

	public function getKm()
    {

        // dd($this->newGeo);

        $this->shippings = Shipping::all();

        $lat22 = 45.650578548411964;  //shop location 45.650578548411964, 0.15513987877330615
        $lon22 = 0.15513987877330615;  //shop location

        // $lat11 = $arr_ip->lat;  // customer location 22.827662973544577, 91.137449169054
        // $lon11 = $arr_ip->lon;  // customer location  22.825933978212408, 91.10144421866339


        // dd($this->lon);

        // $this->totalDistance = intval($this->distance($this->newGeo[], $lon11, $lat11, $lon11, "K"));
        // $this->totalDistance = 5;
        // $this->totalDistance = intval($this->distance($lat11, $lon11, 22.827662973544577, 91.137449169054, "K"));
        // $this->totalDistance = intval($this->distance($lat11, $lon11, $lat22, $lon22, "K"));

        // $this->totalDistance = 5;

        // dd($this->totalDistance);

        // if ($this->finalGeo != null) {

        $this->totalDistance = intval($this->distance($this->geoCodinate[0], $this->geoCodinate[1], $lat22, $lon22, "K"));

        // }elseif ($this->finalGeo == null) {
        //     $this->totalDistance = 5;
        // }

        // dd($this->totalDistance);

        // $ss = \App\Models\Shipping::where('km', '<', $this->totalDistance)->first();

        // $this->shippingCost = $ss->cost;

        $ss2 = \App\Models\Shipping::where('km', '>=', $this->totalDistance)->orderBy('id', 'asc')->take(1)->get();

                    $cc = count($ss2);

                    if ($cc != 0) {
                        foreach ($ss2 as $key => $value) {
                            if (isset($value->cost)) {
                                $this->shippingCost = $value->cost;
                            }
                          }
                    }else{
                      $this->shippingCost = 00.00;
                    }

        // foreach ($this->shippings as $key => $value) {
        //     // dd(max($this->shippings));

        //         // dd($value->cost);

        //     if($this->totalDistance > $value->km){
        //         $newSC[$key] = $value->km;
        //         // dd('km');
        //         $this->shippingCost =  $value->cost;
        //         // break;
        //     }elseif ($this->totalDistance < $value->km) {
        //             // dd($value->cost);
        //         $this->shippingCost = $value->cost;
        //         // break;
        //     }
        // }

            $orderPart2 = session()->get('orderPart');
			  $orderPart2 = [
	                'discount' => $this->getOrder['discount'],
	                'grand' => $this->getOrder['grand'],
	                'total' => $this->getOrder['total'],
	                'qty' => $this->getOrder['qty'],
	                'shipping' => $this->shippingCost,
	                'orderType' => 'order',
	                'lat' => $this->geoCodinate[0],
	                'lon' => $this->geoCodinate[1],
	                'km' => $this->totalDistance,
	            ];
        	session()->put('orderPart', $orderPart2);
        	$okm = session('orderPart');

                $this->emit('showAlertMsg', $okm['km']);



        // dd($this->shippingCost);
    }

    function distance($lat1, $lon1, $lat2, $lon2, $unit) {
          if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
          }
          else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
              return ($miles * 1.609344);
            } else if ($unit == "N") {
              return ($miles * 0.8684);
            } else {
              return $miles;
            }
          }
        }



    public function render()
    {
        return view('livewire.shipping-cost');
    }
}
