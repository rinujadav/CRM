<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Merchant;
use App\Models\MerchantDevice;
use App\Models\MerchantServiceFeePercentage;
use App\Models\PrimeCustomer;
use App\Models\Settings;
use CreateMerchantDeviceTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use stdClass;
use Validator;

use function Ramsey\Uuid\v1;

class PrimeController extends BaseController
{

    public function check_merchant(Request $request)

    {
        $validator = Validator::make($request->all(), [

            'merchant_id' => 'required|min:13|max:13',
            'device_id' => 'required'

        ]);



        if ($validator->fails()) {

            return $this->sendError('Validation Error.', '', 400);
        }
        $data = [];
        $check_customer = PrimeCustomer::where('merchant_id', $request->merchant_id)->first();
        $data['isCustomerAvailable'] = true;
        if (empty($check_customer)) {
            $data['isCustomerAvailable'] = false;
        }
        $check_merchant = Merchant::where('merchant_id', $request->merchant_id)->first();
        if (empty($check_merchant)) {
            $data['isMerchantAvailable'] = false;
            $data['merchant'] = new stdClass();
        } else {
            $data['isMerchantAvailable'] = true;

            $check_device_merchant = MerchantDevice::where('merchant_id', $request->merchant_id)->where('device_id', $request->device_id)->first();
            if (!empty($check_device_merchant)) {
                $check_merchant->device_id = $check_device_merchant->device_id;
            } else {
                $merchant_device = new MerchantDevice();
                $merchant_device->merchant_id = $check_merchant->merchant_id;
                $merchant_device->device_id = $request->device_id;
                $merchant_device->created_by = 2;
                $merchant_device->updated_by = 2;
                $merchant_device->save();

                $check_merchant->device_id = $merchant_device->device_id;
            }
            $data['merchant'] = $check_merchant;
        }
        return $this->sendResponse($data, 'Success');
    }
    public function login(Request $request)

    {
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [

                'email' => 'required|email',
                'password' => 'required'

            ]);



            if ($validator->fails()) {

                return $this->sendError('Validation Error.', '', 400);
            }
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();

            $success['token'] =  $user->createToken('MyApp')->plainTextToken;

            //$success['name'] =  $user->name;



