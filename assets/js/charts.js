import { CountUp } from 'countup.js';


const bar = document.getElementById('bar');
const done = document.getElementById('nb-done');
const week = document.getElementById('nb-week');

if(done && week) {
    const doneNb = done.innerHTML;
    const weekNb = week.innerHTML;
    const max = 35;
    console.log(doneNb);
    const doneInWeek = (doneNb/weekNb)*max;
    const doneInPercentage = (doneNb/weekNb)*100;

    bar.style.width= doneInWeek + "em";

    const easingFn = function (t, b, c, d) {
        var ts = (t /= d) * t;
        var tc = ts * t;
        return b + c * (tc + -3 * ts + 3 * t);
    }
    const options = {
        duration: 5,
        easingFn,
    };
    let demo = new CountUp('count-up', doneInPercentage, options);
    if (!demo.error) {
        demo.start();
    } else {
        console.error(demo.error);
    }
}