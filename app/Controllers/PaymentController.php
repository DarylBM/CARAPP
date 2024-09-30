<?php 

namespace App\Controllers;

use App\Models\PaymentModel;

class PaymentController extends BaseController
{
    public function submit()
    {
        $model = new PaymentModel();

        $data = [
            'card_number' => $this->request->getPost('card-number'),
            'name'        => $this->request->getPost('card-name'),
            'address'     => $this->request->getPost('card-address'),
            'payment_method' => $this->request->getPost('payment-method'),
        ];

        if ($model->insert($data)) {
            return redirect()->to('/carslist')->with('success', 'Payment submitted successfully.');
        } else {
            return redirect()->back()->with('errors', $model->errors());
        }
    }

    public function checkout()
    {
        $model = new PaymentModel();
        $payments = $model->findAll();

        return view('admin/payment_management', ['payments' => $payments]);
    }

    public function delete($id)
    {
        $model = new PaymentModel();
        $payment = $model->find($id);

        if (!$payment) {
            return redirect()->to('payments')->with('error', 'Payment record not found.');
        }

        if ($model->delete($id)) {
            return redirect()->to('payments')->with('success', 'Payment record deleted successfully.');
        } else {
            return redirect()->to('payments')->with('error', 'Failed to delete payment record.');
        }
    }

    public function update($id)
    {
        $model = new PaymentModel();
        $payment = $model->find($id);

        if (!$payment) {
            return redirect()->to('payments')->with('error', 'Payment record not found.');
        }

        $data = [
            'card_number' => $this->request->getPost('card_number'),
            'name'        => $this->request->getPost('name'),
            'address'     => $this->request->getPost('address'),
            'payment_method' => $this->request->getPost('payment_method'),
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('payments')->with('success', 'Payment updated successfully.');
        } else {
            return redirect()->back()->with('errors', $model->errors());
        }
    }

    public function search()
    {
        $searchQuery = $this->request->getGet('search'); // Get search input

        $model = new PaymentModel();
        
        // Perform a simple search by name, card number, or other fields
        $payments = $model->like('name', $searchQuery)
                          ->orLike('card_number', $searchQuery)
                          ->orLike('payment_method', $searchQuery)
                          ->findAll();

        return view('admin/payment_management', ['payments' => $payments]);
    }
}