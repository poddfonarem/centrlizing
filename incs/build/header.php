<?php

use src\Controllers\LoginController;

$loginController = new LoginController();

$loginHtml = $loginController->renderLoginButton();

?>
<div class="site-wrap" id="home-section">
   <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
      	<div class="site-mobile-menu-close mt-2">
         	<span class="icon-close2 js-menu-toggle"></span>
         </div>
      </div>
      <div class="site-mobile-menu-body"></div>
   </div>
   <header class="site-navbar site-navbar-target" role="banner">
      <div class="container">
         <div class="row align-items-center position-relative">
         	<div class="col-3">
               <div class="site-logo">
                   <a href="/"><img class="logo" src="/assets/images/logo.png" alt="">Центр Лізингу</a>
              	</div>
            </div>
            <div class="col-9  text-right">
               <span class="d-inline-block d-lg-none">
						<a href="#" class="site-menu-toggle js-menu-toggle py-5 text-white">
							<span class="icon-menu h3 text-black"></span>
						</a>
					</span>
               <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                	<ul class="site-menu main-menu js-clone-nav ml-auto">
                  	<li><a href="/#youorder">Ми Пропонуємо</a></li>
                  	<li><a href="/#auto">Як це працює</a></li>
                  	<li><a href="/#plus">Наша Система</a></li>
                    <li><a href="/status">Статус заявки</a></li>
                    <li><?= $loginHtml ?></li>
               	</ul>
               </nav>
            </div>
         </div>
      </div>
   </header>