<?php
/**
 * @var \App\Models\Category $category
 */
?>
<div class="form-group row">
    {{ Form::label('name', 'カテゴリー名', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
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

<div class="form-group row">
    {{ Form::label('slug', 'スラッグ(URL名)', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{ Form::text('slug', null, [
            'class' => 'form-control' . ($errors->has('slug') ? ' is-invalid' : ''),
            'required',
        ]) }}
        @error('slug')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

<div class="form-group row">
    {{ Form::label('description', '説明文(カテゴリー一覧等に表示)', ['class' => 'col-sm-2 col-form-label']) }}
    <div class="col-sm-10">
        {{ Form::textarea('description', null, [
            'class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),
            'required',
        ]) }}
        @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

@if (0 < $posts->count())
    {{-- 対象記事のみ表示ボタン --}}
    {{-- 押すとチェックが入っているもの以外をhideする --}}
    {{-- <button type="button">対象記事のみ表示</button> --}}
    <div>
        <input type="checkbox" value="has_checked" name="has_checked" id="checkbox">
        <label for="checkbox">選択済みのみ表示</label>
    </div>
    <div>
        <label for="search">項目検索</label>
        <input type="text" name="search" value="" id="id_search" />
    </div>
    <table class="table table-striped table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">ID</th>
                <th scope="col">タイトル</th>
                <th scope="col" style="width: 4.3em">状態</th>
                <th scope="col" style="width: 7em">タグ</th>
                <th scope="col" style="width: 9em">公開日</th>
                <th scope="col">編集者</th>
                <th scope="col" style="width: 12em">編集</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $key => $post)
                <tr>
                    <td>
                        @if (!empty($added_posts))
                            {{ Form::checkbox('add_post_ids[]', $key + 1, in_array($key + 1, old('add_post_ids', $added_posts->pluck('id')->toArray())), ['id' => 'add_post_id' . $key + 1, 'class' => 'form-check-input']) }}
                        @else
                            {{ Form::checkbox('add_post_ids[]', $key + 1), ['id' => 'add_post_id' . $key + 1, 'class' => 'form-check-input'] }}
                        @endif
                    </td>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->is_public_label }}</td>
                    <td>
                        @foreach ($post->tags as $tag)
                            @if (!$loop->first)
                                、
                            @endif
                            {{ $tag->name }}
                        @endforeach
                    </td>
                    <td>{{ $post->published_format }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td class="d-flex justify-content-center">
                        {{ link_to_route('post_detail', '本番ページ', $post, [
                            'class' => 'btn btn-secondary btn-sm m-1',
                            'target' => '_blank',
                        ]) }}
                        {{-- {{ link_to_route('index', '詳細', $post, [
                                    'class' => 'btn btn-secondary btn-sm m-1',
                                    'target' => '_blank',
                                ]) }} --}}
                        {{ link_to_route('back.posts.edit', '編集', $post, [
                            'class' => 'btn btn-secondary btn-sm m-1',
                            'target' => '_blank',
                        ]) }}
                        {{-- {{ Form::model($post, [
                            'route' => ['back.posts.destroy', $post],
                            'method' => 'delete',
                        ]) }}
                        {{ Form::submit('削除', [
                            'onclick' => "return confirm('本当に削除しますか?')",
                            'class' => 'btn btn-danger btn-sm m-1',
                        ]) }}
                        {{ Form::close() }} --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="d-flex justify-content-center">
        {{ $posts->appends($search)->links() }}
    </div> --}}
@endif
<div class="form-group row">
    <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">保存</button>
        {{ link_to_route('back.categories.index', '一覧へ戻る', null, ['class' => 'btn btn-secondary']) }}
    </div>
</div>

<script>
    // 項目検索・チェック判定用
    $(function() {
        $('input#id_search').quicksearch('table tbody tr');
        $("[name='has_checked']").change(function() {
            console.log('hoge');
            $("[name='add_post_ids[]']:not(:checked)").each(function() {
                var v = $(this).parent().parent().toggle();
            });
        });
    });
</script>
