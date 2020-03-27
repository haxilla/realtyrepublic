<!doctype html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<script type="text/javascript">
	function getQueryVariable(variable){
		var query = window.location.search.substring(1);
		var vars = query.split("&");
		for (var i=0;i<vars.length;i++) {
		      var pair = vars[i].split("=");
		      if(pair[0] == variable){return pair[1];}
		}
		return(false);
	}
	var id=getQueryVariable("id");
	window.print();
	setTimeout("closePrintView()", 2000);
	function closePrintView() {
        document.location.href = '/propInfo?id='+id;
    }
</script>
<div style="width:725px;height:961px;">
	<div style="height:81px;padding:10px;background-color:#ccc;color:#000;
	width:100%;box-sizing: border-box;margin-bottom:5px;text-align:center;
	border:1px solid #ccc;">
		<div style="float:left;width:75%">
			<div>
				<div>
					<h1 style="padding:0;margin:0;">
						{{ $propInfo->xFullStreet }}
					</h1>
				</div>
			</div>
			<div style="font-size:14pt;">
				@if($propInfo->xZip)
					{{ $propInfo->xCity }}, {{ $propInfo->xState }} {{ $propInfo->xZip }}
				@else
					{{ $propInfo->xCity }}, {{$propInfo->xState}}, {{$propInfo->xxZip}}
				@endif
			</div>
		</div>
		<div style="float:left;width:25%;">
			<div style="font-size:16pt;font-weight:bold;padding-top:10px;margin-bottom:10px;text-align:center;">
				${{ number_format($propInfo->xListPrice) }}
			</div>
		</div>
		<div style="clear:both;">
		</div>
	</div>
	<div style="float:left;width:458px;box-sizing:border-box;">
		<div>
			<img style="width:100%;height:307px;margin:0;padding:0;" src="/hqphotos/{{$propMetas->zipDir }}/{{ $propMetas->mlsDir }}/{{$defPhotoName }}">
		</div>
		<div style="border:1px solid #ccc;width:100%;height:565px;position:relative;">
			<div style="color:#000;padding:10px;padding-left:20px;font-size:14pt;font-weight:bold;">
				<img src="/images/fairhousing.gif" style="height:20px;padding-right:10px;"> | MLS#: {{ $propInfo->xMlsNum }} | {{ $propInfo->xxBeds }} Beds | {{ $propInfo->xxBaths }} Baths | {{ $propInfo->xxSqft }} Sqft.
			</div>
			<div>
				<div>
					<ul style="margin-bottom:0;padding-bottom:0;height:72px;margin-top:15px;overflow:hidden;">
						@if($propInfo->theRemarks['xb1'])
							<li>
								{{ $propInfo->theRemarks['xb1'] }}
							</li>
						@endif
						@if($propInfo->theRemarks['xb2'])
							<li>
								{{$propInfo->theRemarks['xb2']}}
							</li>
						@endif
						@if($propInfo->theRemarks['xb3'])
							<li>
								{{$propInfo->theRemarks['xb3']}}
							</li>
						@endif
						@if($propInfo->theRemarks['xb4'])
							<li>
								{{$propInfo->theRemarks['xb4']}}
							</li>
						@endif
						</ul>
					</div>
					<div>
						<ul style="margin-top:0;padding-top:0;height:72px;margin-bottom:15px;overflow:hidden;">
						@if($propInfo->theRemarks['xb5'])
							<li>
								{{$propInfo->theRemarks['xb5']}}
							</li>
						@endif
						@if($propInfo->theRemarks['xb6'])
							<li>
								{{$propInfo->theRemarks['xb6']}}
							</li>
						@endif
						@if($propInfo->theRemarks['xb7'])
							<li>
								{{$propInfo->theRemarks['xb7']}}
							</li>
						@endif
						@if($propInfo->theRemarks['xb8'])
							<li>
								{{$propInfo->theRemarks['xb8']}}
							</li>
						@endif
					</ul>
				</div>
				<div style="clear:both;">
				</div>
			</div>
			<div style="padding-left:20px;padding-right:20px;height:{{ $remHeight }}px;overflow:hidden;">
				{{$propInfo->theRemarks['xPubRemarks']}}
			</div>
			<div style="padding:10px;padding-left:20px;font-weight:bold;">
				More info online! RealtyEmails.com - Enter ID# {{ $propMetas->sysID }}
			</div>
			<div style="margin:20px;margin-top:10px;height:100px;position:absolute;bottom:0;overflow:hidden;">
				@if($agentInfo->agtPhoto)
					<div style="display:inline-block;vertical-align:bottom;height:100%;padding-right:10px;">
						@if(isset($photoInfo->newRemID))
						 <img src="/agentPhotos/{{$photoInfo->newRemID}}/{{$accountInfo->agtPhoto}}"
						 style="height:100px;">
						@else
						 <img src="/hqoffice/{{$accountInfo->officeID}}/{{$accountInfo->agtPhoto}}"
						 style="height:100px;">
						@endif
					</div>
				@endif
				<div style="display:inline-block;">
					<div>
						<div style="font-weight:bold;font-size:14pt;">
							{{ $agentInfo->agtFullName }}
						</div>
						<div style="font-size:12pt;">
							{{ $agentInfo->theAgtOffice['officeName']}}
						</div>
						<div>
							{{ $agentInfo->theAgtOffice['officeAddress1']}}
						</div>
						<div>
							{{ $agentInfo->theAgtOffice['officeCity']}}, {{$agentInfo->theAgtOffice['officeState']}}
							{{$agentInfo->theAgtOffice['officeZip']}}
						</div>
						<div style="font-size:12pt;">
							{{ $agentInfo->agtMainPhone}}
						</div>
						<div style="font-size:12pt;">
							{{ $agentInfo->agtWeb }}
						</div>
					</div>
				</div>
				@if($agentInfo->agtLogo)
					<div style="display:inline-block;padding-left:10px;">
						<img width="75" src="http://www.realtyemails.com/officeLogos/{{$agentInfo
							->theAgtOffice['officeID']}}/{{$agentInfo
								->agtLogo}}">
					</div>
				@endif
			</div>
		</div>
	</div>
	<div style="float:right;width:262px;text-align:center;box-sizing:border-box;margin:0;padding:0;">
		@foreach( $photos->take(5) as $photo)
			<div>
				<img src="/hqphotos/{{ $propMetas->zipDir }}/{{ $propMetas->mlsDir }}/{{ $photo->photoName }}" width="100%" style="height:172px;">
			</div>
		@endforeach
	</div>
	<div style="clear:both;">
	</div>
</div>
