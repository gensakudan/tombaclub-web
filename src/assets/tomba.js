var Tomba = new class {
	hover = false;
	shock = false;
	bbox  = document.getElementById('tomba-gif');
	e     = this.bbox.childNodes[0];
	
	update() {
		if (this.shock) {
			this.e.classList.remove('hover');
			this.e.classList.add('shock');
			this.e.src = '/assets/img/fm3.gif';
		} else if (this.hover) {
			this.e.classList.remove('shock');
			this.e.classList.add('hover');
			this.e.src = '/assets/img/fm2.gif';
		} else {
			this.e.classList.remove('hover', 'shock');
			this.e.src = '/assets/img/fm.gif';
		}
	}
	
	setHover(state) {
		if (this.hover != state) {
			this.hover = state;
			this.update();
		}
	}
	
	setShock(state) {
		if (this.shock != state) {
			this.shock = state;
			this.update();
		}
	}
}

var mouse = {x: undefined, y: undefined};
var collide = false;

Tomba.bbox.addEventListener('mouseenter', () => {
	collide = true;
	Tomba.setHover(true);
});
Tomba.bbox.addEventListener('mouseleave', () => {
	collide = false;
	Tomba.setHover(false);
	Tomba.setShock(false);
});
window.addEventListener('mousedown', (event) => Tomba.setShock(collide && event.button == 0));
window.addEventListener('mouseup', () => Tomba.setShock(false));
