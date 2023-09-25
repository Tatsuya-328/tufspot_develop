'use strict';

{
    for (let i = 0; i < 15; i++) {
        document.querySelector('.article-container').prepend(document.querySelector('.post_card'));
    }
    const featureWrappers = document.querySelectorAll('.top_feature_wrapper');
    const postCards1 = featureWrappers[0].querySelectorAll('.post_card');
    const postCards2 = featureWrappers[1].querySelectorAll('.post_card');
    const postCards3 = featureWrappers[2].querySelectorAll('.post_card');
    const readMoreButtons = document.querySelectorAll('.read-more-button');


    postCards1.forEach((postCard, index) => {
        if (index <= 5) return;

        postCard.classList.add('hidden');
    });

    let startHiddenNumber = 6;

    readMoreButtons[0].addEventListener('click', () => {
        for (let i = 1; i <= 3; i++) {
            if (postCards1[startHiddenNumber] === undefined) {
                featureWrappers[0].querySelector('.blur-back').style.display = 'none';
                return;
            }
            postCards1[startHiddenNumber].classList.remove('hidden');
            startHiddenNumber++;
        }
    });
}
