$().ready(function () {

    $(document).on('click', 'div.event', function () {
        $(this).find('div.event-description').slideToggle();
    });


    //created new swiper object for the date selection
    //http://www.idangero.us/swiper/api/#.VRsYy_k7uFw
    var mySwiper = new Swiper('.swiper-container', {
        // Optional parameters
        paginationHide: true,
        slidesPerView: 4,
        centeredSlides: true,
        paginationClickable: false,
        freeModeMomentum: true,
        slideToClickedSlide: true
    });




    //Created random values for the price to work with
    for (var i = 0; i < events.length; i++) {
      //  events[i].Price = Math.floor(Math.random() * 6);
      //  events[i].Price = (events[i].Price * 100) / 100;

        //parses start time and converts to an integer
        events[i].StartTime = Number.parseInt(events[i].StartTime.split(':', 1));

        //parses end time
        events[i].EndTime = Number.parseInt(events[i].EndTime.split(':', 1));

        if (events[i].StartTime >= 12) {
            events[i].StartTimeDisplay = (events[i].StartTime - 12) + 'pm';
        } else {
            events[i].StartTime = Number(events[i].StartTime).toString();
            events[i].StartTimeDisplay = events[i].StartTime + 'am';
        }
        if (events[i].EndTime >= 12) {
            events[i].EndTimeDisplay = (events[i].EndTime - 12) + 'pm';
        } else {
            events[i].EndTime = Number(events[i].EndTime).toString();
            events[i].EndTimeDisplay = events[i].EndTime + 'am';
        }
    } 

    //selects the time sort
    $('#sort-time').prop('checked', true);


// Add one more handler for this event
    mySwiper.on('slideChangeEnd', function () {
        $('div.event').remove();
        var eventList = grabDate();
        var listContainer = $('div.events-container');
        var eventContainer = $('div.event');



        //grabs the current sorting button
        var buttonClicked = $('input.sorting-buttons:checked').attr('id');
        console.log(buttonClicked);
        
        switch (buttonClicked) {
            case 'sort-time':
                buttonClicked = 'StartTime';
                break;
            case 'sort-price':
                buttonClicked = 'Price';
                break;
            case 'sort-map':
                buttonClicked = 'Location';
                break;
        }

        eventList = sortFunction(buttonClicked, eventList);
        listEvents(eventList, listContainer, eventContainer);
    });



    //capture the sorting event
    $('input.sorting-buttons').click(function () {
        var buttonClicked = $(this).attr('id');

        switch (buttonClicked) {
            case 'sort-time':
                buttonClicked = 'StartTime';
                break;
            case 'sort-price':
                buttonClicked = 'Price';
                break;
            case 'sort-map':
                buttonClicked = 'Location';
                break;
        }

        //Returns an array of events for selected date.
        var eventList = grabDate();

        //Returns an array of sorted events.
        var sortedEvents = sortFunction(buttonClicked, eventList);

        //creates variables to be used for the view
        var eventContainer = $('div.event');
        var listContainer = $('div.events-container');

        //sends the variables for the view with the new array
        listEvents(sortedEvents, listContainer, eventContainer);
    });




    function grabDate() {
        //grab events. Compare events to selected date. If the event are the same as the selected date, then add the event to an array. Return the array.
        var dateArray = [];
        for (var i = 0; i < events.length; i++) {
            if (events[i].Date == $('.swiper-slide-active .date-hidden').text()) {
                dateArray.push(events[i]);
            }
        }
        return dateArray;
    }


    function compareTime(a, b) {
        if (a.StartTime < b.StartTime)
            return -1;
        if (a.StartTime > b.StartTime)
            return 1;
        return 0;
    }
    //http://stackoverflow.com/users/137902/wogan
    

    function comparePrice(a, b) {
        if (a.Price < b.Price)
            return -1;
        if (a.Price > b.Price)
            return 1;
        return 0;
    }
    //http://stackoverflow.com/users/137902/wogan



    function sortFunction(sortType, sortArray) {
        //create sort array

        //establish sorting type
        for (var i = 0; i < sortArray.length - 1; i++) {
            var swap;
            switch (sortType) {
                case 'StartTime':
//                    if (sortArray[i].StartTime > sortArray[i + 1].StartTime) {
//                        swap = sortArray[i+1];
//                        sortArray[i + 1] = sortArray[i];
//                        sortArray[i] = swap;
//                    }

                    sortArray.sort(compareTime);
                    break;

                case 'Price':
//                    if (sortArray[i].Price > sortArray[i + 1].Price) {
//                        swap = sortArray[i];
//                        sortArray[i + 1] = sortArray[i];
//                        sortArray[i] = swap;
//                    }
                    sortArray.sort(comparePrice);
                    break;
            }
        }
        return sortArray;
    }



    //creates events from array
    function listEvents(array, listContainer, eventContainer) {

        $(eventContainer).remove();
        for (var i = 0; i < array.length; i++) {
            $(listContainer).append('<div class="col-xs-12 col-md-6 event"><div class="col-xs-4 col-md-2 event-img"><img src="' + array[i].Picture + '"' 
                    + 'alt="event" class="img-responsive"></div><div class="col-xs-5 col-md-7 event-title"><h1 class="text-muted event-title">' 
                    + array[i].Title + '</h1></div><div class="col-xs-3 col-md-3 event-info"><p class="event-info event-info-highlight"><span class="glyphicon glyphicon-time"></span>' 
                    + array[i].StartTimeDisplay + '</p><p class="event-info"><span class="glyphicon glyphicon-usd"></span>' 
                    + array[i].Price + '</p><p class="event-info"><span class="glyphicon glyphicon-map-marker"></span>' 
                    + '2mi' + '</p></div><div class="col-xs-12 event-description"><span class="glyphicon glyphicon-time"></span><h2 class="event-time text-muted">' 
                    + array[i].StartTimeDisplay + ' <span>-</span> ' 
                    + array[i].EndTimeDisplay + '</h2><span class="glyphicon glyphicon-map-marker"></span><h2 class="event-location text-muted">' 
                    + array[i].Location + '</h2><p>' 
                    + array[i].Description + '</div></div>');
        }
    }


});