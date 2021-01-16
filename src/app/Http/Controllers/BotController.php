<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use almakano\botsmanager\app\Bot;

class BotController extends Controller
{

	function index(Request $request)
	{

		$filter = [];

		foreach($request->all() as $k => $v) {
			if(in_array($k, ['id'])) $filter[$k] = $v;
		}

		return view('botsmanager::bots.list', ['list' => Bot::where($filter)->get()]);
	}

	function edit(Request $request, $id = 0)
	{

		if($id) $item = Bot::where(['id' => $id])->firstOrFail();
		else $item = new Bot();

		if($request->method() == 'POST') {

			$item->name		 = $request->input('name');
			$item->logic_id	 = $request->input('logic_id');
			$item->data		 = json_encode($request->input('data'), JSON_UNESCAPED_UNICODE);
			$item->save();

			redirect('');
		}

		return view('botsmanager::bots.edit', ['item' => $item]);
	}

	function delete(Request $request, $id = 0)
	{

		$item = Bot::where(['id' => $id])->firstOrFail();

		if($request->method() == 'POST') {
			$item->delete();
			redirect('/botsmanager/bots');
		}

		return view('botsmanager::bots.delete', ['item' => $item]);
	}

	function autocomplete(Request $request, $id = 0)
	{

		$q		 = $request->input('q');
		$page	 = $request->input('page');
		$limit	 = 20;

		$list	 = Bot::selectRaw('id, name as text')->where('name', 'like', '%'.$q.'%')
					->offset(($page - 1) * $limit)->limit($limit)->get();
		$pagination	 = $list->count() >= $limit;

		return \Response::json(['results' => $list, 'pagination' => ['more' => $pagination]]);
	}

	function receive(Request $request, $id = 0, $platform_name = '')
	{

		$item = Bot::where(['id' => $id])->firstOrFail();

		$platform_name = '\almakano\botsmanager\app\platforms\\'.$platform_name;
		$platform = new $platform_name(['bot' => $item]);

		$platform->receive();
	}
}