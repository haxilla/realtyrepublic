<form role="form" method="POST" 
action="{{ route('admin.login.submit') }}">
    {{csrf_field()}}
    <div>
        <div>
            <!-- Header -->
            <div class="text-center">
                <h5>
                    <i class="ti-user"></i>
                    Sign In
                </h5>
            </div>
            <!-- Body -->
            <div style="margin-top:15px;">
                <label>Username</label>
                <i class="fa fa-envelope prefix white-text"></i>
                <input name="email" type="text" 
                id="adminEmail" 
                class="form-control"
                style="width:100%;">
            </div>

            <div style="margin-top:15px;">
                <label>Password</label>
                <i class="fa fa-lock prefix white-text"></i>
                <input name="password" type="password" 
                id="adminPassword" 
                class="form-control"
                style="width:100%;">
            </div>

            <div class="text-center mt-4">
                <button style="background:rgba(255,255,255,.1);
                color:#fff;border:1px solid #fff;padding:5px 15px;
                border-radius:2em;margin-bottom:10px;">
                    Log in
                </button>
            </div>

        </div>
    </div>
</form>