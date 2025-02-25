<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    // Lấy danh sách sản phẩm: GET /products
    public function index()
    {
        try {
            $products = Product::all();
            return response()->json($products, 200);
        } catch (\Exception $e) {
            Log::error('Error fetching products: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching products'], 500);
        }
    }

    // Thêm sản phẩm mới: POST /products
    public function store(Request $request)
    {
        try {
            // Validate dữ liệu đầu vào
            $validatedData = $request->validate([
                'name'        => 'required|string|max:255|unique:products,name',
                'price'       => 'required|numeric|min:0',
                'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048'
            ]);

            // Xử lý upload ảnh nếu có
            if ($request->hasFile('image')) {
                // Lưu file vào thư mục 'products' trên disk 'public'
                $path = $request->file('image')->store('products', 'public');
                $validatedData['image'] = $path;
            }

            // Tạo sản phẩm mới
            $product = Product::create($validatedData);
            return response()->json($product, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error adding product: ' . $e->getMessage());
            return response()->json(['error' => 'Error adding product'], 500);
        }
    }
}
