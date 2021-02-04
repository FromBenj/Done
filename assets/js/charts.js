const bar = document.getElementById('bar');
const done = document.getElementById('nb-done');
const week = document.getElementById('nb-week');

const doneNb = done.innerHTML;
const weekNb = week.innerHTML;
const max = 35;
const doneInWeek = (doneNb/weekNb)*max;

bar.style.width= doneInWeek + "em";

console.log(doneInWeek)