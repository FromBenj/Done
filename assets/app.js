/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

//Bootstrap
const $ = require('jquery');
require('bootstrap');

//js files
require('./js/anime.min');
require('./js/buttons');
require('./js/charts');
require('./js/animations');

//Swup
import Swup from 'swup';
import SwupOverlayTheme from '@swup/overlay-theme';

const swup = new Swup({
    plugins: [
        new SwupOverlayTheme({
            color: '#d5ebeb'
        })
    ]
});





