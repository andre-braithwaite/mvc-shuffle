//alert('Found Script!');

var secs = 10;
var timeout;

function countdown() {
    timeout = setTimeout('Decrement()', 1000);
}


function colorchange(seconds)

{

    seconds.style.color="white"

    if (seconds.value == "10") {
        seconds.style.backgroundColor="#4CAF50";
    }

    else if (seconds.value > "6") {
        seconds.style.backgroundColor="#4CAF50";
    }

    else if(seconds.value < "4")
    {
        seconds.style.backgroundColor="red";
    }

    else
    {
        seconds.style.backgroundColor="orange";
    }
}

function Decrement() {
    if (document.getElementById) {
        seconds = document.getElementById("seconds");
        seconds.value = getseconds();


        colorchange(seconds);


    secs--;

    if (secs < 0) {
        secs = 0;
        clearTimeout(timeout);
        return;
    }
    countdown();
    }
}


function getseconds() {
    return secs;
}