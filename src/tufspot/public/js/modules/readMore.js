'use strict';

{
    // 仮で記事数増やしてる
    const articleContainers = document.querySelectorAll('.article-container');
    for (let i = 0; i < 15; i++) {
        articleContainers[0].prepend(document.querySelector('.post_card'));
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

    // read moreを押したら何個ずつ記事を表示するかの変数
    let itemsPerClick = 6;

     if (window.innerWidth <= 1199) {
        itemsPerClick = 2;
    } else {
        itemsPerClick = 3;
    }

    // itemsPerClickを画面幅（列数）に応じて変更
    window.addEventListener('resize', () => {
        if (window.innerWidth <= 1199) {
            itemsPerClick = 2;
        } else {
            itemsPerClick = 3;
        }
    });

    {
        let startHiddenNumber = 6;
        if (postCards1[startHiddenNumber] === undefined) {
            featureWrappers[0].querySelector('.blur-back').style.display = 'none';
        } else {
            readMoreButtons[0].addEventListener('click', () => {
                for (let i = 1; i <= itemsPerClick; i++) {
                    if (postCards1[startHiddenNumber] === undefined) {
                        featureWrappers[0].querySelector('.blur-back').style.display = 'none';
                        return;
                    }
                    postCards1[startHiddenNumber].classList.remove('hidden');
                    startHiddenNumber++;
                }
            });
        }

    }
    {
        let startHiddenNumber = 6;
        if (postCards2[startHiddenNumber] === undefined) {
            featureWrappers[1].querySelector('.blur-back').style.display = 'none';
        } else {
            readMoreButtons[1].addEventListener('click', () => {
                for (let i = 1; i <= itemsPerClick; i++) {
                    if (postCards1[startHiddenNumber] === undefined) {
                        featureWrappers[1].querySelector('.blur-back').style.display = 'none';
                        return;
                    }
                    postCards2[startHiddenNumber].classList.remove('hidden');
                    startHiddenNumber++;
                }
            });
        }

    }
    {
        let startHiddenNumber = 6;
        if (postCards3[startHiddenNumber] === undefined) {
            featureWrappers[2].querySelector('.blur-back').style.display = 'none';
        } else {
            readMoreButtons[2].addEventListener('click', () => {
                for (let i = 1; i <= itemsPerClick; i++) {
                    if (postCards1[startHiddenNumber] === undefined) {
                        featureWrappers[2].querySelector('.blur-back').style.display = 'none';
                        return;
                    }
                    postCards2[startHiddenNumber].classList.remove('hidden');
                    startHiddenNumber++;
                }
            });
        }

    }
}
