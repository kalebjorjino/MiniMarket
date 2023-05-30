@extends('layouts.app')

@section('content')
    <!-- ========== title-wrapper start ========== -->
    <div class="title-wrapper pt-30">
        <div class="row align-items-center">
              <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <?php
                  $imagePaths = [
                    '../images/img 3.jpg',
                    '../images/img 2.jpg',
                    '../images/img 5.jpg'
                  ]; // Update with the actual image paths
              
                  foreach ($imagePaths as $index => $imagePath) {
                    $isActive = ($index === 0) ? 'active' : ''; // Set the first image as active
                    echo '<li data-target="#myCarousel" data-slide-to="' . $index . '" class="' . $isActive . '"></li>';
                  }
                  ?>
                </ol>
              
                <!-- Slides -->
                <div class="carousel-inner">
                  <?php
                  foreach ($imagePaths as $index => $imagePath) {
                    $isActive = ($index === 0) ? 'active' : ''; // Set the first image as active
                    echo '<div class="carousel-item ' . $isActive . '">';
                    echo '<img class="d-block w-100" src="' . $imagePath . '" alt="Carousel Image">';
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

            <section class="banner" style="margin:5em;">
                <h1 style="display: block; font: 900 3em Lato; text-align:center;">Welcome to the SAMJ Korean Mini Mart</h1>
                <p style="display: block; font: 300 2em Lato; text-align:center;">Discover the authentic taste of Korea at our store.</p>
                <div class="button-group d-flex justify-content-center flex-wrap">
                    <a href="#" class="main-btn primary-btn btn-hover w-auto text-center" style="padding: 10px; font-size:1.3em; background-color: #2d32cd; text-align:center;">Shop Now!</a>
                </div>
            </section>
            
        </div>
        <!-- end row -->
    </div>
    <!-- ========== title-wrapper end ========== -->
@endsection
