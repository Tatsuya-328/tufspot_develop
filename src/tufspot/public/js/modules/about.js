"use strict";
{
    // メディアコンセプトホバー処理
    window.onload = () => {
        // about以外でエラー出ないように分岐追加
        if (document.querySelector(".hover-text-area") != null) {
            const aboutConceptTitle = document.querySelectorAll(
                ".about-concept-title",
            );
            const hoverTextArea = document.querySelector(".hover-text-area");

            var scroll;
            var winH = $(window).height();
            var objTop = $(".about-concept-title").offset().top;

            $(window).on("scroll", function () {
                scroll = $(window).scrollTop();
                if (scroll >= objTop - winH / 2) {
                    hoverTextArea.classList.remove("hidden");
                    hoverTextArea.classList.add("appear");
                } else {
                    hoverTextArea.classList.remove("appear");
                    hoverTextArea.classList.add("hidden");
                }
            });

            // aboutConceptTitle[0].addEventListener("mouseover", () => {
            //     hoverTextArea.classList.remove("hidden");
            //     hoverTextArea.classList.add("appear");
            // });
            // aboutConceptTitle[0].addEventListener("mouseleave", () => {
            //     hoverTextArea.classList.remove("appear");
            //     hoverTextArea.classList.add("hidden");
            // });

            // hoverTextArea.addEventListener("mouseover", () => {
            //     hoverTextArea.classList.remove("hidden");
            //     hoverTextArea.classList.add("appear");
            // });

            // hoverTextArea.addEventListener("mouseleave", () => {
            //     hoverTextArea.classList.remove("appear");
            //     hoverTextArea.classList.add("hidden");
            // });

            // メディアコンセプト、ホバー時テキスト入れ替え
            switchText();

            window.addEventListener("resize", () => {
                switchText();
            });

            function switchText() {
                const hoverText = document.querySelector(".hover-text");
                if (window.innerWidth >= 992) {
                    hoverText.innerHTML =
                        "バラバラであることを楽しみ、そこに新たな視点を見出す。<br>それが当たり前のようにできる外大同窓生に向けたメディア<br>だからこそ、「違う」ことを恐れず、自分たちが見聞きし、<br>考えたことをシェアしよう。";
                } else if (window.innerWidth >= 769) {
                    hoverText.innerHTML =
                        "バラバラであることを楽しみ、<br>そこに新たな視点を見出す。<br>それが当たり前のようにできる<br>外大同窓生に向けたメディアだからこそ、<br>「違う」ことを恐れず、<br>自分たちが見聞きし、考えたことをシェアしよう。";
                } else if (window.innerWidth <= 531) {
                    hoverText.innerHTML =
                        "バラバラであることを楽しみ、<br>そこに新たな視点を見出す。<br>それが当たり前のようにできる<br>外大同窓生に向けたメディア<br>だからこそ、「違う」ことを<br>恐れず自分たちが見聞きし、<br>考えたことをシェアしよう。";
                }
            }
        }
    };
}
