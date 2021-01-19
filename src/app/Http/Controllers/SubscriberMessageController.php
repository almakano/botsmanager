<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use almakano\botsmanager\app\Subscriber;
use almakano\botsmanager\app\SubscriberMessage;

class SubscriberMessageController extends Controller
{

	function index(Request $request)
	{

		$sorts = [];
		$keys = \Schema::getColumnListing(with(new SubscriberMessage)->getTable());
		foreach($keys as $key) {
			$sorts[] = $key.' desc';
			$sorts[] = $key;
		}
		$sort = $request->input('sort') ?? 0;
		$filter = [];

		foreach($request->all() as $k => $v) {
			if(in_array($k, $keys)) $filter[] = [$k, 'like', $v.'%'];
		}

		return view('botsmanager::subscribermessage.list', [
			'list' => SubscriberMessage::where($filter)->orderByRaw($sorts[$sort])->get(),
			'sort' => $sort,
			'sorts' => $sorts,
		]);
	}

	function edit(Request $request, $id = 0)
	{

		if($id) $item = SubscriberMessage::where(['id' => $id])->firstOrFail();
		else $item = new SubscriberMessage();

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

		return view('botsmanager::subscribermessage.edit', ['item' => $item]);
	}

	function delete(Request $request, $id = 0)
	{

		$item = SubscriberMessage::where(['id' => $id])->firstOrFail();

		if($request->method() == 'POST') {
			$item->delete();

			if(!empty($request->input('_ajax')))
				return '<script>location.href="'.action([static::class, 'index']).'"; </script>';

			return redirect()->action([static::class, 'index']);
		}

		return view('botsmanager::subscribermessage.delete', ['item' => $item]);
	}

	function autocomplete(Request $request, $id = 0)
	{

		$q		 = $request->input('q');
		$page	 = (int) $request->input('page');
		$limit	 = 20;

		$list	 = SubscriberMessage::selectRaw('id, name as text')->where('name', 'like', '%'.$q.'%')
					->offset(($page - 1) * $limit)->limit($limit)->get();
		$pagination	 = $list->count() >= $limit;

		return \Response::json(['results' => $list, 'pagination' => ['more' => $pagination]]);
	}
}