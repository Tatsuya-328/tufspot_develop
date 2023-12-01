// ログイン・新規登録ページのボタン処理
$(function () {
    // デフォルトではsubmitボタンはdisabled
    $("#submit_button").prop("disabled", true);

    // 入力欄の操作時
    $("form input:required").keyup(function () {
        let isAllFormsFilled = false;

        // すべての入力必須欄が埋まった場合に、isAllFormsFilledをTrueへ
        $("form input:required").each(function (e) {
            if ($("form input:required").eq(e).val() === "") {
                isAllFormsFilled = true;
            }
        });

        // isAllFormsFilledをそのままdisabledの付与判定に使用
        // すべてのすべての入力必須欄が埋まった場合にdisabledが外れる
        $("#submit_button").prop("disabled", isAllFormsFilled);
    });
});

// vueは使わないから全選択コメントアウト

// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

// import './bootstrap';
// import { createApp } from 'vue';

// /**
//  * Next, we will create a fresh Vue application instance. You may then begin
//  * registering components with the application instance so they are ready
//  * to use in your application's views. An example is included for you.
//  */

// const app = createApp({});

// import ExampleComponent from './components/ExampleComponent.vue';
// app.component('example-component', ExampleComponent);

// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
//  */

// // Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
// //     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// // });

// /**
//  * Finally, we will attach the application instance to a HTML element with
//  * an "id" attribute of "app". This element is included with the "auth"
//  * scaffolding. Otherwise, you will need to add an element yourself.
//  */

// app.mount('#app');
