<div class="padding-tb-5px position-relative" style="background-color:#5091c8; ">
	<div class="container">
		<div class="row wow fadeInUp">
				<!-- <div class="col-lg-6 hidden-xs hidden-sm">
					<ul class="footer-menu margin-0px padding-0px list-unstyled text-white">
					<?php foreach($menu_footer2 as $mf2): ?>
							<?php
								if($mf2->fullpath == "/" || $mf2->fullpath == "acasa" || $mf2->fullpath == "homepage" || $mf2->fullpath == "index" || $mf2->fullpath == "index.php") $mf2->fullpath = "";
							?>
						<li><a href="<?=base_url().$mf2->fullpath?>" class="text-grey-2"><?=$mf2->{'atom_name' . '_' . $site_lang}?></a></li>
					<?php endforeach; ?>
					</ul>
				</div> -->
				<div class="col-lg-12">
					<span class="text-white d-block padding-top-5px text-center">
                        <?=$owner->company?> @ <?php echo date('Y');?> | Toate drepturile rezervate
                    </span>
				</div>
			</div>
		</div>
	</div>
</div>