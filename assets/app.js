// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';
const $ = require('jquery');

require('bootstrap');

//installed with yarn add @fortawesome/fontawesome-free
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

$(window).on('load resize scroll', function(){

    //calculate the image extra length (how many pixels get out of the body
    let maxShift = document.body.clientWidth - document.body.clientHeight * 1.19;

    //in cas the body width is larger than the image - because of resize both have the same size
    if ( document.body.clientWidth / document.body.clientHeight > 1.19) {
        maxShift = 0;
    }

    console.log(maxShift);

    let pageX= $(window).scrollTop();

    let parallaxContainer1= document.querySelector(".parallax-container1");

    let backgroundShiftValue1=-0.15*pageX;
    if (backgroundShiftValue1 < maxShift) backgroundShiftValue1=maxShift;
    console.log("effective shift :"+backgroundShiftValue1);

    let backgroundShift1='right '+backgroundShiftValue1+'px top 0px';
    parallaxContainer1.style.backgroundPosition=backgroundShift1;

});
