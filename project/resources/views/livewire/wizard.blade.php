@push('css')
<style>
		    #calendar-container{
		        width: 100%;
		    }
		    #calendar{
		        padding: 10px;
		        width: 100%;
		        height: 554px;
		        border:2px solid black;
		        background: #eaf5ff;
    			color: #000;
		    }

    		.fc-daygrid-event-dot {
	    		margin:0;
	    		border:0!important;
				}
			.fc-event-title {
			    background: #32bf4a;
			    padding: 6px;
			    color: #fff;
			    font-weight: bold;
			    font-size: 14px;
			    text-align: center;
			    display: block;
			    width: 20px;
			    /* height: 20px; */
			}
</style>
@endpush
<div>
	<?php

   $ssts = \App\Models\setting::find(1);

 ?>
		<section class="our-dd" style="background: #121619;">
		<div class="container">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 p-2">
					<div class="headding-part text-center pt-5">
						<!-- <p class="headding-sub">Faire une réservation en ligne</p> -->
						<h2 class="headding-title text-uppercase font-weight-bold" style="color: #fff">RÉSERVER UNE TABLE</h2>
						<!-- <h6 class="customHead pt-3">RÉSERVER UNE TABLE</h6> -->
						<!-- <p class="re_offer">{{$ssts->re_offer}}</p> -->
					</div>
					@if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
             
				</div>
				<div class="col-12 col-md-6 p-0">
		          <div class="bannnerImage">
		            <img src="{{asset('storage/upload/logo')}}/{{$ssts->img_re}}" class="img-fluid" alt="">
		          </div>
				</div>
				<div class="col-12 col-md-6 bg-dd p-0">
		          <div class="main-calendar">
					  <div id='calendar-container' wire:ignore wire:poll>
					    <div id='calendar'></div>
					  </div>
					</div>
				</div>

				<div class="col-12  p-3">
					        @if(!empty($successMsg))
					    <div class="alert alert-success">
					        {{ $successMsg }}
					    </div>
					    @endif
                            <!-- step-1 -->
                        <div class="{{ $currentStep != 1 ? 'display-none' : '' }}" id="step-1">
                         	<div class="form-group">
								<label for="" class="customlabel">Sélectionner Date</label>
								<input type="text" wire:model="date" class="form-control" name="date" placeholder="Sélectionner Date">
							</div>
							<button class="table-book" style="padding:10px; font-size: 14px" wire:click="firstStepSubmit" type="button">Next</button>
                        </div>
						<!-- step-2 -->
					<div class="{{ $currentStep != 2 ? 'display-none' : '' }}" id="step-2"> 
						<!-- <p class="offer_discount">For Booking we offer 30% discount</p> -->
						<div class="form-group">
							<label for="" class="customlabel">Nombre de personnes</label>
							<input type="text" class="form-control" wire:model="numberOfGuest" name="numberOfGuest" placeholder="Nombre de personnes">
						</div>
						<div class="form-group">
							<label for="" class="customlabel">Téléphone</label>
							<input type="text" class="form-control" wire:model="number" placeholder="Téléphone" name="number">
						</div>
						<div class="form-group">
							<label for="" class="col-12 customlabel">Hour*</label>
							<select name="time" class="form-control" wire:model="time" data-placeholder="Hour">
								   <option value="1">--Heure *--</option>
										{!! $ssts->select_timeOp !!}
							</select>
						</div>
						<button class="table-book" style="padding:10px; font-size: 14px"  type="button" wire:click="secondStepSubmit">Next</button>
            <button class="table-book" style="padding:10px; font-size: 14px"  type="button" wire:click="back(1)">Back</button>
					</div>
<!-- step-3 -->
					<div class="{{ $currentStep != 3 ? 'display-none' : '' }}" id="step-3">
						<!-- <p class="offer_discount">For Booking we offer 30% discount</p> -->
						<div class="form-group">
							<label for="" class="customlabel">Nome et prénom</label>
							<input type="text" wire:model="name" class="form-control" placeholder="Nome et prénom" name="name">
						</div>
						<div class="form-group">
							<label for="" class="customlabel">Entrer l'adresse email</label>
							<input type="text" wire:model="email" class="form-control" placeholder="Entrer l'adresse email" name="email">
						</div>

						<div class="form-group">
							<label for="" class="customlabel">Tout message spécial</label>
							<input type="text" wire:model="msg" class="form-control" placeholder="Tout message spécial" name="msg">
						</div>


						<div class="form-group text-center">
							<button wire:click="submitForm" class="table-book" style="padding:1.5rem!important">		Réserver Une Table
							</button>
						</div>
					</div>
					<!-- <a  class="table-book">ddd</a> -->
					<!-- <button class="btn btn-primary" wire:click="hey">dfd</button> -->
				</div>
			</div>
		</div>
	</section>
</div>
@push('js')

    <script>
        document.addEventListener('livewire:load', function() {
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;
            var calendarEl = document.getElementById('calendar');
            var checkbox = document.getElementById('drop-remove');
            var data =   @this.events;
            var calendar = new Calendar(calendarEl, {
            events: JSON.parse(data),
   			dateClick(info)  {
   				@this.eventDataGet(info.dateStr);
                // console.log(info.dateStr)

            },
            editable: true,
            selectable: true,
            displayEventTime: false,
            droppable: true, // this allows things to be dropped onto the calendar
            // drop: function(info) {
            //     // is the "remove after drop" checkbox checked?
            //     if (checkbox.checked) {
            //     // if so, remove the element from the "Draggable Events" list
            //     info.draggedEl.parentNode.removeChild(info.draggedEl);
            //     }
            // },
            eventClick: function (events) {
                let evId = events.event._def.publicId;
                let evDat = events.event.start;

				var someDate = new Date(evDat);
				someDate.setDate(someDate.getDate() + 1); //number  of days to add, e.x. 15 days
				var dateFormated = someDate.toISOString().substr(0,10);

                @this.eventDataGet(dateFormated);

                },

            loading: function(isLoading) {
                    if (!isLoading) {
                        // Reset custom events
                        this.getEvents().forEach(function(e){
                            if (e.source === null) {
                                e.remove();
                            }
                        });
                    }
                }
            });
            calendar.render();
            @this.on(`refreshCalendar`, () => {
                calendar.refetchEvents()
            });

            // $('.fc-daygrid-event-harness').click(function(){
            //     alert();
            // });
        });
    </script>
    
@endpush
