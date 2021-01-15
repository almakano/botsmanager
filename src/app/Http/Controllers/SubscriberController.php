<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SubscriberController extends Controller
{

	public function index(Request $request)
	{
		return view('botsmanager::subscribers.list', ['list' => \almakano\botsmanager\app\Subscriber::get()]);
	}

	public function edit(Request $request, $id = 0)
	{

		if($id) $item = \almakano\botsmanager\app\Subscriber::where(['id' => $id])->firstOrFail();
		else $item = new \almakano\botsmanager\app\Subscriber();

		if($request->method() == 'POST') {

			$item->name		 = $request->input('name');
			$item->bot_id	 = $request->input('bot_id');
			$item->data		 = json_encode($request->input('data'), JSON_UNESCAPED_UNICODE);
			$item->save();

			redirect('');
		}

		return view('botsmanager::subscribers.edit', ['item' => $item]);
	}

	public function delete(Request $request, $id = 0)
	{

		$item = \almakano\botsmanager\app\Subscriber::where(['id' => $id])->firstOrFail();

		if($request->method() == 'POST') {
			$item->delete();
			redirect('/botsmanager/subscribers');
		}

		return view('botsmanager::subscribers.delete', ['item' => $item]);
	}
}