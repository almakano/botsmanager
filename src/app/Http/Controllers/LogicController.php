<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LogicController extends Controller
{

	public function index()
	{
		return view('botsmanager::logics.list', ['list' => \almakano\botsmanager\app\Logic::get()]);
	}

	public function edit($id = 0)
	{

		$item = \almakano\botsmanager\app\logic::where(['id' => $id])->firstOrFail();

		if(Request::method() == 'POST') {

			$item->name		 = Request::input('name');
			$item->data		 = json_encode(Request::input('data'), JSON_UNESCAPED_UNICODE);
			$item->save();

			redirect('');
		}

		return view('botsmanager::logics.edit', ['item' => $item]);
	}

	public function delete($id = 0)
	{

		$item = \almakano\botsmanager\app\logic::where(['id' => $id])->firstOrFail();

		if(Request::method() == 'POST') {
			$item->delete();
			redirect('/botsmanager/logics');
		}

		return view('botsmanager::logics.delete', ['item' => $item]);
	}
}