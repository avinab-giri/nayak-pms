<?php

include('../include/constant.php');
include(SERVER_INCLUDE_PATH . 'db.php');
include(SERVER_INCLUDE_PATH . 'function.php');
include(SA_SERVER_SCREEN_PATH . 'svg.php');

checkLoginAuth();
checkProductExistOrNot([2], 15);
$hotelName = ucfirst(hotelDetail()['hotelName']);

$backLink = FRONT_SITE;
if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
  $backLink = $_SERVER['HTTP_REFERER'];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="">
  <meta name="description" content="">

  <title>Web Builder</title>

  <?php include(FO_SERVER_SCREEN_PATH . 'link.php') ?>


</head>

<body class="g-sidenav-show  bg-gray-100">

  <?php include(FO_SERVER_SCREEN_PATH . 'sidebar.php') ?>

  <?php include(FO_SERVER_SCREEN_PATH . 'navbar.php') ?>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg scrollBar">



    <div class="container py-2">

      <div class="row">
        <?php
        $sliderUrl = FRONT_SITE . '/wb/slider';
        $galleryUrl = FRONT_SITE . '/wb/gallery';
        $blogUrl = FRONT_SITE . '/wb/blog';
        $offerUrl = FRONT_SITE . '/wb/offer';
        $feedbackUrl = FRONT_SITE . '/wb/feedback';

        $navHtml = '<div class="dFlex aic jce wAuto" >
                                    <a href="' . $sliderUrl . '"><button type="button" class="btn bg-gradient-info mt-1 me-2 mb-1">Slider</button></a>
                                    <a href="' . $galleryUrl . '"><button type="button" class="btn bg-gradient-primary mt-1 me-2 mb-1">Gallery</button></a>
                                    <a href="' . $blogUrl . '"><button type="button" class="btn bg-gradient-secondary mt-1 me-2 mb-1">Blog</button></a>
                                    <a href="' . $offerUrl . '" type="button" class="btn bg-gradient-warning mt-1 me-2 mb-1">Offer</a>
                                    <a href="' . $feedbackUrl . '"><button type="button" class="btn bg-gradient-success mt-1 me-2 mb-1">Feedback</button></a>
                                </div>';
        echo backNavbarUi('', 'Web Builder', $navHtml);
        ?>


        <div class="row mb-4">
          <div class="col-md-9">
            <div class="row">

              <div class="col-md-12 mb-4">
                <div class="card ">
                  <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                      <a href="<?= FRONT_SITE . '/wb/slider' ?>">
                        <h6 class="mb-2">Recent Sliders</h6>
                      </a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table align-items-center ">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Title</th>
                          <th>Subtitle</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        if (count(getSlider('', 5)) > 0) {
                          foreach (getSlider('', 5) as $slideList) {

                            $id = $slideList['id'];
                            $title = $slideList['title'];
                            $subtitle = $slideList['subTitle'];
                            $img = (isset(getHotelImageData('', '', '', '', $slideList['img'])[0])) ? getHotelImageData('', '', '', '', $slideList['img'])[0] : getHotelImageData('', '', '', '', $slideList['img']);
                            $imgName = (isset($img['fullUrl'])) ? $img['fullUrl'] : $img['image'];
                            $status = $slideList['status'];


                            echo '
                                                    
                                                        <tr>
                                                          <td class="w-30">
                                                              <div class="d-flex px-2 py-1 align-items-center">
                                                                <div>
                                                                  <img width="80px" src="' . $imgName . '" alt="">
                                                                </div>
                                                              </div>
                                                            </td>
                                                          <td class="w-30">
                                                            <div class="d-flex px-2 py-1 align-items-center">
                                                              <div class="ms-4">
                                                                <h6 class="text-sm mb-0">' . $title . '</h6>
                                                              </div>
                                                            </div>
                                                          </td>
                                                          <td>
                                                            <div class="text-center">
                                                              <h6 class="text-sm mb-0">' . $subtitle . '</h6>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                    
                                                    ';
                          }
                        } else {
                          echo '
                                                  <tr>
                                                    <td colspan="3"> No data </td>
                                                  </tr>
                                                  ';
                        }


                        ?>


                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col-md-8 mb-4">
                <div class="card">
                  <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                      <a href="<?= FRONT_SITE . '/wb/blog' ?>">
                        <h6 class="mb-2">Recent Blog</h6>
                      </a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th>Blog</th>
                          <th>Category</th>
                          <th>Description</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if (count(getWbBlogData('', 5)) > 0) {
                          foreach (getWbBlogData('', 5) as $blogList) {

                            $id = $blogList['id'];
                            $title = $blogList['title'];
                            $category = $blogList['category'];
                            $description = $blogList['description'];
                            $img = FRONT_SITE_IMG . 'post/' . $blogList['img'];

                            echo '
                                                      
                                                      <tr>
                                                        <td>
                                                          <div class="d-flex px-2">
                                                            <div>
                                                              <img src="' . $img . '" class="avatar avatar-sm rounded-circle me-2">
                                                            </div>
                                                            <div class="my-auto">
                                                              <h6 class="mb-0 text-xs">' . $title . '</h6>
                                                            </div>
                                                          </div>
                                                        </td>
                                                        <td>
                                                          <p class="text-xs font-weight-bold mb-0">' . $category . '</p>
                                                        </td>
                                                        <td>
                                                          <p>' . $description . '</p>
                                                        </td>
                                                      </tr>
                                                      
                                                      ';
                          }
                        } else {
                          echo '
                                                      
                                                      <tr>
                                                        <td colspan="3">No Data</td>
                                                      </tr>
                                                      
                                                      ';
                        }


                        ?>


                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <div class="col-md-4 mb-4">

                <div class="card">
                  <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                      <a href="<?= FRONT_SITE . '/wb/gallery' ?>">
                        <h6 class="mb-2">Recent Gallery</h6>
                      </a>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

                      <div class="carousel-indicators">
                        <?php
                        $si = 0;
                        foreach (getWbGalleryData('', 5) as $galleryList) {
                          $si++;
                          $asi = $si - 1;
                          $active = '';
                          if ($si == 1) {
                            $active = 'active';
                          }
                          echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="' . $asi . '"
                                                    class="' . $active . '" aria-current="true" aria-label="Slide ' . $si . '"></button>';
                        }

                        ?>
                      </div>

                      <div class="carousel-inner">
                        <?php
                        $si = 0;
                        if (count(getWbGalleryData('', 5)) > 0) {
                          foreach (getWbGalleryData('', 5) as $galleryList) {
                            $si++;
                            $img = FRONT_SITE_IMG . 'gallery/' . $galleryList['img'];
                            $active = '';
                            if ($si == 1) {
                              $active = 'active';
                            }
                            echo '
                                                      <div class="carousel-item ' . $active . '">
                                                        <img src="' . $img . '" class="d-block w-100" alt="">
                                                      </div>
                                                      ';
                          }
                        } else {
                          echo '
                                                      <div> No Data</div>
                                                      ';
                        }


                        ?>


                      </div>

                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="row">
              <div class="col-md-12 mb-4">
                <div class="card">
                  <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                      <a href="<?= FRONT_SITE . '/wb/offer' ?>">
                        <h6 class="mb-2">Offer Section</h6>
                      </a>
                    </div>
                  </div>
                  <?php

                  $offerList = getWbOfferData('', 1);


                  if (count($offerList) > 0) {
                    $id = $offerList['id'];
                    $title = $offerList['title'];
                    $price = $offerList['price'];
                    $percentage = $offerList['percentage'];
                    $description = $offerList['description'];
                    $code = $offerList['code'];
                    $img = FRONT_SITE_IMG . 'offer/' . $offerList['img'];
                  } else {
                    $id = '';
                    $title = 'Null';
                    $price = '0';
                    $percentage = '0';
                    $description = '';
                    $code = 'Null';
                    $img =  FRONT_SITE_IMG . 'demo/offerSection.gif';
                  }

                  echo '
                                        <img class="card-img-top"
                                        src="' . $img . '">
                                        <div class="position-relative"
                                          style="height: 50px;overflow: hidden;margin-top: -50px;z-index:2;position: relative;">
                                          <div class="position-absolute w-100 top-0" style="z-index: 1;">
                                            <svg class="waves waves-sm" xmlns="http://www.w3.org/2000/svg"
                                              xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none"
                                              shape-rendering="auto">
                                              <defs>
                                                <path id="card-wave"
                                                  d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
                                              </defs>
                                              <g class="moving-waves">
                                                <use xlink:href="#card-wave" x="48" y="-1" fill="rgba(255,255,255,0.30"></use>
                                                <use xlink:href="#card-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
                                                <use xlink:href="#card-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
                                                <use xlink:href="#card-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
                                                <use xlink:href="#card-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
                                                <use xlink:href="#card-wave" x="48" y="16" fill="rgba(255,255,255,0.99)"></use>
                                              </g>
                                            </svg>
                                          </div>
                                        </div>
                                        <div class="card-body">
                                          <h4>
                                            ' . $title . '
                                          </h4>
                                          <p>
                                            ' . $description . '
                                          </p>
                                          <div class="d-flex justify-content-between">
                                          <a href="javascript:void(0);" class="text-primary icon-move-right">' . $price . '( ' . $percentage . ' % )</a>
                                          <p>' . $code . '</p>
                                          </div>
                                          
                                        </div>
                                        ';

                  ?>

                </div>
              </div>
              <div class="col-md-12 mb-4">
                <div class="card">
                  <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                      <a href="<?= FRONT_SITE . '/wb/feedback' ?>">
                        <h6 class="mb-2">Recent Feedback</h6>
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table align-items-center mb-0">
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                              Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                              Rating</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                              Description</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (count(getWbFeedbackData('', 5)) > 0) {
                            foreach (getWbFeedbackData('', 5) as $blogList) {

                              $id = $blogList['id'];
                              $name = $blogList['name'];
                              $rating = $blogList['rating'];
                              $description = $blogList['description'];
                              $img = FRONT_SITE_IMG . 'feedback/' . $blogList['img'];

                              echo '
                                                            
                                                            <tr>
                                                              <td>
                                                                <div class="d-flex px-2">
                                                                  <div>
                                                                    <img src="' . $img . '" class="avatar avatar-sm rounded-circle me-2">
                                                                  </div>
                                                                  <div class="my-auto">
                                                                    <h6 class="mb-0 text-xs">' . $name . '</h6>
                                                                  </div>
                                                                </div>
                                                              </td>
                                                              <td>
                                                                <p class="text-xs font-weight-bold mb-0">' . $rating . '</p>
                                                              </td>
                                                              <td>
                                                                <p>' . $description . '</p>
                                                              </td>
                                                            </tr>
                                                            
                                                            ';
                            }
                          } else {
                            echo " <tr><td colspan='3'>No Data</td> </tr> ";
                          }


                          ?>


                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    </div>

    <div id="configurationForm" class="show"></div>

  </main>

  <?php include(FO_SERVER_SCREEN_PATH . 'footer.php') ?>



  <?php include(FO_SERVER_SCREEN_PATH . 'script.php') ?>



  <?php



  ?>
  <script>
    $('.linkBtn').removeClass('active');
    $('.wbLink').addClass('active');
  </script>

</body>

</html>