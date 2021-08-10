<?php
// var_dump($pagini_site);
?>

<style>

.collapsing-button {
	position: relative;
	color: #0864b2;
}
.collapsing-button[aria-expanded="true"]::after {
	content: '';
	position: absolute;
	display: block;
	height: 10px;
	width: 10px;
	left: calc( 50% - 7px );
	transform: rotate(-135deg);
	border-right: 2px solid #0864b2;
	border-bottom: 2px solid #0864b2;
	border-left: 0;
	border-top: 0;
	transition: all .2s linear;
}
.collapsing-button[aria-expanded="false"]::after {
	content: '';
	position: absolute;
	display: block;
	height: 10px;
	width: 10px;
	left: calc( 50% - 7px );
	transform: rotate(45deg);
	border-right: 2px solid #0864b2;
	border-bottom: 2px solid #0864b2;
	border-left: 0;
	border-top: 0;
	transition: all .2s linear;
}
.widget {
	padding: 30px 30px 13px;
}
</style>

<!-- sidebar -->
<div class="col-lg-4 sticky-sidebar22">

	<?php if(!is_null($pagini_site)): ?>
	<div class="widget widget_categories d-none d-lg-block">
		<h4 class="widget-title clearfix"><span>pagini site</span></h4>
		<ul id="">
			<?php foreach($pagini_site as $page_ps): ?>
			<?php if(!$page_ps->pages): ?>
				<li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?=base_url() . ($page_ps->filehtml != 'pagina' ? '' : 'p/') . $page_ps->slug?>"><?=$page_ps->{'title_' . $site_lang}?></a></li>
			<?php else: ?>
			<li>
			<span class="span-caret"></span>
			<a href="<?=base_url() . ($page_ps->filehtml != 'pagina' ? '' : 'p/') . $page_ps->slug?>"><?=$page_ps->{'title_' . $site_lang}?></a>
			<ul class="nested">
				<?php foreach($page_ps->pages as $second_ps): ?>
					<?php if(!$second_ps->pages): ?>
					<li>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=base_url() . ($second_ps->filehtml != 'pagina' ? '' : 'p/') . $second_ps->slug?>"><?=$second_ps->{'title_' . $site_lang}?></a></li>
					<?php else: ?>
					<li><span class="span-caret"></span>
						<a href="<?=base_url() . ($second_ps->filehtml != 'pagina' ? '' : 'p/') . $second_ps->slug?>"><?=$second_ps->{'title_' . $site_lang}?></a>
						<ul class="nested">
						<?php foreach($second_ps->pages as $last_ps): ?>
							<li>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=base_url() . ($last_ps->filehtml != 'pagina' ? '' : 'p/') . $last_ps->slug?>"><?=$last_ps->{'title_' . $site_lang}?></a></li>
						<?php endforeach; ?>
						</ul>
					</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			</li>
			<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>

	<div class="widget widget_categories d-lg-none">
        <h4 class="widget-title clearfix">
            <a class="collapsing-button blabla" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <span>pagini site</span>
            </a>
        </h4>
        <div class="collapse" id="collapseExample">
            <div class="card-body">
                <ul id="">
                    <?php foreach ($pagini_site as $page_ps) : ?>
                    <?php if (!$page_ps->pages) : ?>
                    <li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?= base_url() . ($page_ps->filehtml != 'pagina' ? '' : 'p/') . $page_ps->slug ?>"><?= $page_ps->{'title_' . $site_lang} ?></a></li>
                    <?php else : ?>
                    <li>
                        <span class="span-caret"></span>
                        <a href="<?= base_url() . ($page_ps->filehtml != 'pagina' ? '' : 'p/') . $page_ps->slug ?>"><?= $page_ps->{'title_' . $site_lang} ?></a>
                        <ul class="nested">
                            <?php foreach ($page_ps->pages as $second_ps) : ?>
                            <?php if (!$second_ps->pages) : ?>
                            <li>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?= base_url() . ($second_ps->filehtml != 'pagina' ? '' : 'p/') . $second_ps->slug ?>"><?= $second_ps->{'title_' . $site_lang} ?></a></li>
                            <?php else : ?>
                            <li><span class="span-caret"></span>
                                <a href="<?= base_url() . ($second_ps->filehtml != 'pagina' ? '' : 'p/') . $second_ps->slug ?>"><?= $second_ps->{'title_' . $site_lang} ?></a>
                                <ul class="nested">
                                    <?php foreach ($second_ps->pages as $last_ps) : ?>
                                    <li>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?= base_url() . ($last_ps->filehtml != 'pagina' ? '' : 'p/') . $last_ps->slug ?>"><?= $last_ps->{'title_' . $site_lang} ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

    </div>
	<?php endif; ?>




	<?php if(!is_null($texte_diverse_texte_site)): ?>
		<?php foreach($texte_diverse_texte_site as $tdts): ?>
			<div class="widget hidden-xs hidden-sm d-none .d-md-none d-lg-block">
				<h4 class="widget-title clearfix"><span><?=$tdts->{'atom_name_' . $site_lang}?></span></h4>
				<h1 class="text-center"><a href="javascript:void(0);" class="text-blue"><?=$tdts->{'i_content_' . $site_lang}?></a></h1>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>

<!-- 
	<div class="widget hidden-xs hidden-sm">
		<form name="search_site" method="POST" action="<?=base_url()?>search_site">
			<h4 class="widget-title clearfix"><span>Cautare in site</span></h4>
			<input class="form-control rounded-0" name="search_site_query" type="text" placeholder="introdu un text">
			<button type="submit" name="search_site" href="#" class="btn text-white text-uppercase text-small btn-block margin-top-15px background-grey-3 rounded-0 border-0">Cauta in site!</a>
		</form>
	</div> -->


</div>
<!-- // sidebar -->