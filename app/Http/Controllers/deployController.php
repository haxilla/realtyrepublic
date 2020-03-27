<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;
 
class deployController extends Controller
{
    public function deploy(Request $request)
    {   
        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');
 
        $localToken = config('app.deploy_secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);
        
        if(!$githubHash||!$localHash||!$localToken){
            dd('error-line18-deployController');}

        if (hash_equals($githubHash, $localHash)) {
            $root_path = base_path();
            $process = new Process('cd ' . $root_path . '; ./deploy.sh');

            $process->run(function ($type, $buffer) {
                echo $buffer;
            });
    
        }
     }
}
