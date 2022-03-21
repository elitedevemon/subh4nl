@push('css')
<style>
    #calendar-container{
        width: 100%;
    }
    #calendar{
        padding: 10px;
        margin: 10px;
        width: 100%;
        height: 610px;
        border:2px solid black;
    }
    .main-calendar{
        padding:20px;
    }
</style>
@endpush

<div class="main-calendar">
  <div id='calendar-container' wire:ignore wire:poll>
    <div id='calendar'></div>
  </div>
</div>

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>
    
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
               var title = prompt('Enter Sale Title');
               var date = new Date(info.dateStr + 'T00:00:00');
               if(title != null && title != ''){
                 calendar.addEvent({
                    title: title,
                    start: date,
                    allDay: true
                  });
                 var eventAdd = {title: title,start: date};
                 @this.addevent(eventAdd);
                 alert('Great. Now, update your database...');
               }else{
                alert('Sale Title Is Required');
               }
            },
            editable: true,
            selectable: true,
            displayEventTime: false,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function(info) {
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                // if so, remove the element from the "Draggable Events" list
                info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            },
            // date1Click(info)  { alert(); },
            eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
            // eventClick: info => @this.eventDataDel(info.event, info.oldEvent),
            eventClick: function (events) {
                let evId = events.event._def.publicId;
                // console.log();
                        var deleteMsg = confirm("Do you really want to delete?");
                        if(deleteMsg){
                            @this.eventDataDel(evId);
                        }
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
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
@endpush
