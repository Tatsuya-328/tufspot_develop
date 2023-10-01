'use strict';

if (/\/post\/*/.test(window.location.pathname)) {
    // 実行したいコードをここに書く
    console.log(document.querySelector('.wrapper'))
    document.querySelector('.wrapper').classList.add('post-page');
}
