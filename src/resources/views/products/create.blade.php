<h1>商品登録</h1>

<!-- エラーメッセージの全体表示（追加） -->
@if($errors->any())
    <div style="background: #ffe0e0; border: 1px solid #ff0000; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
        <strong style="color: #cc0000;">入力エラーがあります:</strong>
        <ul style="margin: 10px 0 0 20px; color: #cc0000;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/products" method="POST">
    @csrf

    <div class="form-group">
        <label for="name">商品名: <span style="color: red;">*</span></label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        <!-- 個別エラーメッセージ（追加） -->
        @error('name')
            <span style="color: red; font-size: 14px;">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="price">価格: <span style="color: red;">*</span></label>
        <input type="number" id="price" name="price" value="{{ old('price') }}" required>
        @error('price')
            <span style="color: red; font-size: 14px;">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">説明: <span style="color: red;">*</span></label>
        <textarea id="description" name="description" required>{{ old('description') }}</textarea>
        @error('description')
            <span style="color: red; font-size: 14px;">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit">登録</button>
</form>