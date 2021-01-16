<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use almakano\botsmanager\app\Logic;

class LogicController extends Controller
{

	function index(Request $request)
	{
		return view('botsmanager::logics.list', ['list' => Logic::get()]);
	}

	function edit(Request $request, $id = 0)
	{

		if($id) $item = Logic::where(['id' => $id])->firstOrFail();
		else $item = new Logic();

		if($request->method() == 'POST') {

			$item->name		 = $request->input('name');
			$item->data		 = json_encode($request->input('data'), JSON_UNESCAPED_UNICODE);
			$item->save();

			redirect('');
		}

		return view('botsmanager::logics.edit', ['item' => $item]);
	}

	function delete(Request $request, $id = 0)
	{

		$item = Logic::where(['id' => $id])->firstOrFail();

		if($request->method() == 'POST') {
			$item->delete();
			redirect('/botsmanager/logics');
		}

		return view('botsmanager::logics.delete', ['item' => $item]);
	}

	function autocomplete(Request $request, $id = 0)
	{

		$q		 = $request->input('q');
		$page	 = $request->input('page');
		$limit	 = 20;

		$list	 = Logic::selectRaw('id, name as text')->where('name', 'like', '%'.$q.'%')
					->offset(($page - 1) * $limit)->limit($limit)->get();
		$pagination	 = $list->count() >= $limit;

		return \Response::json(['results' => $list, 'pagination' => ['more' => $pagination]]);
	}
}