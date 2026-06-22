import './bootstrap';

// Smooth image reveal and improved focus styles
document.addEventListener('DOMContentLoaded', () => {
	// Keep keyboard focus outlines for accessibility
	document.body.addEventListener('keyup', (e) => {
		if (e.key === 'Tab') document.documentElement.classList.add('user-is-tabbing');
	});
});

