<?php

function generateCar($imgPathArray)
{
  $carousel = '
<div id="booking_car"> 
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="' . $imgPathArray[0] . '" class="d-block w-100" alt="Panama 1">
    </div>
    <div class="carousel-item">
      <img src="' . $imgPathArray[1] . '" class="d-block w-100" alt="Panama 2">
    </div>
    <div class="carousel-item">
      <img src="' . $imgPathArray[2] . '" class="d-block w-100" alt="Panama 3">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>';

  return $carousel;
}
