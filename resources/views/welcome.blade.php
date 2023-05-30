@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <?php
                  $imageCount = 3; // Number of carousel images
              
                  for ($i = 0; $i < $imageCount; $i++) {
                    $isActive = ($i === 0) ? 'active' : ''; // Set the first image as active
                    echo '<li data-target="#myCarousel" data-slide-to="' . $i . '" class="' . $isActive . '"></li>';
                  }
                  ?>
                </ol>
              
                <!-- Slides -->
                <div class="carousel-inner">
                  <?php
                  $imagePaths = [
                    '../images/img 3.jpg', 
                    '../images/img 2.jpg', 
                    '../images/img 1.jpg']; // Path to carousel images
              
                  foreach ($imagePaths as $index => $imagePath) {
                    $isActive = ($index === 0) ? 'active' : ''; // Set the first image as active
                    echo '<div class="carousel-item ' . $isActive . '">';
                    echo '<img class="d-block w-auto" src="' . $imagePath . '" alt="Carousel Image">';
                    echo '</div>';
                  }
                  ?>
                </div>
              
                <!-- Controls -->
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->
@endsection
