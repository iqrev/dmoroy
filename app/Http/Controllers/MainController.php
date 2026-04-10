<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Slider;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        $categories = Category::withCount('products')->get();
        $featuredProducts = Product::where('is_featured', true)->where('status', 'published')->latest()->take(6)->get();
        $latestPosts = Post::where('status', 'published')->latest()->take(3)->get();

        return view('home', compact('sliders', 'categories', 'featuredProducts', 'latestPosts'));
    }

    public function products(Request $request)
    {
        $query = Product::where('status', 'published');

        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('q') && $request->q) {
            $query->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('description', 'like', '%' . $request->q . '%');
        }

        $products = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'published')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function about()
    {
        $teamMembers = TeamMember::orderBy('id')->get();

        return view('about', compact('teamMembers'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function posts(Request $request)
    {
        $query = Post::where('status', 'published');

        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $posts = $query->latest()->paginate(9);

        return view('posts.index', compact('posts'));
    }

    public function postDetail($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();
        $relatedPosts = Post::where('id', '!=', $post->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }
}
