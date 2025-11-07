
<?php $__env->startSection('title', ''); ?>
<?php $__env->startSection('content'); ?>

<style type="text/css">
    .search{border: 1px solid #fff;}
    .search-alert{background: #fff;padding: 10px 20px;font-size: 18px;font-weight: bold;color:orange;box-shadow: 5px 5px 15px #000;display: none;}
</style>

<div class="full-page login-page" filter-color="" data-image="images/login.jpg">
    <div class="content">
        <div class="container">
            <div class="col-md-12">
                <div class="" style="text-align:center;width:100%;max-width:600px;margin:0 auto;">
                    <div class="">
                        <!-- resources/views/welcome.blade.php -->
                        
                        
                        <img src="images/logo.png" class="img-responsive" style="margin:0 auto">
                        
                        <form class="form-horizontal" action="<?php echo e(route('account.check.post')); ?>">
                              <div class="input-group">
                                <input type="number" name="contact" id="search"class="form-control" style="background:#efefef; padding:20px;box-shadow: 1px 1px 5px; text-align:cente" placeholder="আপনের মোবাইল নম্বর লিখুন">
                                <span class="input-group-addon">
                                  <button class="btn btn-info">Submit</button>
                                </span>
                            </div>
                        </form>
                        <?php if(isset($user) && $user != []): ?>
                        <div class="panel panel-info" style="background:#fff; border:2px solid; <?php echo e($user->status == 'Expire'? 'border-color: red': ''); ?>">
                          <div class="panel-body">
                            <table class="table">
                              <tr>
                                <td>একাউন্টের মেয়াদ:</td>
                                <th>
                                  <h4 style="<?php echo e($user->status == 'Expire'? 'color:red':''); ?>"><?php echo e($user->status); ?></h4>
                                </th>
                              </tr>
                              <tr>
                                <td>গ্রাহকের নাম:</td>
                                <th><?php echo e($user->name); ?></th>
                              </tr>
                              <tr>
                                <td>টাকা প্রদানের তারিখ:</td>
                                <th><?php echo e($user->payment_date); ?></th>
                              </tr>
                            </table>
                            <?php if($user->status == 'Expire'): ?>
                            <hr>
                            <h3>বিকাশ সেন্ড মানি: 
                              <br>
                              <b>017 03 58 79 11</b></h3>
                            <?php endif; ?>
                          </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p id="bengali-text">
      আমার সোনার বাংলা, আমি তোমায় ভালোবাসি।
  </p>

  <script src="https://code.responsivevoice.org/responsivevoice.js?key=Nv0NmYmz"></script>

  <script>
      // Function to speak the Bengali text
      function speakBengali() {
          if ('speechSynthesis' in window) {
              const textToSpeak = document.getElementById('bengali-text').textContent;
              const utterance = new SpeechSynthesisUtterance(textToSpeak);

              // Set the language to Bengali (Bangladesh) or Bengali (India)
              // The actual voice used depends on the user's browser/OS
              utterance.lang = 'bn-BD'; // or 'bn-IN'
              
              // Optional properties
              // utterance.volume = 1; // From 0 to 1
              // utterance.rate = 1;   // From 0.1 to 10
              // utterance.pitch = 1;  // From 0 to 2

              // Speak the text
              window.speechSynthesis.speak(utterance);
          } else {
              console.error('Text-to-speech not supported in this browser.');
              alert('Text-to-speech not supported in this browser.');
          }
      }

      // Call the speakBengali function when the page is fully loaded
      window.onload = speakBengali;

      // Note: Some browsers, especially mobile, may require user interaction (e.g., a button click)
      // to initiate speech synthesis due to autoplay policies.
      // For wider compatibility, consider adding a "Play" button as a fallback.
  </script>

    <script type="text/javascript">
    var search = document.getElementById('search');
    search.addEventListener('keyup', check);
    function check() {
        document.getElementById('search_alert').style.display = 'block';

        setTimeout(function(){
            document.getElementById('search_alert').style.display = 'none';
        }, 10000);        
    }
    
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/cbt/resources/views/homes/index.blade.php ENDPATH**/ ?>