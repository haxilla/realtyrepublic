<form method="POST" action="/member/login" class="clearForm"
id="memberLoginForm">
    {{ csrf_field() }}
    <fieldset class="form-group">
        <div>
            <div style="width:100%;min-width:300px;">
                <div style="width:10%;display:inline-block;">
                    <span 
                    class="ti-email textGradient-purpleBlue1"
                    style="font-size:18pt;"></span>
                </div>
                <div style="width:85%;display:inline-block;">
                    <input
                    style="border:none;width:100%;
                    margin-bottom:10px;"
                    placeholder="Username"
                    name="agtUname"
                    id="agtUnameLoginModal"
                    class="modInputMsg form-control"
                    type="email"
                    value="{{old('agtUname')}}"
                    required>
                </div>
            </div>
            <div style="width:100%;">
                <div style="width:10%;display:inline-block;">
                    <span 
                    class="ti-lock textGradient-purpleBlue1"
                    style="font-size:18pt;"></span>
                </div>
                <div style="width:85%;display:inline-block;">
                    <input
                    style="border:none;width:100%;
                    margin-bottom:10px;"
                    placeholder="Password"
                    name="password"
                    id="thePasswordLoginModal"
                    class="modInputMsg form-control"
                    type="password"
                    value="{{old('password')}}"
                    required>
                </div>
            </div>
            <div class="loginCaptchaRequired" style="display:none;">
                @include('mdbxPublic.includes.elements.captchav2')
            </div>
            <div style="margin-top:15px;">
                <label>
                    <input name="rememberMe"
                    type="checkbox"
                    id="rememberMeLogin">
                    Remember Me
                </label>
            </div>
            <div style="margin-top:15px;">
                @include('mdbxPublic.includes.elements.solidBlueLoginSubmit')
            </div>
        </div>
    </fieldset>
    <input type="hidden" name="fromForm" value="loginModal"
    id="loginModalFromForm">
</form>