<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    // 一覧表示
    public function index()
    {
        $products = Product::latest()->get();
        return view('image-upload.index', compact('products'));
    }

    // 登録フォーム表示
    public function create()
    {
        return view('image-upload.create');
    }

    // 登録処理
    public function store(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:1000',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048', // 2MB以下の画像のみ
        ]);

        // 画像がアップロードされた場合のみ保存
        if ($request->hasFile('image')) {
            // storage/app/public/products に保存
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // 商品を作成
        Product::create($validated);

        return redirect('/image-upload')->with('success', '商品を登録しました');
    }
}
