<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BotController extends Controller
{

	public function index(Request $request)
	{
		return view('botsmanager::bots.list', ['list' => \almakano\botsmanager\app\Bot::get()]);
	}

	public function edit(Request $request, $id = 0)
	{

		if($id) $item = \almakano\botsmanager\app\Bot::where(['id' => $id])->firstOrFail();
		else $item = new \almakano\botsmanager\app\Bot();

		if($request->method() == 'POST') {

			$item->name		 = $request->input('name');
			$item->logic_id	 = $request->input('logic_id');
			$item->data		 = json_encode($request->input('data'), JSON_UNESCAPED_UNICODE);
			$item->save();

			redirect('');
		}

		return view('botsmanager::bots.edit', ['item' => $item]);
	}

	public function delete(Request $request, $id = 0)
	{

		$item = \almakano\botsmanager\app\Bot::where(['id' => $id])->firstOrFail();

		if($request->method() == 'POST') {
			$item->delete();
			redirect('/botsmanager/bots');
		}

		return view('botsmanager::bots.delete', ['item' => $item]);
	}
}