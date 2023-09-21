<x-template>
    <x-slot name="title"> TUFSPOT_mypage </x-slot>
    {{-- タイトル位置はcomponentsで呼び出したい --}}
    <x-header />
    <x-article_list_title class="unset-shadow" listTitle="マイページ" />
    <x-main>
        {{-- <div class="row row-cols-3"> --}}
        <!--アカウント情報-->
        <div class="tab_wrap">
            <input id="tab1" type="radio" name="tab_btn" checked>
            <input id="tab2" type="radio" name="tab_btn">
            <input id="tab3" type="radio" name="tab_btn">
            <input id="tab4" type="radio" name="tab_btn">
            <div class="tab_area">
                <label class="tab1_label" for="tab1">ユーザー情報</label>
                <label class="tab2_label" for="tab2">保存記事一覧</label>
                <label class="tab3_label" for="tab3">閲覧履歴</label>
                <label class="tab4_label" for="tab4">フォロー済みライター</label>
            </div>
            <div class="panel_area">
                <div id="panel1" class="tab_panel1">
                    <div class="d-flex flex-wrap flex-column justify-content-center align-content-center">
                        <div class="user-info-text">
                            <p>名前：{{ $user->name }}</p>
                            <p>電話番号：{{ $user->gaigokaiMembers[0]['phone_number'] }}</p>
                            <p>メールアドレス：{{ $user->email }}</p>
                            <p>外語会ID：{{ $user->gaigokaiMembers[0]['id'] }}</p>
                            <p>パスワード：XXXXXXX</p>
                        </div>
                        <div>
                            <a href="#" class="mypage-button">パスワードを変更する</a>
                        </div>
                    </div>
                </div>
                <div id="panel2" class="tab_panel2">
                    <div class="d-flex justify-content-center flex-wrap">
                        <x-article_card place="ハロン湾" />
                        <x-article_card place="スイティエン" />
                        <x-article_card place="アンコールワット" />
                        <x-article_card place="ハロン湾" />
                        <x-article_card place="スイティエン" />
                        <x-article_card place="アンコールワット" />
                    </div>
                </div>
                <div id="panel3" class="tab_panel3">
                    <div class="d-flex justify-content-center flex-wrap">
                        <x-article_card place="ハロン湾" />
                        <x-article_card place="スイティエン" />
                        <x-article_card place="アンコールワット" />
                        <x-article_card place="ハロン湾" />
                        <x-article_card place="スイティエン" />
                        <x-article_card place="アンコールワット" />
                    </div>
                </div>
                <div id="panel4" class="tab_panel4">
                    <div class="d-flex justify-content-center flex-wrap">
                        <x-writer_card />
                        <x-writer_card />
                        <x-writer_card />
                        <x-writer_card />
                        <x-writer_card />
                        <x-writer_card />
                    </div>
                </div>
            </div>
        </div>
    </x-main>
    <x-footer />
</x-template>
