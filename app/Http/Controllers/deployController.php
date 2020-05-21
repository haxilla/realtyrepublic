<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;

#got this working per this website
#https://medium.com/@gmaumoh/laravel-how-to-automate-deployment-using-git-and-webhooks-9ae6cd8dffae

class deployController extends Controller
{
    public function deploy(Request $request)
    {

        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');

        $localToken = config('app.deploy_secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);

        if(!$githubHash||!$localHash||!$localToken){
            dd('error-line18-deployController-remstage');}


        if (hash_equals($githubHash, $localHash)) {

          //set variable
      		$json=$_POST['payload'];
      		$payload=json_decode($json);
      		$ref=$payload->ref;

          //if master branch
      		if($ref=='refs/heads/master'){

            //updated for new laravel version
            $root_path = base_path();
            $process = Process::fromShellCommandline('cd ' . $root_path . '; ./deploy.sh');
            $process->run(function ($type, $buffer) {
                echo $buffer;
            });

      		}else{

            //NOT ON MASTER BRANCH
			      echo "$ref - Nothing pulled - Not on Master Branch";

		      }

	     }else{

         //invalid hash
         //to view uncomment below
         //echo $localToken;
         echo "INVALID HASH!";
         exit();

       }
    }
}
