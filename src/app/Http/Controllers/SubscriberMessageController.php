<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use almakano\botsmanager\app\Subscriber;
use almakano\botsmanager\app\SubscriberMessage;

class SubscriberMessageController extends DefaultController
{
	protected $_model_class_name = '\almakano\botsmanager\app\SubscriberMessage';
	protected $_views_name = 'subscribersmessages';
}