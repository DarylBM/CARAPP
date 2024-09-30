<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ShopController extends BaseController
{
    public function index()
    {
        // Load the ProductModel
        $productModel = new CarsModel();

        // Fetch all products from the database
        $data['products'] = $productModel->getProducts();

        // Pass data to the view
        return view('products', $data);
    }

    // Method to add product to cart
    public function addToCart($productId)
    {
        // Logic to add product to cart (you can use sessions or database to store cart items)
        // Redirect back to the products page
        return redirect()->to(site_url('products'));
    }

    // Method to checkout
    public function checkout()
    {
        // Logic to handle checkout process
        return view('checkout');
    }
}
