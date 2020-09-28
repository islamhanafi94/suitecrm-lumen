<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Curl\Curl;
use GuzzleHttp\Client;


class ModuleController extends Controller
{
    private $token;
    private $base_url;
    private $HttpClient;


    public function __construct()
    {
        $this->token = $this->auth();
        $this->base_url = 'localhost/test_api/Api/V8/module';
        $this->HttpClient = new Curl();
        $this->HttpClient->setHeader('Content-type', 'application/vnd.api+json');
        $this->HttpClient->setHeader('Accept', 'application/vnd.api+json');
        $this->HttpClient->setHeader('Authorization', 'Bearer ' . $this->token);
    }


    public function index(Request $request , $module_name){
        $url = $this->base_url . '/' . ucfirst($module_name );
        $this->HttpClient->get($url);
        return response($this->HttpClient->response);
    }


    public function show(Request $request,$module_name,$id){
        $url = $this->base_url . '/' . ucfirst($module_name) . '/' . $id .'?fields[Accounts]=name,account_type';
        $this->HttpClient->get($url);
        return response($this->HttpClient->response);
    }
    
    public function create(Request $request,$module_name){
        $url = $this->base_url;
        $id  = $this->generateGUID();    

        $data = array(
            "data" => array(
                "type" => ucfirst($module_name),
                "id" => $id,
                "attributes" => $request->all()['data']['attributes']
            )
        );
        
        $this->HttpClient->post($url,json_encode($data)); 
        return response($this->HttpClient->response);
    }

    public function update(Request $request,$module_name,$id){
        $url = $this->base_url;

        $data = array(
            "data" => array(
                "type" => ucfirst($module_name),
                "id" => $id,
                "attributes" => $request->all()['data']['attributes']
            )
        );

        $this->HttpClient->patch($url,$data); 
        return response($this->HttpClient->response);
    }

    public function delete(Request $request,$module_name,$id){
        $url = $this->base_url . '/' . ucfirst($module_name) . '/' . $id;
        $this->HttpClient->delete($url);         
        return response($this->HttpClient->response);

    }

    public function auth(){
        $url = 'localhost/test_api/Api/access_token';
        $curl = new Curl();
        $data = array(
                "grant_type" => "password",
                "client_id" => "114b7030-489f-5f8e-6a03-5f6a719650a0",
                "client_secret" => "client2",
                "username" => "admin",
                "password" => "admin"
        );
        $curl->post($url,$data);
        $token = json_decode($curl->response)->access_token;
        return $token;
    }

    private function generateGUID(){
        if (function_exists('com_create_guid') === true){
            return trim(com_create_guid(), '{}');
        }
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}
