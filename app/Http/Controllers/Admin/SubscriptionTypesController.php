<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\SubscriptionType;
use Illuminate\Http\Request;

class SubscriptionTypesController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $status = $this->get_status_list('common');
        $subscriptionTypes = SubscriptionType::orderBy('id', 'desc')->get();
        return compact('subscriptionTypes', 'status');
    }


    public function store(Request $request)
    {
        $subscriptionType = new SubscriptionType;

        $subscriptionType->title = request('title');
        $subscriptionType->subscription_type_code = request('subscription_type_code');
        $subscriptionType->descr = request('descr');
        $subscriptionType->status = request('status');

        $subscriptionType->save();

    }

    public function update(Request $request, SubscriptionType $subscriptionType)
    {
        $subscriptionType->title = request('title');
        $subscriptionType->subscription_type_code = request('subscription_type_code');
        $subscriptionType->descr = request('descr');
        $subscriptionType->status = request('status');
        
        $subscriptionType->save();
    }

    public function destroy(SubscriptionType $subscriptionType)
    {
        $subscriptionType->delete();
    }
}
