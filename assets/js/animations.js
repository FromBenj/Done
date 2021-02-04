import AOS from 'aos';
import 'aos/dist/aos.css';
AOS.init();

const time = document.getElementById('time');
if (time) {
    function getTime() {
        var currentDate = new Date();
        var currentHour = currentDate.getHours();
        var currentMinute = (currentDate.getMinutes()<10?'0':'') + currentDate.getMinutes();
        var actualTime = currentHour + ':' + currentMinute;
        time.innerHTML = actualTime;
    }
    getTime();
    setInterval(getTime, 1000);
}

/*
anime({
    targets: '#done-logo path',
    strokeDashoffset: [anime.setDashoffset, 0],
    easing: 'easeInOutSine',
    duration: 2000,
    delay: function(el, i) { return i * 250 },
    direction: 'alternate',
    loop: true
});
*/

const homeContainer = document.getElementsByClassName('home-container');
if (homeContainer) {
    anime({
        targets: '.home-container',
        backgroundColor: '#92afaf',
        easing: 'easeInOutBack',
    }, "3000")
}







