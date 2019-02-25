<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PusherController extends Controller
{

	protected $secret='688b50dff33bf7f5cf6e';
	protected $key='ec77a7c48ef69b22b5bf';
	protected $app_id='720184';

	// protected $instanceId='ab3f9203-87ed-4836-a54b-56fa338e1b15';
	// protected $secretKey='57BC8B8D180B1B7207065D7436C018FBA0F10E2A150888D9ED44DBBD8CB093E4';

    protected $instanceId='469bc07d-ceb7-4671-982d-da9de1820a63';
    protected $secretKey='8C44E1318BCF26D42D75BE7BD34F852382274E91045D9332C426976284D22497';

	protected $options = [
		'cluster'=>'ap1',
		'useTLS' => true
	];

    public function channel(Request $request)
    {
		 
		$this->validate($request, [
            'channel'=>'required',
            'event'=>'required',
            'data'=>'required'
        ]);
		
		$pusher = new \Pusher\Pusher(
		    $this->key,
		    $this->secret,
		    $this->app_id,
		    $this->options
		);

		$pusher->trigger($request->channel, $request->event, $request->data, null, true);

		if ($pusher->response['status'] == 200) {
			$code = 200;
			$data = [['status'=>'success']];
			$message = [];
		} else {
			$code = 422;
			$data = [];
			$message = $pusher->response['body'];
		}
		

		return $this->response($data, $code, $message);
    }


    // Beams

    protected function beams()
    {
    	return $beamsClient = new \Pusher\PushNotifications\PushNotifications(array(
			"instanceId" => $this->instanceId,
			"secretKey" => $this->secretKey,
		));
    }

    protected function body($title, $body)
    {
    	$params = [
    		'title'=>$title,
    		'body'=>$body
    	];

    	$data = [
		    "fcm" => [
			    "notification" => $params
		    ],
		    "apns" => [
		    	"aps" => [
			      "alert" => $params
			    ]
			]
	   	];

    	return $data;
    }

    public function interests(Request $request)
    {

    	$this->validate($request, [
            'interests'=>'required',
            'title'=>'required',
            'body'=>'required'
        ]);

    	$interests = $request->interests;

    	if (is_string($interests)) {
    		$interests = [$interests];
    	}

    	$body = $this->body($request->title, $request->body);
    	$send = $this->beams()->publishToInterests($interests, $body);

    	return $this->response($send);
    }

    public function users(Request $request)
    {

    	$this->validate($request, [
            'userIds'=>'required',
            'title'=>'required',
            'body'=>'required'
        ]);

    	$userIds = $request->userIds;

    	if (is_string($userIds)) {
    		$userIds = [$userIds];
    	}

    	$body = $this->body($request->title, $request->body);
    	$send = $this->beams()->publishToUsers($userIds, $body);

    	return $this->response($send);
    }

    public function generateToken(Request $request)
    {
    	
    	$this->validate($request, [
            'userId'=>'required',
        ]);

    	$userId = $request->userId;
    	$send = $this->beams()->generateToken($userId);

    	return $this->response($send);
    }

    public function deleteUser(Request $request)
    {

    	$this->validate($request, [
            'userId'=>'required',
        ]);

    	$userId = $request->userId;
    	$send = $this->beams()->deleteUser($userId);

    	return $this->response($send);
    }
}
