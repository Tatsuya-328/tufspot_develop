<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2.3.0/dist/flickity.css" media="screen">
    {{-- スライドショー --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    {{-- カルーセル --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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

<body alink=”#0056b3 class="body">
    <div class="wrapper">
        {{-- slotはx-templateの中でx-breadや他のcomponents読み込む用 --}}
        {{ $slot }}
    </div>

    {{-- とりあえずここでフェードインのスクリプト読み込んでる。後で修正する --}}
    <script src="{{ asset('js/modules/fadeIn.js') }}"></script>
    <script src="{{ asset('js/modules/topCategory.js') }}"></script>
    <script src="{{ asset('js/modules/readMore.js') }}"></script>
    {{-- カルーセル --}}
    <script src="https://unpkg.com/flickity@2.3.0/dist/flickity.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    {{-- スライドショー --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    {{-- quill editor --}}
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    {{-- オリジナル --}}
    <script src="{{ asset('js/top.js') }}" async></script>
    <script src="{{ asset('js/modules/about.js') }}" async></script>
    {{-- 目次生成 --}}
    <script type="text/javascript" src="{{ asset('js/mokuji.js') }}"></script>

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
</body>

</html>