            return $this->sendResponse($success, 'User login successfully.');
        } else {

            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised'], 401);
        }
    }
    public function merchant_registration(Request $request)

    {
        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'token' => 'required',
            'merchant_id' => 'required|min:13|max:13',
            'device_id' => 'required',
            'clover_url' => 'required',
            'timezone' => 'required',
            'owner_name' => 'required',
            'business_name' => 'required',
            'phone' => 'required',


        ]);



        if ($validator->fails()) {

            return $this->sendError('Validation Error.', '', 400);
        }
        $data = [];

        $merchant = new Merchant();
        $merchant->merchant_id = $request->merchant_id;
        $merchant->token = $request->token;
        $merchant->clover_url = $request->clover_url;
        $merchant->timezone = $request->timezone;
        $merchant->owner_name = $request->owner_name;
        $merchant->business_name = $request->business_name;
        $merchant->email = $request->email;
        $merchant->phone = $request->phone;
        $merchant->created_by = 2;
        $merchant->updated_by = 2;
        $merchant->save();

        $merchant_device = new MerchantDevice();
        $merchant_device->merchant_id = $merchant->merchant_id;
        $merchant_device->device_id = $request->device_id;
        $merchant_device->created_by = 2;
        $merchant_device->updated_by = 2;
        $merchant_device->save();

        $merchant->device_id = $merchant_device->device_id;

        $data['merchant'] = $merchant->toArray();
        return $this->sendResponse($data, 'Merchant Register Successfully');
    }
    public function edit_merchant_profile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'merchant_id' => 'required|min:13|max:13',
            'owner_name' => 'required',
            'business_name' => 'required',
            'phone' => 'required',
            'device_id' => 'required'
        ]);



        if ($validator->fails()) {

            return $this->sendError('Validation Error.', '', 400);
        }
        $data = [];

        $merchant = Merchant::where('merchant_id', $request->merchant_id)->first();
        if (!empty($merchant)) {
            $merchant->merchant_id = $request->merchant_id;
            $merchant->token = $request->token;
            $merchant->owner_name = $request->owner_name;
            $merchant->business_name = $request->business_name;
            $merchant->phone = $request->phone;
            $merchant->updated_by = 2;
            $merchant->save();

            $merchant_device = MerchantDevice::where('merchant_id', $request->merchant_id)->where('device_id', $request->device_id)->orderBy('id', 'DESC')->first();
            if (!empty($merchant_device)) {
                $merchant_device->merchant_id = $merchant->merchant_id;
                $merchant_device->device_id = $request->device_id;
                $merchant_device->save();
                $merchant->device_id = $merchant_device->device_id;
            }



            $data['merchant'] = $merchant->toArray();
            return $this->sendResponse($data, 'Merchant Update Successfully');
        } else {
            return $this->sendError('Merchant not found');
        }
    }
    public function get_service_fee_percentage(Request $request)

    {
        $validator = Validator::make($request->all(), [

            'merchant_id' => 'required|min:13|max:13',
        ]);

        if ($validator->fails()) {

            return $this->sendError('Validation Error.', '', 400);
        }
        $data = [];
        $data['service_fee_percentage'] = 0.0;
        $merchant = MerchantServiceFeePercentage::where('merchant_id', $request->merchant_id)->orderBy('id', 'desc')->first();
        if (!empty($merchant)) {
            $data['service_fee_percentage'] = $merchant->service_percentage;
        }

        return $this->sendResponse($data, 'Success');
    }
    public function edit_service_fee_percentage(Request $request)

    {
        $validator = Validator::make($request->all(), [

            'merchant_id' => 'required|min:13|max:13',
            'service_fee' => 'required|numeric|between:0,4'
        ]);

        if ($validator->fails()) {

            return $this->sendError('Validation Error.', '', 400);
        }

        $data = [];
        $data['service_fee_percentage'] = 0.0;
        $check_current_percentage = MerchantServiceFeePercentage::where('merchant_id', $request->merchant_id)->orderBy('id', 'desc')->first();
        if (empty($check_current_percentage)) {
            $merchant_per = new MerchantServiceFeePercentage();
            $merchant_per->service_percentage = $request->service_fee;
            $merchant_per->merchant_id = $request->merchant_id;
            $merchant_per->created_by = Auth::user()->id;
            $merchant_per->updated_by = Auth::user()->id;
            $merchant_per->save();
            $merchant_details = Merchant::where('merchant_id', $request->merchant_id)->first();
            if (!empty($merchant_details)) {
                $response = Http::withToken($merchant_details->token)->post('https://sandbox.dev.clover.com/v3/apps/10J4W7F8QY690/merchants/' . $request->merchant_id . '/notifications', ['event' => 'ServicePercantageChange', 'data' => $merchant_per->service_percentage]);
            }
        } else {
            if ($request->service_fee != $check_current_percentage->service_percentage) {
                $merchant_per = new MerchantServiceFeePercentage();
                $merchant_per->service_percentage = $request->service_fee;
                $merchant_per->merchant_id = $request->merchant_id;
                $merchant_per->created_by = Auth::user()->id;
                $merchant_per->updated_by = Auth::user()->id;
                $merchant_per->save();
                $merchant_details = Merchant::where('merchant_id', $request->merchant_id)->first();
                if (!empty($merchant_details)) {
                    $response = Http::withToken($merchant_details->token)->post('https://sandbox.dev.clover.com/v3/apps/10J4W7F8QY690/merchants/' . $request->merchant_id . '/notifications', ['event' => 'ServicePercantageChange', 'data' => $merchant_per->service_percentage]);
                }
            }
        }
        $merchant = MerchantServiceFeePercentage::where('merchant_id', $request->merchant_id)->orderBy('id', 'desc')->first();
        if (!empty($merchant)) {
            $data['service_fee_percentage'] = $merchant->service_percentage;
        }

        return $this->sendResponse($data, 'Success');
    }
    public function update_setting(Request $request)

    {
        $validator = Validator::make($request->all(), [

            'merchant_id' => 'required|min:13|max:13',
            'lineitem_text' => 'required',
            'isDebitCardCharged' => 'required'
        ]);

        if ($validator->fails()) {

            return $this->sendError('Validation Error.', '', 400);
        }

        $data = [];
        $current_setting = Settings::where('merchant_id', $request->merchant_id)->orderBy('id', 'desc')->first();
        if (empty($current_setting)) {
            $current_setting = new Settings();
            $current_setting->merchant_id = $request->merchant_id;
            $current_setting->lineitem_text = $request->lineitem_text;
            $current_setting->isDebitCardCharged = $request->isDebitCardCharged;
            $current_setting->created_by = Auth::user()->id;
            $current_setting->updated_by = Auth::user()->id;
            $current_setting->save();
            $response = Http::withToken('5aaaa7c8-76df-b586-99c4-97ba48ae3da9')->post('https://sandbox.dev.clover.com/v3/apps/10J4W7F8QY690/merchants/' . $request->merchant_id . '/notifications', ['event' => 'SettingUpdate']);
        } else {
            $current_setting->merchant_id = $request->merchant_id;
            $current_setting->lineitem_text = $request->lineitem_text;
            $current_setting->isDebitCardCharged = $request->isDebitCardCharged;
            $current_setting->created_by = Auth::user()->id;
            $current_setting->updated_by = Auth::user()->id;
            $current_setting->save();
            $response = Http::withToken('5aaaa7c8-76df-b586-99c4-97ba48ae3da9')->post('https://sandbox.dev.clover.com/v3/apps/10J4W7F8QY690/merchants/' . $request->merchant_id . '/notifications', ['event' => 'SettingUpdate']);
        }
        $current_setting->isDebitCardCharged = (bool)$current_setting->isDebitCardCharged;
        $data = array();
        $data['settings'] = $current_setting->toArray();
        return $this->sendResponse($data, 'Success');
    }
    public function get_setting(Request $request)

    {
        $validator = Validator::make($request->all(), [

            'merchant_id' => 'required|min:13|max:13',
        ]);

        if ($validator->fails()) {

            return $this->sendError('Validation Error.', '', 400);
        }

        $data = [];
        $current_setting = Settings::where('merchant_id', $request->merchant_id)->orderBy('id', 'desc')->first();
        if (!empty($current_setting)) {
            $current_setting->isDebitCardCharged = (bool)$current_setting->isDebitCardCharged;
            $data['settings'] = $current_setting->toArray();
        } else {
            $data['settings'] =  null;
        }


        return $this->sendResponse($data, 'Success');
    }
}
