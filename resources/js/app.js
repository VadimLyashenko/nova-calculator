require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

var length  = document.getElementById("length")
length.addEventListener('input', updateCalcWeight);

var width  = document.getElementById("width")
width.addEventListener('input', updateCalcWeight);

var height  = document.getElementById("height")
height.addEventListener('input', updateCalcWeight);

var calc_weight  = document.getElementById("calc_weight")

function updateCalcWeight(e) {
    if(length.value && width.value && height.value) {
        var a = length.value * width.value * height.value /5000;
        calc_weight.value = Math.ceil(a * 100) / 100;
    } else {
        calc_weight.value = "";
    }
}

window.onload = function () {
    updateCalcWeight();
}

