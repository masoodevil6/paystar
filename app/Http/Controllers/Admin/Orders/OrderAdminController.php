<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\Admin\MainAdminController;
use App\Http\Requests\Admin\Bank\OrderRequest;
use App\Models\Orders\Order;
use App\Repositories\ContextRepository;
use function route;
use function view;

class OrderAdminController extends MainAdminController
{
    function __construct()
    {
        parent::__construct(route("admin.Orders.order.index") );
    }



    public function index(){
        $nav = [
            "part"=> "بخش مدیریت بانک ها",
            "navigation" =>[
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "لیست سفارشات"
                ]
            ]
        ];

        $userSearch = "";
        if (isset($_GET["user"])){
            $userSearch = $_GET["user"];
        }

        $resNumSearch = "";
        if (isset($_GET["res"])){
            $resNumSearch = $_GET["res"];
        }

        $isFinishSearch = -1;
        if (isset($_GET["is_finish"])){
            $isFinishSearch = $_GET["is_finish"];
        }

        $orders= ContextRepository::OrderRepository()->getListOrders($userSearch , $resNumSearch , $isFinishSearch);

        return view("admin.orders.order.index" ,
            compact("nav" , "orders" , "userSearch" , "resNumSearch" , "isFinishSearch")
        );
    }




    public function edit($order){
        /// navigation page
        $nav = [
            "part"=> "بخش مدیریت بانک ها",
            "navigation" =>[
                [
                    "route" => "admin.Orders.order.index" ,
                    "current" => 0,
                    "title" => "لیست سفارشات"
                ],
                [
                    "route" => "" ,
                    "current" => 1,
                    "title" => "مشاهده/ویرایش سفارش"
                ]
            ]
        ];

        $orderInfo= ContextRepository::OrderRepository()->getInfoOrder($order);

        return view("admin.orders.order.edit" , compact("nav" , "orderInfo"));
    }

    public function update(OrderRequest $request, Order $order){
        $input = $request->all();

        if (ContextRepository::OrderRepository()->setStateFinishOrder($order , $input["description_finish"] , $input["is_finish"] )){
            return $this ->redirectIndex("وضعیت اتمام سفارش، با موفقیت ویرایش شد");
        }
        else{
            return $this ->redirectIndex("مشکلی در ویرایش رخ داده است" , true);
        }
    }



    public function destroy(Order $order){
        ContextRepository::FormRepository()->deleteResult($order);
        return $this ->redirectIndex("سفارش با موفقیت حذف شد");
    }

}
