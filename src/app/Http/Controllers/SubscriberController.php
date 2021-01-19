<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use almakano\botsmanager\app\Subscriber;

class SubscriberController extends Controller
{

	function index(Request $request)
	{

		$sorts = [];
		$keys = \Schema::getColumnListing(with(new Subscriber)->getTable());
		foreach($keys as $key) {
			$sorts[] = $key.' desc';
			$sorts[] = $key;
		}
		$sort = $request->input('sort') ?? 0;
		$filter = [];

		foreach($request->all() as $k => $v) {
			if(in_array($k, $keys)) $filter[] = [$k, 'like', $v.'%'];
		}

		return view('botsmanager::subscribers.list', [
			'list' => Subscriber::where($filter)->orderByRaw($sorts[$sort])->get(),
			'sort' => $sort,
			'sorts' => $sorts,
		]);
	}

	function edit(Request $request, $id = 0)
	{

		if($id) $item = Subscriber::where(['id' => $id])->firstOrFail();
		else $item = new Subscriber();

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

		return view('botsmanager::subscribers.edit', ['item' => $item]);
	}

	function delete(Request $request, $id = 0)
	{

		$item = Subscriber::where(['id' => $id])->firstOrFail();

		if($request->method() == 'POST') {
			$item->delete();

			if(!empty($request->input('_ajax')))
				return '<script>location.href="'.action([static::class, 'index']).'"; </script>';

			return redirect()->action([static::class, 'index']);
		}

		return view('botsmanager::subscribers.delete', ['item' => $item]);
	}

	function autocomplete(Request $request, $id = 0)
	{

		$q		 = $request->input('q');
		$page	 = (int) $request->input('page');
		$limit	 = 20;

		$list	 = Subscriber::selectRaw('id, name as text')->where('name', 'like', '%'.$q.'%')
					->offset(($page - 1) * $limit)->limit($limit)->get();
		$pagination	 = $list->count() >= $limit;

		return \Response::json(['results' => $list, 'pagination' => ['more' => $pagination]]);
	}

	function sendmessage(Request $request, $id = 0)
	{
		$item = Subscriber::where(['id' => $id])->firstOrFail();

		if($request->method() != 'POST') return \Response::json(['error' => 'POST method only']);

		$platform_name = '\almakano\botsmanager\app\Platforms\\'.ucfirst(strtolower($item->platform_name));
		$platform = new $platform_name(['bot' => $item->bot]);

		$platform->sendMessage([
			'chat_id' => $item->platform_id,
			'text' => $request->input('message'),
			'reply_markup' => json_encode([
				'inline_keyboard' => [
					[
						[
							'text' => 'Yes',
							// 'url' => 'https://'.$_SERVER['HTTP_HOST'].'/botsmanager/bots/'.$item->bot->id.'/receive/telegram',
							'callback_data' => 'Yes',
						],
						[
							'text' => 'No',
							// 'url' => 'https://'.$_SERVER['HTTP_HOST'].'/botsmanager/bots/'.$item->bot->id.'/receive/telegram',
							'callback_data' => 'No',
						],
					],
				],
			], JSON_UNESCAPED_UNICODE),
		]);

		if(!empty($request->input('_ajax')))
			return '<script>$("#form-send-'.$item->id.'").collapse("hide").trigger("reset")</script>';

		return redirect();
	}
}