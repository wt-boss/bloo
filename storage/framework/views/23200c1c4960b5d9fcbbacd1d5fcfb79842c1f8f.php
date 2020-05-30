<footer class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">BLOO</h2>
            <p>Outils de visualisation et d'analyse des données </p>
            <p class="mt-4"><a href="<?php echo e(route('register')); ?>" class="btn btn-primary p-3">Inscription</a></p>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4 ml-md-5">
            <h2 class="ftco-heading-2">Unseful Links</h2>
            <ul class="list-unstyled">
                <li><a href="<?php echo e(route('sondages')); ?>" class="py-2 d-block"><?php echo e(trans('sondage_fil')); ?></a></li>
                <li><a href="<?php echo e(route('prix')); ?>" class="py-2 d-block"><?php echo e(trans('prix_fil')); ?></a></li>
                <li><a href="<?php echo e(route('contact_path')); ?>" class="py-2 d-block"><?php echo e(trans('contact_fil')); ?></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md">
           <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Navigation</h2>
            <ul class="list-unstyled">
              <li><a href="<?php echo e(route('home')); ?>" class="py-2 d-block"><?php echo e(trans('home_fil')); ?></a></li>
              <li><a href="<?php echo e(route('services')); ?>" class="py-2 d-block"><?php echo e(trans('service_fil')); ?></a></li>


            </ul>
          </div>
        </div>
        <div class="col-md">
          <div class="ftco-footer-widget mb-4">
              <div class="block-23 mb-3">
                <ul>
                  <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View</span></li>

                  <li><a href="#"><span class="icon icon-envelope"></span><span class="text">bloo@bloosite.com</span></a></li>

                </ul>
              </div>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">

          <p>
             Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | BLOO
          </p>
        </div>
      </div>
    </div>
  </footer>
<?php /**PATH C:\Users\kirra belloche\Desktop\bloo\Bloo\resources\views/layouts/frontend/partial/footer.blade.php ENDPATH**/ ?>