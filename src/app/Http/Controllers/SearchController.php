<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  public function index(Request $request)
  {
      $keyword = $request->input('keyword');
      $categoryId = $request->input('category_id');

      // when()メソッドで条件付きクエリを構築
      $products = Product::with('category')
          ->when($keyword, function ($query, $keyword) {
              return $query->where('name', 'like', "%{$keyword}%");
          })
          ->when($categoryId, function ($query, $categoryId) {
              return $query->where('category_id', $categoryId);
          })
          ->paginate(10);

      $categories = Category::all();

      return view('search.index', compact('products', 'keyword', 'categoryId', 'categories'));
  }
}
