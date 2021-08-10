<style>
	.text-banner {
		letter-spacing: 3px;
		background-color: rgba(0, 75, 111, 0.4);
		background: rgba(0, 75, 111, 0.4);
		color: rgba(0, 75, 111, 0.4);
		padding: 5px 10px 5px 10px;
		/*border-radius: 10px;*/
		font-weight: 400;
		color: white;
		font-size: 20px;
		bottom: 0;
		text-align: center;

	}

	.text-bottom {
		display: flex;
		justify-content: left;
		align-items: flex-end;
		height: auto;
		position: absolute;
		bottom: 0;
	}

	.background-overlay {
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>



<?php
$page_banner = '';
if ($page->b && isset($page->b["banner1"])) {
		$page_banner = 'background-image: url(\'' . base_url() . 'public/upload/img/page/banners/' . $page->b["banner1"]->img . '\');';
	}
?>
<?php if ($page->b && isset($page->b["banner1"])) : ?>
<!--
	<div class="">

		<div id="page-title" class="text-grey background-overlay" style="<?= $page_banner ?>">
			<div class=" text-center">
			<div class="d-none d-sm-block padding-tb-300px z-index-2 position-relative">
				<span class="font-weight-700 text-capitalize">&nbsp;</span>
				<div class="row justify-content-md-center">
					<div class="col-lg-12 text-banner text-bottom text-center">
						<marquee>Astăzi Servicii Mai Bune Ca Ieri | Maine Servicii Mai Bune Ca Astăzi</marquee>
					</div>
				</div>
			</div>
			
				<ol class="breadcrumb z-index-2 position-relative no-background padding-30px margin-0px border-top-1 border-grey-4">
					<li><a href="#" class="text-white">Home</a></li>
					<li><a href="#" class="text-white">pages</a></li>
					<li class="active">Header Layout 1</li>
				</ol>
				
		</div>

	</div>
-->
<div id="page-title" class="text-grey background-overlay d-none d-md-block">
	<img src="<?php echo base_url().'public/upload/img/page/banners/' . $page->b["banner1"]->img?>"/>
	<div class="row justify-content-md-center">
		<div class="col-lg-12 text-banner text-bottom text-center">
			<marquee>Astăzi Servicii Mai Bune Ca Ieri | Maine Servicii Mai Bune Ca Astăzi</marquee>
		</div>
	</div>
</div>

<?php endif; ?>
