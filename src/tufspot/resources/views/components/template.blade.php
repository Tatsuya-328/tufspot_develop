<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('image/logo_icon-removebg.png') }}">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- スライドショー --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    {{-- カルーセル --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://unpkg.com/flickity@2.3.0/dist/flickity.css" media="screen"> --}}
    <link href="{{ asset('css/flicky.css') }}" rel="stylesheet">

    {{-- quill editor --}}
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">
    {{-- オリジナル --}}
    <link href="{{ asset('css/style_uru.css') }}" rel="stylesheet">
    <link href="{{ asset('css/post.css') }}" rel="stylesheet">
    {{-- 目次生成 --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/mokuji.css') }}">
    @livewireStyles
</head>

<body class="body">
    <div class="body_wrapper">
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

        <div class="wrapper">
            {{-- slotはx-templateの中でx-breadや他のcomponents読み込む用 --}}
            {{ $slot }}
        </div>

        <script defer src="{{ asset('js/modules/fadeIn.js') }}" type="module"></script>
        <script defer src="{{ asset('js/modules/topCategory.js') }}" type="module"></script>
        <script defer src="{{ asset('js/modules/postDetail.js') }}" type="module"></script>
        <script defer src="{{ asset('js/modules/readMore.js') }}" type="module"></script>
        {{-- カルーセル --}}
        {{-- <script defer  src="https://unpkg.com/flickity@2.3.0/dist/flickity.pkgd.min.js"></script> --}}
        <script defer src="{{ asset('js/flicky.min.js') }}"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script defer src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        {{-- スライドショー --}}
        {{-- <script defer src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> --}}
        <script defer src="{{ asset('js/slick.min.js') }}"></script>


        {{-- quill editor --}}
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        {{-- オリジナル --}}
        <script defer src="{{ asset('js/top.js') }}"></script>
        <script defer src="{{ asset('js/modules/about.js') }}"></script>
        {{-- 目次生成 --}}
        <script defer type="text/javascript" src="{{ asset('js/mokuji.js') }}"></script>

        {{-- Quill記事編集不可表示用 --}}
        <script>
            if (document.getElementById("quill_editor") != null) {
                var quill = new Quill('#quill_editor', {
                    // var quill = new Quill('#editor-container', {
                    modules: {
                        toolbar: [
                            [{
                                header: [1, false]
                            }],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            ['bold', 'underline', 'strike'],
                            [{
                                'align': ['', 'center', 'right']
                            }],
                            ['link', 'image']
                        ]
                    },
                    scrollingContainer: '#scrolling-container',
                    placeholder: 'Compose an epic...',
                    theme: 'bubble',
                    readOnly: true,
                });

                // $('.ql-editor').has('h1')
                $(function() {
                    $('.ql-editor').has('h1').each((i, v) => {
                        $('.mokuji').mokuji({
                            contentspace: '.ql-editor', //見出しタグの入っているボックスを指定
                            titletag: 'h1,h2,h3', //目次に載せたい見出しタグを設定
                            dot: false, //trueにすると行頭に「・」がつく
                            decimal: true //trueにすると見出しの階層状に目次が生成される
                        });
                    });
                });
            }
        </script>

        @livewireScripts
    </div>
</body>

</html>
