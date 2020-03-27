<!DOCTYPE html>
<html lang="en">

@include('mdbxPublic.headersFooters.pubHeaderSkinny')

<body style="font-family:Roboto">
	<!--Navbar-->
	@include('mdbxPublic.navigation.pubNavTopSolidBlue')
	<div style="margin:100px;">
		@include('mdbxPublic.includes.forms.trialAgentDisplay')
	</div>
	<div>
		@include('mdbxPublic.includes.sections.publicFooter')
	</div>
</body>