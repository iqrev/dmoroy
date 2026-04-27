<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostCategory;
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
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhereHas('tags', function ($t) use ($search) {
                      $t->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('category', function ($c) use ($search) {
                      $c->where('name', 'like', '%' . $search . '%');
                  });
            });
        }

        $products = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function productDetail($slug)
    {
        $product = Product::with('tags', 'category')->where('slug', $slug)->where('status', 'published')->firstOrFail();
        
        // Increment the view counter
        $product->increment('views_count');

        $tagIds = $product->tags->pluck('id');

        // Logic Relevansi:
        // 1. Prioritas utama: Tag yang sama (Makin banyak tag sama, makin relevan)
        // 2. Prioritas kedua: Kategori yang sama
        $relatedProducts = Product::query()
            ->where('status', 'published')
            ->where('id', '!=', $product->id)
            ->where(function ($query) use ($tagIds, $product) {
                if ($tagIds->isNotEmpty()) {
                    $query->whereHas('tags', function ($q) use ($tagIds) {
                        $q->whereIn('tags.id', $tagIds);
                    });
                }
                $query->orWhere('category_id', $product->category_id);
            })
            ->when($tagIds->isNotEmpty(), function ($q) use ($tagIds) {
                return $q->withCount(['tags' => function ($q) use ($tagIds) {
                    $q->whereIn('tags.id', $tagIds);
                }])->orderByDesc('tags_count');
            })
            ->orderByRaw('CASE WHEN category_id = ? THEN 1 ELSE 0 END DESC', [$product->category_id])
            ->latest()
            ->take(4)
            ->get();

        $otherProducts = Product::where('id', '!=', $product->id)
            ->whereNotIn('id', $relatedProducts->pluck('id'))
            ->where('status', 'published')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts', 'otherProducts'));
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
            $category = PostCategory::where('slug', $request->category)->first();
            
            if ($category) {
                // Recursive function or flat query to get ALL descendants
                $categoryIds = $this->getAllCategoryIds($category);
                    
                $query->whereHas('categories', function ($q) use ($categoryIds) {
                    $q->whereIn('post_categories.id', $categoryIds);
                });
            }
        }

        $posts = $query->latest()->paginate(9);

        return view('posts.index', compact('posts'));
    }

    private function getAllCategoryIds($category)
    {
        $ids = [$category->id];
        $children = PostCategory::where('parent_id', $category->id)->get();
        
        foreach ($children as $child) {
            $ids = array_merge($ids, $this->getAllCategoryIds($child));
        }
        
        return array_unique($ids);
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

    public function sitemap()
    {
        $products = Product::where('status', 'published')->latest()->get();
        $posts = Post::where('status', 'published')->latest()->get();
        $categories = Category::all();

        return response()->view('sitemap', [
            'products' => $products,
            'posts' => $posts,
            'categories' => $categories,
        ])->header('Content-Type', 'text/xml');
    }
}
