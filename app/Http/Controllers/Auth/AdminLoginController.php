<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\models\admin\adminTable;

class AdminLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:admin');
    }

    public function showLoginForm(){
      //get campaigns
      include(app_path().'/queries/admin/adminCampaignQueries.php');
      //login page when authentication needed
      return view('auth.adminLogin',[
        'completeCamps' => $completeCamps,
      ]);        
    }

    public function login(Request $request){
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);
      // Attempt to log the user in
      if (Auth::guard('admin')->attempt([
        'adminUN'   => $request->email,
        'password'  => $request->password],$request->remember)){
        //if successful, update lastLogin
        $adminID=auth::guard('admin')->user()->id;
        adminTable::where('id','=',"$adminID")
        ->update([
          'lastLogin'=>\Carbon\Carbon::now(),
        ]);
        //then redirect to their intended location
        return redirect()->intended(route('admin.index'));
      }
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
