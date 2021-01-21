<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DefaultController extends Controller
{

	protected $_model_class_name = '\almakano\botsmanager\app\Default';
	protected $_views_name = 'defaults';

	function index(Request $request)
	{

		$sorts = [];
		$keys = \Schema::getColumnListing(with(new $this->_model_class_name)->getTable());
		foreach($keys as $key) {
			$sorts[] = $key.' desc';
			$sorts[] = $key;
		}
		$sort = $request->input('sort') ?? 0;
		$filter = [];

		foreach($request->all() as $k => $v) {
			if(!in_array($k, $keys)) continue;
			if(is_array($v))
				$filter[] = [$k, 'in', $v];
			else if(is_int($v))
				$filter[] = [$k, 'in', [$v]];
			else
				$filter[] = [$k, 'like', $v.'%'];
		}

		$list = $this->_model_class_name::where($filter)->orderByRaw($sorts[$sort])->get();

		return view('botsmanager::'.$this->_views_name.'.list', [
			'list' => $list,
			'sort' => $sort,
			'sorts' => $sorts,
		]);
	}

	function edit(Request $request, $id = 0)
	{

		if($id) $item = $this->_model_class_name::where(['id' => $id])->firstOrFail();
		else $item = new $this->_model_class_name();

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

		return view('botsmanager::'.$this->_views_name.'.edit', ['item' => $item]);
	}

	function delete(Request $request, $id = 0)
	{

		$item = $this->_model_class_name::where(['id' => $id])->firstOrFail();

		if($request->method() == 'POST') {

			$item->delete();

			if(!empty($request->input('_ajax')))
				return '<script>app.alert({type: "success", text:"Done", timeout: 3500}); app.refreshList()</script>';

			return redirect()->action([static::class, 'index']);
		}

		return view('botsmanager::'.$this->_views_name.'.delete', ['item' => $item]);
	}

	function autocomplete(Request $request, $id = 0)
	{

		$q		 = $request->input('q');
		$page	 = (int) $request->input('page');
		$limit	 = 20;

		$list	 = $this->_model_class_name::selectRaw('id, name as text')->where('name', 'like', '%'.$q.'%')
					->offset(($page - 1) * $limit)->limit($limit)->get();
		$pagination	 = $list->count() >= $limit;

		return \Response::json(['results' => $list, 'pagination' => ['more' => $pagination]]);
	}

	function multiple(Request $request, $action = '')
	{

		$list = $this->_model_class_name::whereIn('id', $request->input('id'))->get();

		if($request->method() == 'POST') {

			foreach($list as $i) {
				$i->$action();
			}

			if(!empty($request->input('_ajax')))
				return '<script>app.alert({type: "success", text:"Done", timeout: 3500}); app.refreshList()</script>';

			return redirect()->action([static::class, 'index']);
		}

		return view('botsmanager::'.$this->_views_name.'.delete', ['item' => $item]);
	}
}