<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SubscriberController extends Controller
{

	public function index()
	{
		return view('botsmanager::subscribers.list', ['list' => \almakano\botsmanager\app\Subscriber::get()]);
	}

	public function edit($id = 0)
	{

		$item = \almakano\botsmanager\app\Subscriber::where(['id' => $id])->firstOrFail();

		if(Request::method() == 'POST') {

			$item->name		 = Request::input('name');
			$item->bot_id	 = Request::input('bot_id');
			$item->data		 = json_encode(Request::input('data'), JSON_UNESCAPED_UNICODE);
			$item->save();

			redirect('');
		}

		return view('botsmanager::subscribers.edit', ['item' => $item]);
	}

	public function delete($id = 0)
	{

		$item = \almakano\botsmanager\app\Subscriber::where(['id' => $id])->firstOrFail();

		if(Request::method() == 'POST') {
			$item->delete();
			redirect('/botsmanager/subscribers');
		}

		return view('botsmanager::subscribers.delete', ['item' => $item]);
	}
}