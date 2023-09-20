'use strict';

{
    // メディアコンセプトホバー処理
    window.onload = () => {
        const aboutConceptTitle = document.querySelectorAll('.about-concept-title');
        const hoverTextArea = document.querySelector('.hover-text-area');

        aboutConceptTitle[0].addEventListener('mouseover', () => {
            hoverTextArea.classList.remove('hidden');
            hoverTextArea.classList.add('appear');
        });

        aboutConceptTitle[0].addEventListener('mouseleave', () => {
            hoverTextArea.classList.remove('appear');
            hoverTextArea.classList.add('hidden');
        });

        hoverTextArea.addEventListener('mouseover', () => {
            hoverTextArea.classList.remove('hidden');
            hoverTextArea.classList.add('appear');
        });

        hoverTextArea.addEventListener('mouseleave', () => {
            hoverTextArea.classList.remove('appear');
            hoverTextArea.classList.add('hidden');
        });
    }
}
