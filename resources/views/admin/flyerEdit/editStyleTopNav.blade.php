<nav class="pb-3 pt-3 navbar navbar-expand navbar-light">
<div class="styleTopLinkDiv mx-auto">
  <ul class="styleTopLinkGroup navbar-nav mx-auto font-weight-bold">
    <li class="nav-item">
      <i class="fa fa-newspaper-o" aria-hidden="true"></i>
    </li>
    <li class="nav-item topMenuTitle font-weight-bold text-dark2">
      Style
    </li>
    <li class="styleMenuButton z-depth-1 hoverable nav-item
    @if($theTemplate=='s1pc'||$theTemplate=='1pc')
    active
    @endif"
    id="style1_fp" style="text-align:center;">
        1
    </li>
    <li class="styleMenuButton z-depth-1 hoverable
    @if($theTemplate=='s2pb'||$theTemplate=='2pb')
    active
    @endif"
    id="style2_fp" style="text-align:center;">
        2
    </li>
    <li class="styleMenuButton nav-item z-depth-1 hoverable
    @if($theTemplate=='s3pt'||$theTemplate=='3pt')
    active
    @endif"
    id="style3_fp" style="text-align:center;">
        3
    </li>
    <li class="styleMenuButton nav-item z-depth-1 hoverable
    @if($theTemplate=='s4sp'||$theTemplate=='4sp')
    active
    @endif"
    id="style4_fp" style="text-align:center;">
        4
    </li>
    <li class="styleMenuButton styleMenuLastButton nav-item
    z-depth-1 hoverable
    @if($theTemplate=='s5pt'||$theTemplate=='5pt')
    active
    @endif"
    id="style5_fp" style="text-align:center;">
        5
    </li>
    <li>
        <div
        class="ml-3 menuCompleteButton
        styleCompleteButton z-depth-1
        hoverable">
          <i title="Click when finished"
          class="fa fa-check"></i>
        </div>
    </li>
  </ul>
</div>
</nav>
