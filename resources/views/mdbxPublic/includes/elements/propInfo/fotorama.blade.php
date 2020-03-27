<div class="fotorama"
    data-nav="thumbs"
    data-swipe="true"
    data-fit="scaledown"
    data-height=400
    data-width=800
    data-autoplay=5000
    data-thumbheight=90
    data-thumbwidth=115
    data-thumbmargin=3
    data-loop="true">
    @foreach($getFlyer as $the)
        @foreach($the->thePhotos->sortByDesc('def') as $t)
            <?php
                $theHeadline=$getFlyer[0]->xHeadline;
                if(!$theHeadline){
                    $theHeadline=$getFlyer[0]->xxHeadline;}
                $search = '<br>' ;
                $theHeadline = str_replace($search, ' ', $theHeadline); 
            ?>
            <div data-img='/hqphotos/{{$getFlyer[0]
                ->theMeta->zipDir}}/{{$getFlyer[0]
                    ->theMeta->mlsDir}}/{{$t->photoName}}'>
            </div>
        @endforeach
    @endforeach
</div>
