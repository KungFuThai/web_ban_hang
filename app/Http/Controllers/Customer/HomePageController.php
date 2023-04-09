<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $filterCategories = $request->get('categories', []);

        $arrPrice['min_price'] = Product::query()->min('price');
        $arrPrice['max_price'] = Product::query()->max('price');
        $minPrice = $request->get('min_price', $arrPrice['min_price']);
        $maxPrice = $request->get('max_price', $arrPrice['max_price']);

        $categories = cache()
            ->remember(
                'categories',
                86400 * 30,
                function () {
                    return Category::query()
                        ->select([
                            'id',
                            'name',
                            'slug',
                        ])
                        ->get();
                }
            );// loại ít thay đổi láy ra rồi cache lại cho nhẹ

        $query = Product::query()->latest();

        if ( ! empty($filterCategories)) {
            $arrFilters = Category::query()->whereIn('slug', $filterCategories)->pluck('id');
            foreach ($arrFilters as $arrFilter) {
                $query->orWhere('category_id', $arrFilter);
            }
        }

        if ( ! empty($minPrice) && ! empty($maxPrice)) {
            $arrFilterPrice['filter_min_price'] = $minPrice;
            $arrFilterPrice['filter_max_price'] = $maxPrice;
            $query->whereBetween('price', $arrFilterPrice);
        }

        if ( ! empty($q)) {
            $query->where('name', 'like', '%'.$q.'%');
        }

        $products = $query->paginate(8)->withQueryString();

        return view('homepage.customer.index', [
            'products'         => $products,
            'categories'       => $categories,
            'filterCategories' => $filterCategories,
            'minPrice'         => $minPrice,
            'maxPrice'         => $maxPrice,
            'arrPrice'         => $arrPrice,
            'q'                => $q,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->search;
        if ($request) {
            $data = Product::query()
                ->where('name', 'like', '%'.$search.'%')
                ->get();

            $searchData = '';
            if (count($data) > 0) {
                $searchData ='<ul style="list-style-type: none; margin-left: -40px; background-color: white; overflow: hidden">';
                foreach ($data as $row) {
                    $link = route('customer.show',$row->slug);
                    $img = asset('storage') . '/' . $row->image;
                    $searchData .= "
                    <li style='clear:both; border-bottom: 1px solid gray;'>
                        <a href='$link' style='float: left'>
                            <img src='$img' width='50px' height='50px'>
                            <span>$row->name</span>
                        </a>
                    </li>
                    ";
                }
                $searchData .= '</ul>';
            }
            else {
                $searchData .= 'Không tìm thấy kết quả!';
            }
            return $searchData;
        }
    }

    public function show(Product $product)
    {
        $title = $product->name;

        $relateProducts = Product::query()->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()->limit(4)->get();

        return view('homepage.customer.show', [
            'product'        => $product,
            'relateProducts' => $relateProducts,
            'title'          => $title,
        ]);
    }
}
