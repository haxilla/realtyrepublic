<!DOCTYPE html>
<html lang="en">

@include('mdbxPublic.headersFooters.pubHeaderSkinny')

<body style="font-family:Roboto">
	<!--Navbar-->
	@include('mdbxPublic.navigation.pubNavTopSolidBlue_noLinks')
	<!--Main-->
	<div class="row">
		<div class="col-12 fixed-top" style="padding:15px;padding-top:80px;
		background:#eee;padding-left:50px;">
			<h6 style="color:#223e94;padding:0;margin:0;">
				Welcome {{$agentInfo['agtFullName']}}!
			</h6>
		</div>
	</div>
	<div class="row" style="margin:0;margin-top:155px;padding:50px;padding-top:0;">
		<div class="col-lg-3 noPad" style="background:#eee;">
			@include('mdbxMember.sections.resetPasswordNotice')
		</div>
		<div class="col-lg-9 noPad">
			@include('mdbxMember.sections.passwordChangeForm')
		</div>
	</div>
	<div>
		@include('mdbxPublic.sections.publicFooter')
	</div>
</body>