<x-template>
    <x-slot name="title"> TUFSPOT_mypage </x-slot>
    <x-header />
    <x-post_list_title class="unset-shadow" listTitle="マイページ" />
    <x-main>
        <!--マイページ（アカウント情報）ここから-->
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
                            <p>TUFSPOT ID：{{ $user->tufspot_id }}</p>
                            <p>電話番号：{{ $user->gaigokaiMembers[0]['phone_number'] }}</p>
                            <p>メールアドレス：{{ $user->email }}</p>
                            <p>外語会ID：{{ $user->gaigokaiMembers[0]['id'] }}</p>
                            {{-- <p>パスワード：XXXXXXX</p> --}}
                        </div>
                        <div>
                            {{-- <a href="#" class="mypage-button">パスワードを変更する</a> --}}
                            {{-- モーダル開くボタン --}}
                            <a type="button" class="mypage-button" data-bs-toggle="modal" data-bs-target="#mypageModal">
                                ユーザー情報を変更する
                            </a>
                        </div>
                    </div>
                </div>
                <div id="panel2" class="tab_panel2">
                    <livewire:paginated-post-list :user="$user" page_flag="mypage" />
                </div>
                <div id="panel3" class="tab_panel3">
                    <livewire:paginated-post-list :user="$user" page_flag="history" />
                </div>
                <div id="panel4" class="tab_panel4">
                    <livewire:following-writer-list :user="$user" />
                </div>
            </div>
        </div>
        {{-- マイページここまで --}}
        {{-- アラート用 --}}
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>
        {{-- モーダルここから --}}
        <div class="modal fade" id="mypageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="mypageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mypageModalLabel">ユーザー情報変更</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {!! Form::model($user, [
                            'route' => ['update', $user['id']],
                            'method' => 'put',
                            'files' => true,
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="form-group ">
                            {{ Form::label('name', '名前', ['class' => 'col-form-label']) }}
                            <div class="">
                                <input type="hidden" name="id" value="{{ $user->gaigokaiMembers[0]['id'] }}" />
                                <input type="hidden" name="user_id" value="{{ $user['id'] }}" />

                                {{ Form::text('name', null, [
                                    'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                                    'required',
                                ]) }}
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            {{ Form::label('phone_number', '電話番号', ['class' => 'col-form-label']) }}
                            <div class="">
                                {{ Form::text('phone_number', null, [
                                    'class' => 'form-control' . ($errors->has('phone_number') ? ' is-invalid' : ''),
                                    'required',
                                ]) }}
                                @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            {{ Form::label('email', 'メールアドレス', ['class' => 'col-form-label']) }}
                            <div class="">
                                {{ Form::email('email', null, [
                                    'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                                    'required',
                                ]) }}
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            {{ Form::label('password', 'パスワード', ['class' => 'col-form-label']) }}
                            <div class="">
                                {{ Form::password('password', [
                                    'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                                ]) }}
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group ">
                            {{ Form::label('password_check', 'パスワード確認', ['class' => 'col-form-label']) }}
                            <div class="">
                                {{ Form::password('password_check', [
                                    'class' => 'form-control' . ($errors->has('password_check') ? ' is-invalid' : ''),
                                ]) }}
                                @error('password_check')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="alert alert-warning d-flex align-items-center mt-3" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                                <use xlink:href="#exclamation-triangle-fill" />
                            </svg>
                            <div>
                                ・電話番号は外語会に登録、申請しているものと同じ事を確認してください。<br>
                                ・外語会IDは編集できません。
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        {{-- モーダルここまで --}}
    </x-main>
    <x-footer />
</x-template>
