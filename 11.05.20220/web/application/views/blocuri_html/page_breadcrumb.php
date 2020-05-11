<!-- <style>
	.red{
		border: solid 1px red;
	}
</style> -->
<section class="background-grey-1 padding-tb-10px text-grey-4">
	<div class="container">
		<div class="row">
			<!--
				<div class="col-lg-3">
					<h3 class="font-weight-400 text-capitalize float-md-left font-2 padding-tb-10px text-blue"><?//=$page->p->{'title_' . $site_lang}?></h3>
				</div>
			-->
<!-- 			<div class="col-lg-6 col-md-6 col-xs-12">
				<h4 class="font-weight-400 text-capitalize float-md-left font-2 padding-tb-10px text-blue"><marquee>astazi servicii mai bune ca ieri | maine servicii mai bune ca astazi</marquee></h4>
			</div> -->
			<div class="col-lg-12 col-md-12 col-xs-12">
				<ol class="breadcrumb z-index-2 position-relative no-background padding-tb-10px padding-lr-0px margin-0px">
					<li><a href="/" class="text-grey-4"><span class="fa fa-home fa-xs text-blue"></span></a></li>
					<?php
						if($breacrumbs){
							foreach($breacrumbs as $key => $row){
								echo '<li><a href="'.base_url().$row[slug].'" class="text-grey-4">'.$row[atom_name_ro].'</a></li>';
							}
						}
					?>
					<li class="active"><?=$page->p->{'title_' . $site_lang}?></li>
				</ol>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</section>