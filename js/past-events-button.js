const past_events_button = document.getElementById('see-past-events');

const past_events_list = document.getElementById('past-events');

let past_events_display = false;

past_events_button.onclick = function() {displayPastEvents()};

function displayPastEvents() {
    if(past_events_display === false){
        past_events_list.style.display = "block";
        past_events_display = true;
    }else if(past_events_display === true){
        past_events_list.style.display='none';
        past_events_display = false;
    }
}