<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LogicController extends Controller
{

	public function index(Request $request)
	{
		return view('botsmanager::logics.list', ['list' => \almakano\botsmanager\app\Logic::get()]);
	}

	public function edit(Request $request, $id = 0)
	{

		if($id) $item = \almakano\botsmanager\app\Logic::where(['id' => $id])->firstOrFail();
		else $item = new \almakano\botsmanager\app\Logic();

		if($request->method() == 'POST') {

			$item->name		 = $request->input('name');
			$item->data		 = json_encode($request->input('data'), JSON_UNESCAPED_UNICODE);
			$item->save();

			redirect('');
		}

		return view('botsmanager::logics.edit', ['item' => $item]);
	}

	public function delete(Request $request, $id = 0)
	{

		$item = \almakano\botsmanager\app\Logic::where(['id' => $id])->firstOrFail();

		if($request->method() == 'POST') {
			$item->delete();
			redirect('/botsmanager/logics');
		}

		return view('botsmanager::logics.delete', ['item' => $item]);
	}
}