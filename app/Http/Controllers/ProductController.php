<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(1);
        return view('products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        $search = $request->search;
        $products = Product::where('name','LIKE','%'.$search.'%')
            ->orWhere('description','LIKE','%'.$search.'%')->paginate(1);
        return view('products',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // return $request;
        $validated = $request->validated();
        if($request->has('image')){
            $image = $request->file('image');

            $imageName = $image->getClientOriginalExtension();

            $filename = time().'.'.$imageName;

            $path = 'uploads/products/';

            $image->move($path,$filename);

        }
     try{
        $product = new Product();
        $product->name = ['en'=>$request->product_en,'ar'=>$request->product_ar];
        $product->description = ['en'=>$request->desc_en,'ar'=>$request->desc_ar];
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category;
        $product->image = $path.$filename;
        $product->save();
        return redirect()->back();
     } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $categories = Category::all();
        return view('welcome',compact('categories'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function print($id)
    {
        $product = Product::findOrFail($id);
        $pdf = Pdf::loadView('pdf',compact('product'));
        $pdf->getDomPDF()->getOptions()->set('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->getOptions()->set('isPhpEnabled', true);
        $pdf->getDomPDF()->getOptions()->set('defaultFont', 'arial');
        return $pdf->download('report.pdf');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request)
    {
        // return $request;
        $validated = $request->validated();
        try{
            $product = Product::findOrFail($request->id);
            if($request->has('image')){
                $image = $request->file('image');

                $imageName = $image->getClientOriginalExtension();

                $filename = time().'.'.$imageName;

                $path = 'uploads/products/';

                $image->move($path,$filename);
                if(File::exists($product->image)){
                    File::delete($product->image);
                }
            }

            $product->name = ['en'=>$request->product_en,'ar'=>$request->product_ar];
            $product->description = ['en'=>$request->description_en,'ar'=>$request->description_ar];
            $product->price = $request->product_price;
            $product->quantity = $request->product_qunatity;
            $product->category_id = $request->category_id;
            $product->image=$path.$filename;
            $product->save();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // return $request->id;
        try{
            $product = Product::findOrFail($id);
            if(File::exists($product->image)){
                File::delete($product->image);
            }
            $product->delete();
            return redirect()->back();
        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
