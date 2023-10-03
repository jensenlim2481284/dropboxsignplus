<?php

use App\Models\Translate;
use Ramsey\Uuid\Uuid;
use Illuminate\Encryption\Encrypter;



/**************************************************

                 ROLE RELATED

 **************************************************/


# Check if user is admin
function isAdmin()
{
    return Auth::user()->isAdmin();
}


# Function to get user ID 
function getUserID()
{   
    return Auth::user()->id;
}


/**************************************************

                GLOBAL FUNCTION

 **************************************************/


# Function to get locazliation code
function getSupportedLocalesNative()
{
    $arr = [];
    foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    {
        $arr_list = [LaravelLocalization::getLocalizedURL($localeCode, null, [], true)=>$properties['native']];
        $arr= array_merge((array)$arr,(array)$arr_list);
    }
    return $arr;
}


# Custom Translate function
function translate($key, $value = null)
{

	# 1 : Check language & validation
    $lang= \App::getLocale();
    if(!$value) $value = $key;
    
    # 2 : Check if translate before - return data value 
    $translate = Translate::where('key',$key)->first();
    if($translate)
    {
        if ($lang == 'en')
            return $translate->value_en;
        return $translate->value_zh_CN;
    }
        
    # 3 : If didnt translate before , store key & value 
    Translate::create(['key'=>$key,'value_en'=>$value]);

    return $value;
}




# Function to send telegram notification 
function sendTelegram($message)
{
    \App\Http\Services\TelegramService::sendMessage($message);
}


# Function to set meta
function setMeta($meta, $key, $value, $ignoreExistingKey = false)
{
    if (!$meta)
        $meta = (object) array();

    //Ignore existing key
    if ($ignoreExistingKey) {
        if (isset($meta->{$key}))
            return $meta;
    }


    $meta->{$key} = $value;
    return $meta;
}


# Function to filter start date
function getFilterStartDate($date)
{
    $startDate = date($date);
    if (!$startDate)
        $startDate = date("0000-00-00");
    return $startDate;
}


# Function to filter end date
function getFilterEndDate($date)
{
    $endDate =  date('Y-m-d', strtotime('+1 day', strtotime($date)));
    if (!$date)
        $endDate = date("9999-1-1");
    return $endDate;
}


function encryptWithoutIV($data) {
    $cipher = "AES-128-ECB"; // ECB mode
    $options = OPENSSL_RAW_DATA;
    $key = hex2bin(env('PASSKEY'));
    $encryptedData = openssl_encrypt($data, $cipher, $key, $options);
    return base64_encode($encryptedData); // Encode the ciphertext as base64
}

function decryptWithoutIV($data) {
    $cipher = "AES-128-ECB"; // ECB mode
    $options = OPENSSL_RAW_DATA;
    $key = hex2bin(env('PASSKEY'));
    $decodedData = base64_decode($data); // Decode base64-encoded ciphertext
    return openssl_decrypt($decodedData, $cipher, $key, $options);
}

# Custom encryption
function customEncryption($key)
{
    $encrypt = new Encrypter(env('PASS_KEY'), 'AES-128-CBC');
    return $encrypt->encrypt($key);
}



# Custom decryption
function customDecryption($key, $id = null)
{
    try {
        $decrypt = new Encrypter(env('PASS_KEY'), 'AES-128-CBC');
        $decrypt = $decrypt->decrypt($key);
        if ($id)
            return explode("$id", $decrypt)[1];
        return $decrypt;
    } catch (\Exception $e) {
        abort(404);
    }
}


# Function to filter mouney amount
function filterNumber($num)
{
    return number_format($num, 2, '.', ',');
}


# Function to generate reference key
function generateReferenceKey($key='')
{
    return $key . Uuid::uuid4()->toString();
}


# Function to get $_GET value
function requestInput($key)
{
    return request()->input($key);
}


# Function to check nav active 
function isNavActive($routeArray)
{
    # 0 : Get current route name
    $requestRoute = Request::route()->getName();

    # 1 : Loop route and check if got wildcard
    foreach ($routeArray as $route) {
        if (strpos($route, "*") !== false) {
            $checkRoute = explode('.*', $route);
            if (strpos($requestRoute, $checkRoute[0]) !== false)
                return true;
        }
    }

    # 2 : Check if in array 
    return in_array($requestRoute, $routeArray);
}
