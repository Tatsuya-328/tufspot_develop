"use strict";

import ReadMore from "./ReadMoreClass.js";

// トップページでカテゴリー非表示にしてもjsエラーせずに存在するカテゴリーのみでreadmore動く様にループ処理に修正。
// バグ対応時のために元々のをコメントアウトで残したまま。コメントアウトしてあるのが元々。その真下にループ用書き換え

// articleContainers.forEach((element) => console.log(element));
const articleContainers = document.querySelectorAll(".top_feature_wrapper");

// const postCards1 = articleContainers[0].querySelectorAll(".post_card");
// const postCards2 = articleContainers[1].querySelectorAll(".post_card");
// const postCards3 = articleContainers[2].querySelectorAll(".post_card");
let postCards = [];
articleContainers.forEach(function (element, index) {
    postCards[index] = element.querySelectorAll(".post_card");
});

// デフォルトの記事表示数、3列6記事、2列4記事、1列2記事に変える処理
// addHiddenClass(postCards1);
// addHiddenClass(postCards2);
// addHiddenClass(postCards3);
postCards.forEach(function (element, index) {
    addHiddenClass(element);
});

window.addEventListener("resize", () => {
    // addHiddenClass(postCards1);
    // articleContainers[0].querySelector(".blur-back").style.position =
    //     "absolute";
    // articleContainers[0].querySelector(".blur-back").style.height = "300px";

    // addHiddenClass(postCards2);
    // articleContainers[1].querySelector(".blur-back").style.position =
    //     "absolute";
    // articleContainers[1].querySelector(".blur-back").style.height = "300px";

    // addHiddenClass(postCards3);
    // articleContainers[2].querySelector(".blur-back").style.position =
    //     "absolute";
    // articleContainers[2].querySelector(".blur-back").style.height = "300px";
    postCards.forEach(function (element, index) {
        addHiddenClass(element);
    });

    articleContainers.forEach(function (element, index) {
        element.querySelector(".blur-back").style.position = "absolute";
        element.querySelector(".blur-back").style.height = "300px";
    });
});

// read moreを押したときの処理
// const readMoreButtons1 = articleContainers[0].querySelectorAll(".js-read-more");
// const readMoreButtons2 = articleContainers[1].querySelectorAll(".js-read-more");
// const readMoreButtons3 = articleContainers[2].querySelectorAll(".js-read-more");

let readMoreButtons = [];
articleContainers.forEach(function (element, index) {
    readMoreButtons[index] = element.querySelectorAll(".js-read-more");
});

// const readMore1 = new ReadMore(
//     articleContainers[0],
//     postCards1,
//     readMoreButtons1,
// );
// readMore1.clickReadMore();

// const readMore2 = new ReadMore(
//     articleContainers[1],
//     postCards2,
//     readMoreButtons2,
// );
// readMore2.clickReadMore();

// const readMore3 = new ReadMore(
//     articleContainers[2],
//     postCards3,
//     readMoreButtons3,
// );
// readMore3.clickReadMore();

let readMores = [];
readMoreButtons.forEach(function (element, index) {
    readMores[index] = new ReadMore(
        articleContainers[index],
        postCards[index],
        readMoreButtons[index],
    );
    readMores[index].clickReadMore();
});

function addHiddenClass(postCards) {
    if (window.innerWidth <= 425) {
        postCards.forEach((postCard, index) => {
            if (index <= 1) {
                postCard.classList.remove("hidden");
                return;
            } else {
                postCard.classList.add("hidden");
            }
        });
    } else if (window.innerWidth <= 1199) {
        postCards.forEach((postCard, index) => {
            if (index <= 3) {
                postCard.classList.remove("hidden");
                return;
            } else {
                postCard.classList.add("hidden");
            }
        });
    } else {
        postCards.forEach((postCard, index) => {
            if (index <= 5) {
                postCard.classList.remove("hidden");
                return;
            } else {
                postCard.classList.add("hidden");
            }
        });
    }
}
