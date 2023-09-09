'use strict';

const nextButton = document.querySelector('.next');

setTimeout(() => {
    const clickEvent = new Event('click');
    nextButton.dispatchEvent(clickEvent);
}, 3000);
