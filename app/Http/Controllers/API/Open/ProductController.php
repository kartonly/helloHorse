<?php

namespace App\Http\Controllers\API\Open;

use App\Models\Category;
use App\Models\Goods;
use App\Models\Liked;
use App\Models\Order;
use App\Models\Photos;
use App\Models\Product;
use App\Models\Review;
use App\Models\Shop;
use App\Models\Sizes;
use App\Models\Storage;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage as Stor;

class ProductController extends Controller
{
    public function hi(): string
    {
        return "Hello~";
    }
}
