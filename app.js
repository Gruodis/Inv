function onRecaptchaSuccess() {
    document.getElementById('contact-form').submit()
}
function isFacebookApp() {
    let ua = navigator.userAgent || navigator.vendor || window.opera;
    return (ua.indexOf("FBAN") > -1) || (ua.indexOf("FBAV") > -1);
}
let test = isFacebookApp();

console.log(test)




const fixFlex = document.getElementsByTagName('h1');

function darom() {
    fixFlex.forEach(el => {
        el.classList.add("wOw");

    });
}
console.log(fixFlex);
if (test === true) {
    document.querySelectorAll('.fixFlex').forEach(img => {
        img.classList.add('showOverlay');

    });
}

else {
    darom();
}

for (var i = 0; i < potentials.length; i++) {
    potentials[i].classList.add('showOverlay');;
}