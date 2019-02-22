<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class OneSignalController extends Controller
{
    // '0968b630-89d8-4c35-b7ab-841af6dfcecb', app
    //     'OWU3MmMyYzMtNzFiOS00YzViLTgzMzEtZTY5NmUyOTFjODQ2', api key
    //     'ZGI1NGMyMmItMjg1YS00MmNmLWEyNTMtZDZhYTkyZGI1NmJi', user key

    protected $restApiKey;
    protected $userAuthKey;
    protected $notificationId;
    protected $data = [];

    public function all(Request $request)
    {
        $this->validate($request, [
            'restApiKey'=>'required',
            'appId'=>'required',
            'title'=>'required',
            'body'=>'required'
        ]);
        
        $this->restApiKey = $request->restApiKey;
        
        $params = [
            'app_id' => $request->appId,
            'included_segments' => ['All'],
            'contents' => [
                'en'=>$request->body
            ],
            'headings' => [
                'en'=>$request->title
            ]
        ];

        if (isset($request->url)) {
            $params['url'] = $request->url;
        }

        if (isset($request->schedule)) {
            $params['send_after'] = $request->schedule;
        }

        $this->data = $params;

        $res = $this->send();
        
        if (isset($res->errors)) {
            return $this->response([], 422, $res->errors);
        }else{
            return $this->response($res);
        }
    }

    public function users(Request $request)
    {
        $this->validate($request, [
            'restApiKey'=>'required',
            'appId'=>'required',
            'title'=>'required',
            'body'=>'required',
            'userIds'=>'required|array'
        ]);
        
        $this->restApiKey = $request->restApiKey;

        $params = [
            'app_id' => $request->appId,
            'include_player_ids' => $request->userIds,
            'contents' => [
                'en'=>$request->body
            ],
            'headings' => [
                'en'=>$request->title
            ],
        ];

        if (isset($request->url)) {
            $params['url'] = $request->url;
        }

        if (isset($request->schedule)) {
            $params['send_after'] = $request->schedule;
        }

        $this->data = $params;

        $res = $this->send();
        
        if (isset($res->errors)) {
            return $this->response([], 422, $res->errors);
        }else{
            return $this->response($res);
        }
    }

    public function tags(Request $request)
    {
        $this->validate($request, [
            'restApiKey'=>'required',
            'appId'=>'required',
            'title'=>'required',
            'body'=>'required',
            'tags'=>'required|array'
        ]);
        
        $this->restApiKey = $request->restApiKey;

        $params = [
            'app_id' => $request->appId,
            'filters' => $request->tags,
            'contents' => [
                'en'=>$request->body
            ],
            'headings' => [
                'en'=>$request->title
            ],
        ];

        if (isset($request->url)) {
            $params['url'] = $request->url;
        }

        if (isset($request->schedule)) {
            $params['send_after'] = $request->schedule;
        }

        $this->data = $params;

        $res = $this->send();
        
        if (isset($res->errors)) {
            return $this->response([], 422, $res->errors);
        }else{
            return $this->response($res);
        }
    }

    public function segments(Request $request)
    {
        $this->validate($request, [
            'restApiKey'=>'required',
            'appId'=>'required',
            'title'=>'required',
            'body'=>'required',
            'segments'=>'required|array'
        ]);
        
        $this->restApiKey = $request->restApiKey;

        $params = [
            'app_id' => $request->appId,
            'included_segments' => $request->segments,
            'contents' => [
                'en'=>$request->body
            ],
            'headings' => [
                'en'=>$request->title
            ],
        ];

        if (isset($request->url)) {
            $params['url'] = $request->url;
        }

        if (isset($request->schedule)) {
            $params['send_after'] = $request->schedule;
        }

        $this->data = $params;

        $res = $this->send();
        
        if (isset($res->errors)) {
            return $this->response([], 422, $res->errors);
        }else{
            return $this->response($res);
        }
    }

    public function cancel(Request $request)
    {
        $this->validate($request, [
            'restApiKey'=>'required',
            'appId'=>'required',
            'appId'=>'required',
            'notificationId'=>'required'
        ]);

        $this->restApiKey = $request->restApiKey;

        $res = $this->cnc($request->appId, $request->notificationId);
        
        if (isset($res->errors)) {
            return $this->response([], 422, $res->errors);
        }else{
            return $this->response($res);
        }
    }

    protected function send()
    {
        $response = Curl::to('https://onesignal.com/api/v1/notifications')
            ->withHeader('Authorization: Basic '.$this->restApiKey)
            ->withData($this->data)
            ->asJson()
            ->post();

        return $response;
    }

    protected function cnc($appId, $notificationId)
    {
        $response = Curl::to('https://onesignal.com/api/v1/notifications/'.$notificationId.'?app_id='.$appId)
            ->withHeader('Authorization: Basic '.$this->restApiKey)
            ->asJson()
            ->delete();

        return $response;
    }
}
