<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('products.index') }}"
               class="text-blue-600 hover:underline">← 一覧に戻る</a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 max-w-2xl">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">商品登録</h1>

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="bg-blue-50 border border-blue-200 p-3 rounded mb-4">
                    <p class="text-xs text-gray-700 mb-1"><strong>💡 csrf とは？</strong></p>
                    <p class="text-xs text-gray-600">
                        <code>csrf</code> は <strong>CSRF（クロスサイトリクエストフォージェリ）攻撃</strong>から守るためのトークンです。<br>
                        Laravelでは、POST/PUT/DELETE リクエストを送信する全てのフォームに<strong>必須</strong>です。<br>
                        このトークンがないと、フォーム送信時に<strong>419エラー</strong>が発生します。
                    </p>
                </div>

                <!-- 商品名 -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        商品名 <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name"
                    value="{{ old('name') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>

                    <div class="bg-green-50 border border-green-200 p-2 rounded mt-2 text-xs">
                        <strong>💡 old('name') とは？</strong><br>
                        バリデーションエラーが発生した時、<strong>入力した値を保持</strong>してくれます。<br>
                        これがないと、エラー時に全ての入力内容が消えてしまいます。
                    </div>

                    @if($errors->has('name'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('name') }}</p>
                    @endif

                    <div class="bg-yellow-50 border border-yellow-200 p-2 rounded mt-2 text-xs">
                        <strong>💡 $errors->has('name') とは？</strong><br>
                        バリデーションエラーが発生した時のみ、エラーメッセージを表示します。<br>
                        <code>$errors->first('name')</code> には、コントローラで設定したエラーメッセージが入ります。
                    </div>
                </div>

                <!-- カテゴリー -->
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                        カテゴリー <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" id="category_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="">選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('category_id'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('category_id') }}</p>
                    @endif
                </div>

                <!-- 価格 -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                        価格（円） <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="price" id="price"
                    value="{{ old('price') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required min="0">
                    @if($errors->has('price'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('price') }}</p>
                    @endif
                </div>

                <!-- 在庫数 -->
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                        在庫数 <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="stock" id="stock"
                           value="{{ old('stock', 0) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required min="0">
                    @if($errors->has('stock'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('stock') }}</p>
                    @endif
                </div>

                <!-- 説明 -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        説明
                    </label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
                    @if($errors->has('description'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('description') }}</p>
                    @endif
                </div>

                <!-- 公開状態 -->
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_published" value="1"
                               {{ old('is_published', true) ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700">公開する</span>
                    </label>
                </div>

                <div class="flex space-x-3">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                        登録
                    </button>
                    <a href="{{ route('products.index') }}"
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded inline-block">
                        キャンセル
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>