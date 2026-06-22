import './bootstrap';

// Smooth image reveal and improved focus styles
document.addEventListener('DOMContentLoaded', () => {
	// reveal images with .img-fade when loaded
	document.querySelectorAll('img.img-fade').forEach(img => {
		if (img.complete) img.classList.add('loaded');
		else img.addEventListener('load', () => img.classList.add('loaded'));
	});

	// add keyboard focus outlines for interactive elements
	document.body.addEventListener('keyup', (e) => {
		if (e.key === 'Tab') document.documentElement.classList.add('user-is-tabbing');
	});
});

