const marquee = document.querySelector('.marquee');
const rule    = [...document.styleSheets[0].cssRules].find((r) => r.selectorText === 'div.marquee p');
const delay   = 160;
const textW   = window.getComputedStyle(marquee.firstChild).getPropertyValue('width').replace(/[^\d.-]/g, '');
const marqGetWidth = () => window.getComputedStyle(marquee).getPropertyValue('width').replace(/[^\d.-]/g, '');

var textX = marqueeW = marqGetWidth();

setInterval(function() {
    marqueeW = marqGetWidth();
    textX -= 8;
    if (textX < -textW - delay) textX += parseInt(marqueeW) + parseInt(textW) + delay;
    rule.style.setProperty('left', textX.toString() + 'px');
}, 100);
