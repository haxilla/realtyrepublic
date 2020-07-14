<?php

namespace App\Http\a0ld\Controllers\rets;
use App\Http\a0ld\Controllers\Controller;
use App\rets\models\retsList;
use App\rets\models\retsLog;
use Request;
use Validator;

class retsController extends Controller
{

   public function __construct()
   {
      $this->middleware('auth:admin');
   }

	public function index(){

		//gets adminID & authLevel
		include(app_path().'/codeClips/getAdminAuth.php');

		//gets all available RETS systems
		$retsList=retslist::all();

		//view
		return view('rets.fullpages.retsIndex',[
			'retsList'	=> $retsList,
		]);

	}

	public function retsAdd(Request $request){

		//gets adminID & authLevel
		include(app_path().'/codeClips/getAdminAuth.php');

		//variable for editing
		$retsEdit=request('retsEdit');

		//validate
		$validator = Validator::make($request::all(), [
			'retsSystem'	=> 'required',
			'retsVersion'	=> 'required',
			'retsURL'		=> 'required|url|bail',
			'mlsName'		=> 'required',
			'retsUname'		=> 'required',
			'retsPswd'		=> 'required',]);

		//if fails send jsonReply
		if ($validator->fails()){
			return response()
				->json([
					'errors'=>$validator->errors()->all(),
				]);}

		// * update or add
		// * depending on retsEdit variable
		if($retsEdit){
			retsList::where('retsID','=',$retsEdit)
			->update([
				'retsSystem'	=> request('retsSystem'),
				'retsVersion'	=> request('retsVersion'),
				'retsURL'		=> request('retsURL'),
				'mlsName'		=> request('mlsName'),
				'retsUname'		=> request('retsUname'),
				'retsPswd'		=> request('retsPswd'),]);
			$function='retsEdit';
		}else{
			retsList::create([
				'retsSystem'	=> request('retsSystem'),
				'retsVersion'	=> request('retsVersion'),
				'retsURL'		=> request('retsURL'),
				'mlsName'		=> request('mlsName'),
				'retsUname'		=> request('retsUname'),
				'retsPswd'		=> request('retsPswd'),]);
			$function='retsAdd';}

		//output json & exit
		$idArray = array(
			'status' 	=> 'success',
			'function'	=> $function,
		);

		echo json_encode($idArray);
		exit();

	}

	public function retsDelete(){

		$retsID=request('retsID');
		if(!$retsID){
			dd('error-line90-retsController');}

		retsList::where('retsID','=',$retsID)
		->delete();

		//output json & exit
		$idArray = array(
			'status' 	=> 'success',
			'function'	=> 'deleted',
			'retsID'	=> $retsID,);

		echo json_encode($idArray);
		exit();
	}

	public function retsDisplay(){
		//get var
		$retsID=request('retsID');
		//error if nonoe
		if(!$retsID){
			dd('error-line112-retsController');}

		//query
		$retsList=retslist::where('retsID','=',$retsID)
		->first();
		//error if none
		if(!$retsList){
			dd('error-line118-retsController');}

		//log history
		$retsLog=retslog::where('retsID','=',$retsID)
		->orderBy('logID','desc')
		->get();

		return view('rets.fullpages.retsDisplay',[
			'retsList'	=> $retsList,
			'retsLog'	=> $retsLog
		]);

	}

  public function GLVAR_datafix(){

    include(app_path().'/rets/matrix/GLVAR/datafix/GLVAR_datafix.php');

  }
}
