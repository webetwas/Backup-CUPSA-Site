<?php
// var_dump($menus);die();
?>
<style>
.header-in #logo img{
    /* max-width: 100px; */
}
.a-box {
    display: table;
}
.a-box .vertical-content {
    display: table-cell;
    vertical-align: middle;
}
#logo img {
    width: 100px;
    height: 78px;
}
</style>
<!-- <header class="gradient-white box-shadow"> -->
  <header class="box-shadow" style="background-color: white;">
      <div class="header-output">
          <div class="container header-in">
              <div class="row">
                  <div class="col-lg-2 col-special js-equal-7">
                        <a id="logo" href="/" class="d-inline-block margin-tb-5px">
                            <img src="<? /*(isset($owner->image_logo) && !is_null($owner->image_logo) ? SITE_URL.PATH_IMG_MISC. '/' .$owner->image_logo : base_url().'public/upload/img/misc/photo-cvnrjry8.png'); */ echo base_url(); ?>/public/upload/img/misc/bigLogo.jpg" alt="">
                        </a>
                      <a class="mobile-toggle padding-15px background-main-color" href="#"><i class="fa fa-bars"></i></a>
                  </div>
                  <div class="col-xl-10 position-inherit js-equal-7 a-box">
                      <div class="vertical-content">
					  <?php if(!is_null($menus)): $wasopen = false; ?>

                          <ul id="menu-main" class="float-lg-right nav-menu link-padding-tb-25px">
						  <?php foreach($menus as $keymenu => $menu): ?>
							<?php
								if($menu->fullpath == "/" || $menu->fullpath == "acasa" || $menu->fullpath == "homepage" || $menu->fullpath == "index" || $menu->fullpath == "index.php") $menu->fullpath = "";
							?>
							<?php if($menu->atom_isactive): ?>
								<li class="active"><a href="<?=base_url().$menu->fullpath?>"><?=$menu->{'atom_name' . '_' . $site_lang}?></a></li>
							<?php endif; ?>
						  <?php endforeach; ?>
                          </ul>
						<?php endif; ?>
                      </div>
                  </div>
              </div>

          </div>
      </div>

  </header>
  <!-- // header -->
</div>
