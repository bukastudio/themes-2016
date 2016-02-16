
var x = new Date();

//timer 
function display_cf() {
    var refresh = 1000; // Refresh rate in milli seconds
    mytime = setTimeout('display_ctf()', refresh)
}

function display_ctf() {
    var x = new Date();
    $('.footer_timer span').html(x.toDateString() + ', ' +  x.toLocaleTimeString());
    tt = display_cf();
}

display_ctf();
