<?php $__env->startSection('content'); ?>
    <?php $__env->startSection('title', 'BLOO'); ?>

<?php $__env->startPush('css'); ?>



    <?php $__env->stopPush(); ?>
    <div class="hero-wrap">
        <div class="overlay"></div>
        <div class="circle-bg"></div>
        <div class="circle-bg-2"></div>
        <div class="container-fluid">
          <div class="slider-text d-md-flex align-items-center" data-scrollax-parent="true">

            <div class="one-forth pr-md-4 ftco-animate align-self-md-center" data-scrollax=" properties: { translateY: '70%' }">
                <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"> <?php echo e(trans('homme_title')); ?>  </h1>
              <p class="mb-md-5 mb-sm-3" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo e(trans('homme_title_content')); ?></p>
              <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><a href="<?php echo e(route('services')); ?>" class="btn btn-primary px-4 py-3"><?php echo e(trans('homme_title_button')); ?></a> <a href="<?php echo e(route('questionnaire.free')); ?>" class="btn btn-primary px-4 py-3">Créer un sondage</a></p>
            </div>
            <div class="one-half align-self-md-end align-self-sm-center">
                <div class="slider-carousel owl-carousel">
                    <div class="item">
                        <img src="<?php echo e(asset('assets/images/dashboard_full_1.png')); ?>" class="img-fluid img"alt="">
                    </div>
                    <div class="item">
                        <img src="<?php echo e(asset('assets/images/dashboard_full_2.png')); ?>" class="img-fluid img"alt="">
                    </div>
                    <div class="item">
                        <img src="<?php echo e(asset('assets/images/dashboard_full_3.png')); ?>" class="img-fluid img"alt="">
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>



      <section class="ftco-section services-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading"><?php echo e(trans('home_content_section1')); ?></span>
                    <h2 class="mb-4"><?php echo e(trans('home_content_section1_title')); ?></h2><?php echo e(trans('')); ?>

                    <p>
                        <?php echo e(trans('home_content_section1_content')); ?>

                      </p>
                  </div>
          </div>
          <div class="row">
            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
              <div class="media block-6 services d-block text-center">
                <div class="d-flex justify-content-center"><div class="icon"><span class="flaticon-guarantee"></span></div></div>
                <div class="media-body p-2 mt-3">
                  <h3 class="heading"> <?php echo e(trans('home_content_section1_content_p_title_1')); ?> </h3>
                  <p><?php echo e(trans('home_content_section1_content_p')); ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
              <div class="media block-6 services d-block text-center">
                <div class="d-flex justify-content-center"><div class="icon"><span class="flaticon-shield"></span></div></div>
                <div class="media-body p-2 mt-3">
                  <h3 class="heading"><?php echo e(trans('home_content_section1_content_p_title_2')); ?> </h3>
                  <p><?php echo e(trans('home_content_section1_content_p1')); ?></p>
                </div>
              </div>
            </div>
            <div class="col-md-4 d-flex align-self-stretch ftco-animate">
              <div class="media block-6 services d-block text-center">
                <div class="d-flex justify-content-center"><div class="icon"><span class="flaticon-support"></span></div></div>
                <div class="media-body p-2 mt-3">
                  <h3 class="heading"><?php echo e(trans('home_content_section1_content_p_title_3')); ?></h3>
                  <p><?php echo e(trans('home_content_section1_content_p2')); ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <span class="subheading"><?php echo e(trans('prix_title')); ?></span><?php echo e(trans('')); ?>

            <h2 class="mb-4"><?php echo e(trans('prix_content')); ?></h2>
          </div>
        </div>
            <div class="row">
            <div class="col-md-4">
              <div class="block-7">
                <div class="text-center">
                <h2 class="heading"><?php echo e(trans('prix_free')); ?></h2>
                <span class="price"> <span class="number"><?php echo e(trans('prix1')); ?></span></span>
                <span class="excerpt d-block"><?php echo e(trans('prix_offre_freee')); ?></span>
                <a href="<?php echo e(route('questionnaire.free')); ?>" class="btn btn-primary d-block px-3 py-3 mb-4"><?php echo e(trans('prix_btn')); ?></a>


                <h3 class="heading-2 mb-3"><?php echo e(trans('prix_introduc')); ?></h3>

                <ul class="pricing-text">
                  <li><strong><?php echo e(trans('prix_offre_free')); ?></strong> </li>
                  <li><strong><?php echo e(trans('prix_offre_free1')); ?></strong></li>
                  <li><strong><?php echo e(trans('prix_offre_free2')); ?></strong></li>
                  <li><strong><?php echo e(trans('prix_offre_free3')); ?></strong></li>
                  <br>
                  <br>

                  <li>All features</li>
                </ul>
                </div>
              </div>
            </div>

            <div class="col-md-4">
                <div class="block-7">
                  <div class="text-center">
                  <h2 class="heading"><?php echo e(trans('prix_prenuim')); ?></h2>
                  <span class="price"> <span class="number"><?php echo e(trans('prix2')); ?></span></span>
                  <span class="excerpt d-block"><?php echo e(trans('prix_introduc1')); ?></span>
                  <a href="#" class="btn btn-primary d-block px-3 py-3 mb-4"><?php echo e(trans('prix_btn')); ?></a>


                  <h3 class="heading-2 mb-3"><?php echo e(trans('prix_introduc')); ?></h3>

                  <ul class="pricing-text">
                    <li><strong><?php echo e(trans('prix_offre_prenuim')); ?></strong> </li>
                    <li><strong><?php echo e(trans('prix_offre_prenuim1')); ?></strong></li>
                    <li><strong><?php echo e(trans('prix_offre_prenuim2')); ?></strong></li>
                    <li><strong><?php echo e(trans('prix_offre_prenuim3')); ?></strong></li>

                    <li>All features</li>
                  </ul>
                  </div>
                </div>
            </div>


              <div class="col-md-4">
                <div class="block-7">
                  <div class="text-center">
                  <h2 class="heading"><?php echo e(trans('prix_illimite')); ?></h2>
                  <span class="price"> <span class="number"><?php echo e(trans('prix3')); ?></span></span>
                  <span class="excerpt d-block"><?php echo e(trans('prix_introduc1')); ?></span>
                  <a href="#" class="btn btn-primary d-block px-3 py-3 mb-4"><?php echo e(trans('prix_btn')); ?></a>


                  <h3 class="heading-2 mb-3"><?php echo e(trans('prix_introduc')); ?></h3>

                  <ul class="pricing-text">
                    <li><strong><?php echo e(trans('prix_offre_illimite')); ?></strong> </li>
                    <li><strong><?php echo e(trans('prix_offre_illimite1')); ?></strong></li>
                    <li><strong><?php echo e(trans('prix_offre_llimite2')); ?></strong></li>
                    <li><strong><?php echo e(trans('prix_offre_llimite3')); ?></strong></li>

                    <li>All features</li>
                  </ul>
                  </div>
                </div>
              </div>

          </div>
        </div>
    </section>

      <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(assets/images/bg_1.jpg);">
          <div class="container">
              <div class="row justify-content-center mb-5 pb-5">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
              <h2 class="mb-4">Données traitées</h2>
              <span class="subheading">information sur nos  données</span>
            </div>
          </div>
              <div class="row justify-content-center">
                  <div class="col-md-10">
                      <div class="row">
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                      <div class="block-18 text-center">
                        <div class="text">
                          <strong class="number" data-number="+4000">0</strong>
                          <span>données traitées chaque jour… </span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                      <div class="block-18 text-center">
                        <div class="text">
                          <strong class="number" data-number="100">0</strong>
                          <span>questionnaires/jours</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                      <div class="block-18 text-center">
                        <div class="text">
                          <strong class="number" data-number="32000">0</strong>
                          <span>Nombre de  clients</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                      <div class="block-18 text-center">
                        <div class="text">
                          <strong class="number" data-number="31998">0</strong>
                          <span>Nombre d'opérateurs</span>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
          </div>
      </section>



      <section class="ftco-section">
          <div class="container">
              <div class="row justify-content-center mb-5 pb-5">
                  <div class="col-md-7 text-center heading-section ftco-animate">
              <span class="subheading"><?php echo e(trans('home_content_section2')); ?></span>
              <h2 class="mb-4"><?php echo e(trans('home_content_section2_title')); ?></h2>
              <p><?php echo e(trans('home_content_section2_content')); ?></p>
              <p><?php echo e(trans('home_content_section2_content1')); ?></p>
            </div>
              </div>
              <div class="row">

            <div class="col-md-12 align-items-center ftco-animate">

              <div class="tab-content ftco-animate" id="v-pills-tabContent">

                <div class="tab-pane fade show active" id="v-pills-nextgen" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                    <div class="d-md-flex">
                        <div class="one-forth align-self-center">
                            <img src="<?php echo e(asset('assets/images/dashboard_full_1.jpg')); ?>" class="img-fluid border" alt="">
                        </div>
                        <div class="one-half ml-md-5 align-self-center">
                          <h2 class="mb-4"><?php echo e(trans('home_content_section2_content2')); ?></h2>
                            <p><?php echo e(trans('home_content_section2_content3')); ?></p>
                          <p><?php echo e(trans('home_content_section2_content4')); ?></p>
                          <p><?php echo e(trans('home_content_section2_content5')); ?></p>
                          <p><?php echo e(trans('home_content_section2_content6')); ?></p>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          </div>
      </section>

      <section class="ftco-section-parallax">
        <div class="parallax-img d-flex align-items-center">
          <div class="container">
            <div class="row d-flex justify-content-center">
              <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                <h2><?php echo e(trans('home_content_section2_newleter_title')); ?></h2>
                <p><?php echo e(trans('home_content_section2_newleter_body')); ?></p>
                <div class="row d-flex justify-content-center mt-5">
                  <div class="col-md-6">
                    <form action="#" class="subscribe-form">
                      <div class="form-group">
                        <span class="icon icon-paper-plane"></span>
                        <input type="text" class="form-control" placeholder="<?php echo e(trans('home_content_section2_newleter_email')); ?>">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>



<?php $__env->startPush('js'); ?>


    <?php $__env->stopPush(); ?>
    <?php $__env->stopSection(); ?>
     <?php $__env->startSection('scripts'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\kirra belloche\Desktop\bloo\Bloo\resources\views/pages/home.blade.php ENDPATH**/ ?>