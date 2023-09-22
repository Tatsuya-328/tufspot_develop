'use strict';

{
    // メディアコンセプトホバー処理
    window.onload = () => {
        // about以外でエラー出ないように分岐追加
        if (document.querySelector(".hover-text-area") != null) {
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
        }
    }
}
