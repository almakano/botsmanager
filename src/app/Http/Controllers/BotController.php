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

			$keys = \Schema::getColumnListing($item->getTable());

			foreach($request->all() as $k => $v)
				if(in_array($k, $keys))
					$item->$k = $v;

			$item->save();

			if(!empty($request->input('_ajax')))
				return '<script>location.href="'.action([static::class, 'index']).'"; </script>';

			return redirect()->action([static::class, 'index']);
		}

		return view('botsmanager::bots.edit', ['item' => $item]);
	}

	function delete(Request $request, $id = 0)
	{

		$item = Bot::where(['id' => $id])->firstOrFail();

		if($request->method() == 'POST') {
			$item->delete();

			if(!empty($request->input('_ajax')))
				return '<script>location.href="'.action([static::class, 'index']).'"; </script>';

			return redirect()->action([static::class, 'index']);
		}


		return view('botsmanager::bots.delete', ['item' => $item]);
	}

	function autocomplete(Request $request, $id = 0)
	{

		$q		 = $request->input('q');
		$page	 = (int) $request->input('page');
		$limit	 = 20;

		$list	 = Bot::selectRaw('id, name as text')->where('name', 'like', '%'.$q.'%')
					->offset(($page - 1) * $limit)->limit($limit)->get();
		$pagination	 = $list->count() >= $limit;

		return \Response::json(['results' => $list, 'pagination' => ['more' => $pagination]]);
	}

	function receive(Request $request, $id = 0, $platform_name = '')
	{

		$item = Bot::where(['id' => $id])->firstOrFail();

		$platform_name = '\almakano\botsmanager\app\Platforms\\'.ucfirst($platform_name);
		$platform = new $platform_name(['bot' => $item]);

		$platform->receive();
	}

	function activate(Request $request, $id = 0, $platform_name = '')
	{

		$item = Bot::where(['id' => $id])->firstOrFail();

		$platform_name = '\almakano\botsmanager\app\Platforms\\'.ucfirst($platform_name);
		$platform = new $platform_name(['bot' => $item]);

		$res = $platform->activate();

		if($res['ok'] == true) {
			$item->data = array_replace_recursive($item->data, ['telegram' => ['status' => 'Enabled']]);
			$item->save();
		}

		if(!empty($request->input('_ajax')))
			return \Response::make('<script>location.reload(); </script>');

		return redirect()->action([static::class, 'edit'], ['id' => $item->id]);
	}

	function deactivate(Request $request, $id = 0, $platform_name = '')
	{

		$item = Bot::where(['id' => $id])->firstOrFail();

		$platform_name = '\almakano\botsmanager\app\Platforms\\'.ucfirst($platform_name);
		$platform = new $platform_name(['bot' => $item]);

		$res = $platform->deactivate();

		if($res['ok'] == true) {
			$item->data = array_replace_recursive($item->data, ['telegram' => ['status' => 'Disabled']]);
			$item->save();
		}

		if(!empty($request->input('_ajax')))
			return '<script>location.reload(); </script>';

		return redirect()->action([static::class, 'edit'], ['id' => $item->id]);
	}
}