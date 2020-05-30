<?php $__env->startSection('content'); ?>
    <?php $__env->startSection('title', 'BLOO'); ?>

<?php $__env->startPush('css'); ?>



    <?php $__env->stopPush(); ?>



    <!-- <div class="js-fullheight"> -->
        <div class="hero-wrap">
          <div class="overlay"></div>
          <div class="circle-bg"></div>
          <div class="circle-bg-2"></div>
          <div class="container-fluid">
            <div class="row no-gutters d-flex slider-text align-items-center justify-content-center" data-scrollax-parent="true">
              <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="<?php echo e(route('home')); ?>"><?php echo e(trans('home_fil')); ?></a></span> <span><?php echo e(trans('prix_fil')); ?></span></p>
                <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo e(trans('prix_fil')); ?></h1>
              </div>
            </div>
          </div>
        </div>

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

                        <li>Toutes les fonctionalitées</li>
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

                        <li>Toutes les fonctionalitées</li>
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

                          <li>Toutes les fonctionalitées</li>
                      </ul>
                      </div>
                    </div>
                  </div>

              </div>
            </div>
        </section>

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
                <div class="row justify-content-center mb-5">
              <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading"><?php echo e(trans('service_section_header')); ?></span>
                <h2 class="mb-4"><?php echo e(trans('service_section_tetle')); ?></h2>
                <p><?php echo e(trans('service_section_content')); ?></p>
              </div>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="accordion">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                    <div class="card-header">
                                              <a class="card-link" data-toggle="collapse"  href="#menuone" aria-expanded="true" aria-controls="menuone"><?php echo e(trans('service_section_content_question')); ?> <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                                    </div>
                                    <div id="menuone" class="collapse show">
                                      <div class="card-body">
                                                    <p><?php echo e(trans('service_section_content1')); ?></p>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="card">
                                    <div class="card-header">
                                              <a class="card-link" data-toggle="collapse"  href="#menutwo" aria-expanded="false" aria-controls="menutwo"><?php echo e(trans('service_section_content_question1')); ?> <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                                    </div>
                                    <div id="menutwo" class="collapse">
                                      <div class="card-body">
                                                    <p><?php echo e(trans('service_section_content2')); ?></p>
                                                    <p><?php echo e(trans('service_section_content21')); ?></p>
                                      </div>
                                    </div>
                                  </div>


                                </div>

                                <div class="col-md-6">

                                    <div class="card">
                                        <div class="card-header">
                                                  <a class="card-link" data-toggle="collapse"  href="#menu3" aria-expanded="false" aria-controls="menu3"><?php echo e(trans('service_section_content_question3')); ?><span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                                        </div>
                                        <div id="menu3" class="collapse">
                                          <div class="card-body">
                                                 <p><?php echo e(trans('service_section_content22')); ?></p>
                                                 <p><?php echo e(trans('service_section_content23')); ?></p>
                                                 <p><?php echo e(trans('service_section_content24')); ?></p>
                                                 <p><?php echo e(trans('service_section_content25')); ?></p>
                                                 <p><?php echo e(trans('service_section_content26')); ?></p>
                                                 <p><?php echo e(trans('service_section_content27')); ?></p>
                                                 <p><?php echo e(trans('service_section_content28')); ?></p>

                                          </div>
                                        </div>
                                      </div>

                                    <div class="card">
                                    <div class="card-header">
                                              <a class="card-link" data-toggle="collapse"  href="#menu4" aria-expanded="false" aria-controls="menu4"><?php echo e(trans('service_section_content_question4')); ?> <span class="collapsed"><i class="icon-plus-circle"></i></span><span class="expanded"><i class="icon-minus-circle"></i></span></a>
                                    </div>
                                    <div id="menu4" class="collapse">
                                      <div class="card-body">
                                        <p><?php echo e(trans('service_section_content29')); ?></p>
                                      </div>
                                    </div>
                                  </div>




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

<?php echo $__env->make('layouts.frontend.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\kirra belloche\Desktop\bloo\Bloo\resources\views/pages/prix.blade.php ENDPATH**/ ?>