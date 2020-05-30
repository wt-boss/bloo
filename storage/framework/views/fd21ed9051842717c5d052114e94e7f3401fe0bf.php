<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.html">bloo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="<?php echo e(Request::is('/')? "active": "nav-item"); ?>"><a href="<?php echo e(route('home')); ?>" class="nav-link"><?php echo e(trans('home_fil')); ?></a></li>
          <li class="<?php echo e(Request::is('services')? "active": "nav-item"); ?>"><a href="<?php echo e(route('services')); ?>" class="nav-link"><?php echo e(trans('service_fil')); ?></a></li>
          <li class="<?php echo e(Request::is('sondages')? "active": "nav-item"); ?>"><a href="<?php echo e(route('sondages')); ?>" class="nav-link"><?php echo e(trans('sondage_fil')); ?></a></li>
          <li class="<?php echo e(Request::is('prix')? "active": "nav-item"); ?>"><a class="nav-link" href="<?php echo e(route('prix')); ?>"><?php echo e(trans('prix_fil')); ?></a></li>
          <li class="<?php echo e(Request::is('about')? "active": "nav-item"); ?>"><a href="<?php echo e(route('contact_path')); ?>" class="nav-link"><?php echo e(trans('contact_fil')); ?></a></li>

            <?php if(Auth::check()): ?>
                <li class="nav-item cta"> <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <?php echo e(Auth::user()->name); ?>

                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo e(route('logout')); ?>">Deconnexion</a>

                        </div>
                    </div></li>
            <?php else: ?>
                <li class="nav-item cta"><a href="<?php echo e(route('login')); ?>" class="nav-link"><span>Connexion</span></a></li>
            <?php endif; ?>

        </ul>
      </div>
    </div>
  </nav>
    <!-- END nav -->
<?php /**PATH C:\Users\kirra belloche\Desktop\bloo\Bloo\resources\views/layouts/frontend/partial/nav.blade.php ENDPATH**/ ?>