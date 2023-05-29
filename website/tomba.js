var Tomba = new class {
	hover = false;
	shock = false;
	bbox  = {x: 92, y: 94};
	e = document.getElementById('tomba-gif');
	
	mouseCollision(mouse) {
		if (window.innerWidth <= 475 || mouse.x === undefined || mouse.y === undefined) return false;
		var x = window.innerWidth - getComputedStyle(this.e).getPropertyValue('right').replace(/\D/g,'') - this.bbox.x,
		    y = window.innerHeight - this.bbox.y;
		return (
			mouse.x >= x && mouse.x < x + this.bbox.x &&
			mouse.y >= y && mouse.y < y + this.bbox.y
		);
	}
	
	update() {
		if (this.shock) {
			this.e.classList.remove('hover');
			this.e.classList.add('shock');
			this.e.src = 'website/fm3.gif';
		} else if (this.hover) {
			this.e.classList.remove('shock');
			this.e.classList.add('hover');
			this.e.src = 'website/fm2.gif';
		} else {
			this.e.classList.remove('hover', 'shock');
			this.e.src = 'website/fm.gif';
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

window.addEventListener('mousemove', (event) => {
	mouse = {x: event.clientX, y: event.clientY};
	collide = Tomba.mouseCollision(mouse);
	Tomba.setHover(collide);
	if (!collide) Tomba.setShock(false);
});
window.addEventListener('mousedown', (event) => Tomba.setShock(collide && event.button == 0));
window.addEventListener('mouseup', () => Tomba.setShock(false));