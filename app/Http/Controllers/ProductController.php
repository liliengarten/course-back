<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductJson;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index() {
        return ProductJson::collection(Product::all());
    }
}
