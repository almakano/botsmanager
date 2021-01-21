<?php
namespace almakano\botsmanager\app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use almakano\botsmanager\app\Logic;

class LogicController extends DefaultController
{

	protected $_model_class_name = '\almakano\botsmanager\app\Logic';
	protected $_views_name = 'logics';

	function run(Request $request, $id = 0) {

		$item = Logic::where(['id' => $id])->firstOrFail();

		$controller = 'almakano\botsmanager\app\Logics\\'.ucfirst($item->controller);
		$controller = new $controller();
		$controller->run();

		if(!empty($request->input('_ajax')))
			return '<script>app.alert({type: "success", text: "Done", timeout: 3500})</script>';

		return 'Done';
	}
}