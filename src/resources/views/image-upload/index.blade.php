<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-6xl mx-auto p-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">商品一覧</h1>
            <a href="/image-upload/create" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg">
                新規登録
            </a>
        </div>

        {{-- 成功メッセージ --}}
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        {{-- 商品一覧（グリッド表示） --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition">
                {{-- 画像表示 --}}
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500 text-sm">画像なし</span>
                    </div>
                @endif

                {{-- 商品情報 --}}
                <div class="p-4">
                    <h3 class="font-bold text-xl mb-2 text-gray-800">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3">{{ $product->description }}</p>
                    <div class="flex justify-between items-center">
                        <p class="text-blue-600 font-bold text-lg">¥{{ number_format($product->price) }}</p>
                        <p class="text-gray-500 text-sm">在庫: {{ $product->stock }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>