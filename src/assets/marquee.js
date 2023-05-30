const marquee = document.querySelector('.marquee');
const style = document.styleSheets[0];
const rule = [...style.cssRules].find((r) => r.selectorText === 'div.marquee p');
const delay = 160;

var textX = window.getComputedStyle(marquee).getPropertyValue('width').replace(/[^\d.-]/g, ''),
    textW = window.getComputedStyle(marqueeText.firstChild).getPropertyValue('width').replace(/[^\d.-]/g, ''),
    marqueeW = textX;

setInterval(function() {
    marqueeW = window.getComputedStyle(marquee).getPropertyValue('width').replace(/[^\d.-]/g, '');
    textX -= 8;
    if (textX < -textW - delay) textX += parseInt(marqueeW) + parseInt(textW) + delay;
    rule.style.setProperty('transform', 'translateX(' + textX.toString() + 'px)');
}, 100);