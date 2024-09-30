<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $model = new ProductModel();
        $data['products'] = $model->getAllProducts();
        return view('admin_page', $data);
    }
    public function indexs()
    {
        $model = new ProductModel();
        $data['cars'] = $model->getAllProducts(); // Change 'products' to 'cars' to match the view
        return view('user/car_list', $data);
    }
    
    public function add()
    {
        if ($this->request->getMethod() === 'post') {
            $model = new ProductModel();

            $productName = $this->request->getPost('product_name');
            $productPrice = $this->request->getPost('product_price');
            $productMileage = $this->request->getPost('mileage'); // Fix here: 'mileage' should match the view
            $productFuelType = $this->request->getPost('fueltype'); // Fix here: 'fueltype' should match the view
            $productTransmission = $this->request->getPost('transmission'); // Fix here: 'transmission' should match the view
            $productImage = $this->request->getFile('product_image');

            if ($productImage->isValid() && !$productImage->hasMoved()) {
                $imageName = $productImage->getName();
                $productImage->move('uploaded_img', $imageName);

                $model->save([
                    'model' => $productName,
                    'price' => $productPrice,
                    'image' => $imageName,
                    'mileage' => $productMileage,
                    'fueltype' => $productFuelType,
                    'transmission' => $productTransmission,
                ]);

                return redirect()->to('/admins')->with('message', 'New product added successfully');
            } else {
                return redirect()->back()->with('message', 'Image upload failed, please try again.');
            }
        }

        return view('admin_add_product');
    }

    public function delete($id)
    {
        $model = new ProductModel();
        $model->delete($id);
        return redirect()->to('/admins')->with('message', 'Product deleted successfully');
    }

    public function edit($id)
    {
        $model = new ProductModel();

        if ($this->request->getMethod() === 'post') {
            $productName = $this->request->getPost('product_name');
            $productPrice = $this->request->getPost('product_price');
            $productMileage = $this->request->getPost('mileage');
            $productFuelType = $this->request->getPost('fueltype');
            $productTransmission = $this->request->getPost('transmission');
            $productImage = $this->request->getFile('product_image');

            $updateData = [
                'model' => $productName,
                'price' => $productPrice,
                'mileage' => $productMileage,
                'fueltype' => $productFuelType,
                'transmission' => $productTransmission,
            ];

            // Only update the image if a new one is uploaded
            if ($productImage->isValid() && !$productImage->hasMoved()) {
                $imageName = $productImage->getName();
                $productImage->move('uploaded_img', $imageName);
                $updateData['image'] = $imageName; // Add the new image to the update array
            }

            $model->update($id, $updateData);
            return redirect()->to('/admins')->with('message', 'Product updated successfully');
        }

        $data['product'] = $model->getProduct($id);
        return view('admin_update_product', $data);
    }
}