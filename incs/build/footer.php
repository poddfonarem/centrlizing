<?php

use src\Controllers\LoginController;

require_once __DIR__ . '/../../config/info.php';
?>
<footer class="site-footer">
   <div class="container">
      <div class="row">
         <div class="col-lg-3">
         	<div class="row">
               <ul class="list-unstyled">
               	<li>
                    <a class="text-black">
                        <i class="icon-map"></i> <?=$address ?? ""?>
                    </a>
                </li>
                  <li>
                      <a class="text-black" href="mailto:<?=$email ?? ""?>">
                          <i class="icon-envelope"></i> <?=$email ?? ""?>
                      </a>
                  </li>
                  <li>
                      <a class="text-black" href="tel:<?=$phone ?? ""?>">
                          <i class="icon-phone_iphone"></i> <?=$phone_decoration ?? ""?>
                      </a>
                  </li>
               </ul>
            </div>
         </div>
         <div class="col-lg-8 ml-auto">
         	<div class="row">
            	<div class="col-lg-6 ml-auto"></div>
              	<div class="col-lg-6">
                	<h2 class="footer-heading mb-1 font-weight-bold">
							Товариство з обмеженою відповідальністю «Оптимізація транспортних витрат – Лізинг»
						</h2>
                  <a href="https://creativecommons.org/licenses/by-nc-nd/4.0/deed.en" target="_blank" 
							class="btn btn-primary text-white">Copyright Creative Commons
						</a>
               </div> 
            </div>
         </div>
      </div>
      <div class="row pt-2 mt-2 text-center">
         <div class="col-md-12">
            <div class="border-top pt-2">
            	<p>
               	Copyright &copy; <?= $title ?? ""?> <script>document.write(new Date().getFullYear());</script> | Всі права захищені
            	</p>
            </div>
          </div>
        </div>
      </div>
</footer>
<?php
$loginController = new LoginController();

if(!$loginController->isLoggedIn()) {
    require_once __DIR__ . "/../components/modal_login.php";
}

?>
<a href="#" class="scroll-top"></a>
<script src="/assets/js/jquery-3.3.1.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/aos.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>