<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BotController extends Controller
{

	public function index()
	{
		return view('botsmanager::bots.index', ['list' => \almakano\botsmanager\app\Bot::get()]);
	}

	public function edit($id = 0)
	{

		$item = \almakano\botsmanager\app\Bot::where(['id' => $id])->firstOrFail();

		if(Request::method() == 'POST') {

			$item->name		 = Request::input('name');
			$item->logic_id	 = Request::input('logic_id');
			$item->data		 = json_encode(Request::input('data'), JSON_UNESCAPED_UNICODE);
			$item->save();

			redirect('');
		}

		return view('botsmanager::bots.edit', ['item' => $item]);
	}

	public function delete($id = 0)
	{

		$item = \almakano\botsmanager\app\Bot::where(['id' => $id])->firstOrFail();

		if(Request::method() == 'POST') {
			$item->delete();
			redirect('/botsmanager/bots');
		}

		return view('botsmanager::bots.delete', ['item' => $item]);
	}
}