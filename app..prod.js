const fixFlex = document.getElementsByClassName('flexFix');
const mata = document.getElementById('mata');
function onRecaptchaSuccess() {
    document.getElementById('contact-form').submit()
}



function isFacebookApp() {
    let ua = navigator.userAgent || navigator.vendor || window.opera;
    return (ua.indexOf("FBAN") > -1) || (ua.indexOf("FBAV") > -1);
}
isFacebookApp();
let test = isFacebookApp();

console.log("test1", test)

if (test === true) {
    mata.innerHTML = "Agnytė <small>ir</small> Aurelijus";
    console.log("test2", test);
    for (var i = 0; i < fixFlex.length; i++) {
        console.log("fix", fixFlex[i])
        fixFlex[i].setAttribute('style', 'display:block !important');
    }
}
