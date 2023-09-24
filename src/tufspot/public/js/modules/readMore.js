'use strict';

const articleContainers = document.querySelectorAll('.top_feature_wrapper');
const postCards1 = articleContainers[0].querySelectorAll('.post_card');
const postCards2 = articleContainers[1].querySelectorAll('.post_card');
const postCards3 = articleContainers[2].querySelectorAll('.post_card');

// デフォルトの記事表示数、3列6記事、2列4記事、1列2記事に帰る処理
addHiddenClass(postCards1);
addHiddenClass(postCards2);
addHiddenClass(postCards3);
window.addEventListener('resize', () => {
    addHiddenClass(postCards1);
    articleContainers[0].querySelector('.blur-back').style.position = 'absolute';
    articleContainers[0].querySelector('.blur-back').style.height = '300px';
    addHiddenClass(postCards2);
    articleContainers[1].querySelector('.blur-back').style.position = 'absolute';
    articleContainers[1].querySelector('.blur-back').style.height = '300px';
    addHiddenClass(postCards3);
    articleContainers[2].querySelector('.blur-back').style.position = 'absolute';
    articleContainers[2].querySelector('.blur-back').style.height = '300px';
});

// read moreを押したときの処理
const readMoreButtons1 = articleContainers[0].querySelectorAll('.js-read-more');
const readMoreButtons2 = articleContainers[1].querySelectorAll('.js-read-more');
const readMoreButtons3 = articleContainers[2].querySelectorAll('.js-read-more');

// Academiaのread more
readMoreButtons1.forEach(readMoreButton => {
    readMoreButton.addEventListener('click', () => {
        if (window.innerWidth <= 425) {
            const targetElement = articleContainers[0].querySelector('.top_pickup_title_link');
            const redirectLink = targetElement.getAttribute('href');
            window.location.href = redirectLink;
        } else if (window.innerWidth <= 1199) {
            let removeHiddenCount = 0;
            let hasHiddenElement = false;
            postCards1.forEach(postCard => {
                if (postCard.classList.contains('hidden') && removeHiddenCount <= 3) {
                    postCard.classList.remove('hidden');
                    removeHiddenCount++;
                    hasHiddenElement = true;
                }
            });

            if (hasHiddenElement === false) {
                const targetElement = articleContainers[0].querySelector('.top_pickup_title_link');
                const redirectLink = targetElement.getAttribute('href');
                window.location.href = redirectLink;
            }
        } else {
            if (postCards1[postCards1.length - 1].classList.contains('hidden')) {
                postCards1.forEach(postCard => {
                    postCard.classList.remove('hidden');
                });

                articleContainers[0].querySelector('.blur-back').style.position = 'relative';
                articleContainers[0].querySelector('.blur-back').style.height = '100px';
            } else {
                const targetElement = articleContainers[0].querySelector('.top_pickup_title_link');
                const redirectLink = targetElement.getAttribute('href');
                window.location.href = redirectLink;
            }
        }
    });
});

// Businessのread more
readMoreButtons2.forEach(readMoreButton => {
    readMoreButton.addEventListener('click', () => {
        if (window.innerWidth <= 425) {
            const targetElement = articleContainers[1].querySelector('.top_pickup_title_link');
            const redirectLink = targetElement.getAttribute('href');
            window.location.href = redirectLink;
        } else if (window.innerWidth <= 1199) {
            let removeHiddenCount = 0;
            let hasHiddenElement = false;
            postCards2.forEach(postCard => {
                if (postCard.classList.contains('hidden') && removeHiddenCount <= 3) {
                    postCard.classList.remove('hidden');
                    removeHiddenCount++;
                    hasHiddenElement = true;
                }
            });

            if (hasHiddenElement === false) {
                const targetElement = articleContainers[1].querySelector('.top_pickup_title_link');
                const redirectLink = targetElement.getAttribute('href');
                window.location.href = redirectLink;
            }
        } else {
            if (postCards2[postCards2.length - 1].classList.contains('hidden')) {
                postCards2.forEach(postCard => {
                    postCard.classList.remove('hidden');
                });

                articleContainers[1].querySelector('.blur-back').style.position = 'relative';
                articleContainers[1].querySelector('.blur-back').style.height = '100px';
            } else {
                const targetElement = articleContainers[1].querySelector('.top_pickup_title_link');
                const redirectLink = targetElement.getAttribute('href');
                window.location.href = redirectLink;
            }
        }
    });
});

// Culture and Essayのread more
readMoreButtons3.forEach(readMoreButton => {

    readMoreButton.addEventListener('click', () => {
        if (window.innerWidth <= 425) {
            const targetElement = articleContainers[2].querySelector('.top_pickup_title_link');
            const redirectLink = targetElement.getAttribute('href');
            window.location.href = redirectLink;
        } else if (window.innerWidth <= 1199) {
            let removeHiddenCount = 0;
            let hasHiddenElement = false;
            postCards3.forEach(postCard => {
                if (postCard.classList.contains('hidden') && removeHiddenCount <= 3) {
                    postCard.classList.remove('hidden');
                    removeHiddenCount++;
                    hasHiddenElement = true;
                }
            });

            if (hasHiddenElement === false) {
                const targetElement = articleContainers[2].querySelector('.top_pickup_title_link');
                const redirectLink = targetElement.getAttribute('href');
                window.location.href = redirectLink;
            }
        } else {
            if (postCards3[postCards3.length - 1].classList.contains('hidden')) {
                postCards3.forEach(postCard => {
                    postCard.classList.remove('hidden');
                });

                articleContainers[2].querySelector('.blur-back').style.position = 'relative';
                articleContainers[2].querySelector('.blur-back').style.height = '100px';
            } else {
                const targetElement = articleContainers[2].querySelector('.top_pickup_title_link');
                const redirectLink = targetElement.getAttribute('href');
                window.location.href = redirectLink;
            }
        }
    });
});

function addHiddenClass(postCards) {
    if (window.innerWidth <= 425) {
        postCards.forEach((postCard, index) => {
            if (index <= 1) {
                postCard.classList.remove('hidden');
                return;
            } else {
                postCard.classList.add('hidden');
            }
        });
    } else if (window.innerWidth <= 1199) {
        postCards.forEach((postCard, index) => {
            if (index <= 3) {
                postCard.classList.remove('hidden');
                return;
            } else {
                postCard.classList.add('hidden');
            }
        });
    } else {
        postCards.forEach((postCard, index) => {
            if (index <= 5) {
                postCard.classList.remove('hidden');
                return;
            } else {
                postCard.classList.add('hidden');
            }
        });
    }
}
