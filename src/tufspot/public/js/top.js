//読み込み時の表示
// window_load();

//ウィンドウサイズ変更時に更新
// window.onresize = window_load;

//サイズの表示
// function window_load() {
//   if(document.querySelector(".flickity-slider")) {
//   if (window.innerWidth >= 1440) {
//     document.querySelector(".flickity-slider").style.left= "145px"
//   }
//   else if (window.innerWidth >= 900) {
//     document.querySelector(".flickity-slider").style.left= "9vw"
//   } else if(window.innerWidth >= 800) {
//     document.querySelector(".flickity-slider").style.left= "7vw"
//   }else if(window.innerWidth > 768) {
//       document.querySelector(".flickity-slider").style.left= "4vw"
//     }else if(window.innerWidth <= 768) {
//       document.querySelector(".flickity-slider").style.left= "0vw"
//     }
// }
// document.querySelectorAll(".carousel-cell").forEach(element => element.style.left="0px");
// }

// topslider
$(".slider").slick({
    arrows: false, //左右の矢印はなし
    autoplay: true, //自動的に動き出すか。初期値はfalse。
    autoplaySpeed: 0, //自動的に動き出す待ち時間。初期値は3000ですが今回の見せ方では0
    speed: 6900, //スライドのスピード。初期値は300。
    infinite: true, //スライドをループさせるかどうか。初期値はtrue。
    pauseOnHover: false, //オンマウスでスライドを一時停止させるかどうか。初期値はtrue。
    pauseOnFocus: false, //フォーカスした際にスライドを一時停止させるかどうか。初期値はtrue。
    cssEase: "linear", //動き方。初期値はeaseですが、スムースな動きで見せたいのでlinear
    slidesToShow: 4, //スライドを画面に4枚見せる
    slidesToScroll: 1, //1回のスライドで動かす要素数
    responsive: [
        {
            breakpoint: 769, //モニターの横幅が769px以下の見せ方
            settings: {
                slidesToShow: 2, //スライドを画面に2枚見せる
            },
        },
        {
            breakpoint: 426, //モニターの横幅が426px以下の見せ方
            settings: {
                slidesToShow: 1.5, //スライドを画面に1.5枚見せる
            },
        },
    ],
});
