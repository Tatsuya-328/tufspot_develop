'use strict';

const fadeElements = document.querySelectorAll('.fade-in');

window.addEventListener('scroll', () => {
    fadeElements.forEach(element => {
        const elementRect = element.getBoundingClientRect();
        const windowHeight = window.innerHeight;

        if (elementRect.top < windowHeight * 0.8) {
            element.classList.add('visible');
        }
    });
});
