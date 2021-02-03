const time = document.getElementById('time');

function getTime() {
    var currentDate = new Date();
    var currentHour = currentDate.getHours();
    var currentMinute = (currentDate.getMinutes()<10?'0':'') + currentDate.getMinutes();
    var actualTime = currentHour + ':' + currentMinute;
    time.innerHTML = actualTime;
}
getTime();
setInterval(getTime, 1000);
