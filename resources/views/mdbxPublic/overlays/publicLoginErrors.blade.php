@if($errors->any())
  <div class="alert alert-warning">
    @foreach ($errors->all() as $error)
      <div>
        {{$error}}
      </div>
    @endforeach
  </div>
@endif
@if(\Session::get('msg')=='loginFail')
  <div class="alert alert-warning">
    <div>
      Login Failed!
    </div>
    <div>
      Incorrect Username or Password
    </div>
  </div>
@endif
