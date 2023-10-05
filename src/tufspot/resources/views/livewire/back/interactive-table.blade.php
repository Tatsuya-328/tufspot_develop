<div>

    {{-- 対象記事のみ表示ボタン --}}
    {{-- 押すとチェックが入っているもの以外をhideする --}}
    {{-- <button type="button">対象記事のみ表示</button> --}}
    <div class="d-flex align-items-center mb-3">
        <div class="me-3">
            <input class="form-check-input" type="checkbox" value="has_checked" name="has_checked" id="checkbox" wire:click="showOnlyChecked">
            <label for="checkbox">選択済み表示</label>
        </div>
        <div class="d-flex align-items-center">
            <input class="form-control me-2" type="text" name="search" value="" id="id_search" />
            <label class="w-100" for="search">項目検索</label>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col" class="text-nowrap">ID</th>
                    <th scope="col" style="width: 15em" class="text-nowrap">タイトル</th>
                    <th scope="col" style="width: 5em" class="text-nowrap">状態</th>
                    <th scope="col" style="width: 10em" class="text-nowrap">カテゴリー</th>
                    <th scope="col" style="width: 10em" class="text-nowrap">特集項目</th>
                    <th scope="col" style="width: 10em" class="text-nowrap">公開日</th>
                    <th scope="col" style="width: 10em" class="text-nowrap">執筆者</th>
                    <th scope="col" style="width: 5em" class="text-nowrap"></th>
                    <th scope="col" style=""></th>
                </tr>
            </thead>

            @if (!$posts->isEmpty())
                <tbody>
                    {{-- Livewireで操作した$add_post_idsをCategoryContorollerに渡すための暫定策 --}}
                    {{-- $postsのforeach内で含めてしまうとPaginateの影響を受けてしまうため、foreach外で回す --}}
                    @foreach ($all_posts as $post)
                        @if (in_array($post->id, old('add_post_ids', $add_post_ids)))
                            <input type="hidden" name="add_post_ids[]" value="{{ $post->id }}">
                        @endif
                    @endforeach
                    @foreach ($posts as $key => $post)
                        <tr>
                            <td>
                                <input type="checkbox" wire:model.live="add_post_ids" value="{{ $post->id }}" id="{{ $post->id }}" class="form-check-input">
                            </td>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->is_public_label }}</td>
                            <td>
                                @foreach ($post->categories as $category)
                                    @if (!$loop->first)
                                        、
                                    @endif
                                    {{ $category->name }}
                                @endforeach
                            </td>
                            <td>
                                @foreach ($post->features as $feature)
                                    @if (!$loop->first)
                                        、
                                    @endif
                                    {{ $feature->name }}
                                @endforeach
                            </td>
                            <td>{{ $post->published_format }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                                {{-- {{ link_to_route('post_detail', '本番確認', $post, [
                                    'class' => 'btn btn-outline-dark btn-sm m-1',
                                    'target' => '_blank',
                                ]) }} --}}
                                {{-- {{ link_to_route('index', '詳細', $post, [
                                    'class' => 'btn btn-secondary btn-sm m-1',
                                    'target' => '_blank',
                                ]) }} --}}
                                {{ link_to_route('back.posts.edit', '編集', $post, [
                                    'class' => 'btn btn-outline-dark btn-sm m-1',
                                ]) }}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="text-decoration-none link-dark pb-3" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                        </svg>
                                    </a>
                                    {{-- <button class="btn btn-secondary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                        </svg>
                                    </button> --}}
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        {{-- <li><a class="dropdown-item" href="#">Action</a></li> --}}
                                        <li><a class="dropdown-item" href="{{ route('post_detail', [$post]) }}">本番確認</a></li>
                                        <li>
                                            {{-- {{ Form::model($post, [
                                                'route' => ['back.posts.destroy', $post],
                                                'method' => 'delete',
                                            ]) }}
                                            {{ Form::submit('削除', [
                                                'onclick' => "return confirm('本当に削除しますか?')",
                                                'class' => 'dropdown-item text-danger',
                                            ]) }}
                                            {{ Form::close() }} --}}
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>
    </div>
    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                {{-- {{ $posts->appends($search)->links() }} --}}
                {{ $posts->links() }}
            </ul>
        </nav>
    </div>

    {{-- <div class="d-flex justify-content-center">
        {{ $posts->appends($search)->links() }}
    </div> --}}

</div>
