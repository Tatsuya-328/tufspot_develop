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
                console.log(articleContainers[0].querySelector('.blur-back'))
            } else {
                const targetElement = articleContainers[0].querySelector('.top_pickup_title_link');
                const redirectLink = targetElement.getAttribute('href');
                window.location.href = redirectLink;
            }
        }
    });
})

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

// // 仮で記事数増やしてる
// const articleContainers = document.querySelectorAll('.article-container');
// for (let i = 0; i < 15; i++) {
//     articleContainers[0].prepend(document.querySelector('.post_card'));
// }

// const featureWrappers = document.querySelectorAll('.top_feature_wrapper');
// const postCards1 = featureWrappers[0].querySelectorAll('.post_card');
// const postCards2 = featureWrappers[1].querySelectorAll('.post_card');
// const postCards3 = featureWrappers[2].querySelectorAll('.post_card');
// let readMoreButtons = document.querySelectorAll('.read-more-button');
// let itemsPerClick = 3; // read moreを押したら何個ずつ記事を表示するかの変数

// addHiddenClass();

// window.addEventListener('resize', () => {
//     addHiddenClass();
// });

// // itemsPerClickを画面幅（列数）に応じて変更
// window.innerWidth <= 1199 ? itemsPerClick = 2 : itemsPerClick = 3;
// window.addEventListener('resize', () => {
//     window.innerWidth <= 1199 ? itemsPerClick = 2 : itemsPerClick = 3;
// });

// {
//     let startHiddenNumber = 6;
//     const readMore = new ReadMore(featureWrappers[0], readMoreButtons[0], postCards1);
//     readMore.readMoreClick(itemsPerClick, startHiddenNumber);
// }
// {
//     let startHiddenNumber = 6;
//     if (postCards2[startHiddenNumber] === undefined) {
//         featureWrappers[1].querySelector('.blur-back').style.display = 'none';
//     } else {
//         readMoreButtons[1].addEventListener('click', () => {
//             for (let i = 1; i <= itemsPerClick; i++) {
//                 if (postCards1[startHiddenNumber] === undefined) {
//                     featureWrappers[1].querySelector('.blur-back').style.display = 'none';
//                     return;
//                 }
//                 postCards2[startHiddenNumber].classList.remove('hidden');
//                 startHiddenNumber++;
//             }
//         });
//     }

// }
// {
//     let startHiddenNumber = 6;
//     if (postCards3[startHiddenNumber] === undefined) {
//         featureWrappers[2].querySelector('.blur-back').style.display = 'none';
//     } else {
//         readMoreButtons[2].addEventListener('click', () => {
//             for (let i = 1; i <= itemsPerClick; i++) {
//                 if (postCards1[startHiddenNumber] === undefined) {
//                     featureWrappers[2].querySelector('.blur-back').style.display = 'none';
//                     return;
//                 }
//                 postCards2[startHiddenNumber].classList.remove('hidden');
//                 startHiddenNumber++;
//             }
//         });
//     }

// }

// // PC画面幅の時はデフォ6記事表示。SP画面幅の時はデフォ4記事表示する関数
// function addHiddenClass() {
//     postCards1.forEach((postCard, index) => {
//         if (window.innerWidth <= 1199) {
//             if (index <= 3) {
//                 postCard.classList.remove('hidden');
//                 return;
//             }
//         } else {
//             if (index <= 5) {
//                 postCard.classList.remove('hidden');
//                 return;
//             };
//         }

//         postCard.classList.add('hidden');
//     });
// }

// class ReadMore {
//     constructor(featureWrapper, readMoreButton, postCards) {
//         this.featureWrapper = featureWrapper;
//         this.readMoreButton = readMoreButton;
//         this.postCard = postCards;
//     }

//     readMoreClick(itemsPerClick, startHiddenNumber) {
//         if (this.postCards[startHiddenNumber] === undefined) {
//             this.featureWrapper.querySelector('.blur-back').style.display = 'none';
//         } else {
//             this.readMoreButton.addEventListener('click', () => {
//                 for (let i = 1; i <= itemsPerClick; i++) {
//                     if (this.postCards[startHiddenNumber] === undefined) {
//                         this.featureWrapper.querySelector('.blur-back').style.display = 'none';
//                         return;
//                     }
//                     this.postCards[startHiddenNumber].classList.remove('hidden');
//                     this.startHiddenNumber++;
//                 }
//             });
//         }
//     }
// }
