<div class="col-lg-6 col-md-6 col-12 propInfoHead">
   <h2>{{$getFlyer[0]->xFullStreet}}</h2>
   <h4>{{$getFlyer[0]->xCity}} , {{$getFlyer[0]->xState}} {{$getFlyer[0]->xxZip}} -
      <b>${{number_format($getFlyer[0]->xListPrice)}}</b>
   </h4>
</div>
<div class="col-lg-6 col-md-6 col-12 buttonFrame">
   <div class="top-links" style="text-align:center;">
      <a style="color:#333;text-decoration:none;"
       href="/propPrint?id={{$getFlyer->first()->theMeta->sk1}}">
         <button class="btn btn-default printer" type="submit"
         style="margin-right:20px;">
            <span class="ti-printer" aria-hidden="true"></span>
            Print
         </button>
      </a>

      <a href="/forwardEmail/{{$getFlyer[0]->id}}">
         <button class="btn btn-default" type="submit"
         style="margin-right:20px;">
            <span class="ti-email" aria-hidden="true"></span>
            Forward
         </button>
      </a>

      <div class="btn-group">

         <button type="button" class="btn btn-default dropdown-toggle"
            data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <span class="ti-comments-smiley" aria-hidden="true"></span>
            Share
         </button>

         <ul class="dropdown-menu">
            <li>
               <a href="/share/facebook/{{$getFlyer[0]->id}}">
                  <i class="fa fa-facebook" aria-hidden="true"
                  style="margin-right:10px;"></i>Facebook
               </a>
            </li>
            <li>
               <a href="/share/twitter/{{$getFlyer[0]->id}}">
                  <i class="fa fa-twitter" aria-hidden="true"
                  style="margin-right:10px;"></i>Twitter
               </a>
            </li>
            <li>
               <a href="/share/pinterest/{{$getFlyer[0]->id}}">
                  <i class="fa fa-pinterest" aria-hidden="true"
                  style="margin-right:10px;"></i>Pinterest
               </a>
            </li>
            <li>
               <a href="/share/google/{{$getFlyer[0]->id}}">
                  <i class="fa fa-google-plus" aria-hidden="true"
                  style="margin-right:10px;"></i>
                  Google Plus
               </a>
            </li>
         </ul>
      </div>
   </div>
</div>


