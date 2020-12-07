function renderCalendar() {
    $('#calendar').fullCalendar({
        defaultDate: moment(),
        displayEventTime: false,
        defaultView: 'month',
        eventColor: 'green',
        header: {
            left: 'prev, next today',
            center: 'title',
            right: 'month,basicWeek,basicDay',
        },
        navLinks: true, 
        editable: true,
        eventLimit: false, 
        selectable: true,
        eventRender: function(event, element, view){
            if(event.ranges) {
                return (event.ranges.filter(function(range){
                    return (event.start.isBefore(range.end) &&
                        event.end.isAfter(range.start));
                }).length)>0;
            } else {
                return true;
            }
        },
    });
}

function getDay() {
    selectedday = [];
   for(var index=0; index<totaldays.length; index++) {
       if($('#day_' + index).is(':checked')) {
           selectedday.push(index);
       } else {
           selectedday.splice(index);
       }
   }
}

function addEvent() {
    let start = $('#start_date').val();
    let end = $('#end_date').val();
    let title = $('#event_title').val();
    
    getDay();
    if(start == "" || end == "" || title == "" || selectedday.length == 0) {
        toastr.error("Neccessary fields should not be empty");
    } else {
        $.ajax({
            url: SITEURL + '/api/add/event',
            method: 'POST',
            data: {
                title: title,
                start: start,
                end: end,
                dow: selectedday,
            }
        }).then((response) => {
            if(response.data != null) {
                toastr.success(response.message);
                selectedday = JSON.parse("[" + response.data.dow + "]");
                loadEvents();
                var recurrence = [{
                    title: response.data.title,
                    start: '10:00',
                    end: '14:00',
                    dow: selectedday,
                    ranges: [ 
                        {
                            start: moment(response.data.start,'YYYY-MM-DD'),
                            end: moment(response.data.end,'YYYY-MM-DD').endOf('month'),
                        }
                    ],
                }];
                $('#calendar').fullCalendar('addEventSource', recurrence);
            }
        });       
    }
}

function loadEvents() {
    $('#calendar').fullCalendar('removeEvents');
    if(selectedday.length != 0 && event_title != '') {
        $('#calendar').fullCalendar('refetchEvents');
    }
}