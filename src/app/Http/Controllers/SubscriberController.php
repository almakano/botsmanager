<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use almakano\botsmanager\app\Subscriber;

class SubscriberController extends Controller
{

	function index(Request $request)
	{
		return view('botsmanager::subscribers.list', ['list' => Subscriber::get()]);
	}

	function edit(Request $request, $id = 0)
	{

		if($id) $item = Subscriber::where(['id' => $id])->firstOrFail();
		else $item = new Subscriber();

		if($request->method() == 'POST') {

			$item->name		 = $request->input('name');
			$item->bot_id	 = $request->input('bot_id');
			$item->data		 = json_encode($request->input('data'), JSON_UNESCAPED_UNICODE);
			$item->save();

			redirect('');
		}

		return view('botsmanager::subscribers.edit', ['item' => $item]);
	}

	function delete(Request $request, $id = 0)
	{

		$item = Subscriber::where(['id' => $id])->firstOrFail();

		if($request->method() == 'POST') {
			$item->delete();
			redirect('/botsmanager/subscribers');
		}

		return view('botsmanager::subscribers.delete', ['item' => $item]);
	}

	function autocomplete(Request $request, $id = 0)
	{

		$q		 = $request->input('q');
		$page	 = $request->input('page');
		$limit	 = 20;

		$list	 = Subscriber::selectRaw('id, name as text')->where('name', 'like', '%'.$q.'%')
					->offset(($page - 1) * $limit)->limit($limit)->get();
		$pagination	 = $list->count() >= $limit;

		return \Response::json(['results' => $list, 'pagination' => ['more' => $pagination]]);
	}
}