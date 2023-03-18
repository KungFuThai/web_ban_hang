<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;


class CustomerController extends Controller
{
    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = (new Customer())->query();
        $this->table = (new Customer())->getTable();

        View::share('title',
            ucwords($this->table)); //chia sẻ title đến mọi nơi trong controller
    }

    public function index()
    {
        return view("customer.index");
    }

    public function api()
    {
        return DataTables::of($this->model)
            ->addColumn('age', function ($object) {
                return $object->age;
            })
            ->addColumn('name', function ($object) {
                return $object->full_name;
            })
            ->addColumn('gender', function ($object) {
                return $object->gender_name;
            })
            ->addColumn('info', function ($object) {
                $email = $object->email;
                $phone = $object->phone;
                $address = $object->address;

                return "<a href='mailto:$email'>$email</a>
                        </br>
                        <a href='tel:$phone'>$phone</a>
                        </br>
                        $address
                        ";
            })
            ->editColumn('created_at', function ($object) {
                return $object->created_at->format('d/m/Y');
            })
            ->addColumn('destroy', function ($object) {
                return route('customers.destroy',
                    $object);
            })
            ->rawColumns(['info'])
            ->make(true);
    }

    public function destroy(Customer $customer)
    {
//        Customer::destroy($customerId);
        $customer->delete();

        return redirect()->back()->with('success', 'Xoá khách hàng thành công!');
    }
}
