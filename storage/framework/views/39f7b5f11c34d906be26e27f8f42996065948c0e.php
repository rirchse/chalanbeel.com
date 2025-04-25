    <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/">Home</a></li>
                    <li><a href="/register/create">Sign Up</a></li>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/#">Help</a></li>
                    <li>
                        <select onchange="location = this.value;">
                            <option value="<?php echo e(route('changeLanguage', ['locale' => 'en'])); ?>" <?php if(app()->getLocale() == 'en'): ?> selected <?php endif; ?>>English</option>
                            <option value="<?php echo e(route('changeLanguage', ['locale' => 'bn'])); ?>" <?php if(app()->getLocale() == 'fr'): ?> selected <?php endif; ?>>Bengali</option>
                            <!-- Add more language options as needed... -->
                        </select>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper wrapper-full-page">

<?php echo $__env->make('partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/homes/header.blade.php ENDPATH**/ ?>