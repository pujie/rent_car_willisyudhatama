<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 100%;
      margin: auto;
  }
  .carousel-indicators{
	 display:none;
  }
</style>

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="<?php echo assets_url();?>images/b1.jpg">
            <div class="carousel-caption">
                <h3>"Some beautiful paths can't be discovered without getting lost."</h3>
                <p>Erol Ozan</p>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo assets_url();?>images/b2.jpg">
            <div class="carousel-caption">
                <h3>"Just because you're sober, don't think you're a good driver."</h3>
                <p>John Irving</p>
            </div>
        </div>
        <div class="item">
            <img src="<?php echo assets_url();?>images/b3.jpg">
            <div class="carousel-caption">
                <h3>"I called for backup, but they didn’t put the car in reverse."</h3>
                <p>Jarod Kintz</p>
            </div>
        </div>
    </div>
</div>
<br>