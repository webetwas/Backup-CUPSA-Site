<?php
// var_dump($homesliders);
?>

<div id="rev_slider_38_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="Cup Focsani" data-source="gallery" style="margin:0px auto;background:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">

	<div id="rev_slider_38_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.1">

		<ul>
			<?php //foreach($homesliders as $key_slider => $slideritem):?>
			<?php if($homesliders): ?>
			<!-- SLIDE  -->
			<li data-index="rs-101" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="300" data-thumb="<?=$pathimgbanners.$homesliders["banner1"]->img?>" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
				<!-- MAIN IMAGE -->
				<img src="<?=$pathimgbanners.$homesliders["banner1"]->img?>" alt="" data-bgposition="center center" data-kenburns="on" data-duration="5000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="110" data-rotatestart="0" data-rotateend="0" data-blurstart="0" data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
				<!-- LAYERS -->

				<?php if(!empty($homesliders["banner1"]->titlu)): ?>
				<!-- LAYER NR. 1 -->
				<div class="tp-caption   tp-resizeme" id="slide-101-layer-6" data-x="['left','left','left','center']" data-hoffset="['620','620','345','0']" data-y="['top','top','top','top']" data-voffset="['177','177','109','106']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"delay":10,"speed":910,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5; white-space: nowrap; font-size: 16px; line-height: 22px; font-weight: 600; color: #707070;font-family:Poppins;"><?=$homesliders["banner1"]->titlu?></div>
				<?php endif; ?>

				<?php if(isset($homesliders["banner2"])): ?>
				<!-- LAYER NR. 2 -->
				<div class="tp-caption tp-resizeme" id="slide-101-layer-5" data-x="['left','left','left','center']" data-hoffset="['548','548','379','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-74','-74','-70','-75']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="image" data-responsive_offset="on" data-frames='[{"delay":490,"speed":900,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;"><img src="<?=$pathimgbanners.$homesliders["banner2"]->img?>" alt="" data-ww="['443px','443px','230px','230px']" data-hh="['300px','300px','219px','219px']" data-no-retina class="pull-left"> </div>
				<?php endif; ?>

				<?php if(!empty($homesliders["banner1"]->subtitlu)): ?>
				<!-- LAYER NR. 3 -->
				<div class="tp-caption   tp-resizeme" id="slide-101-layer-7" data-x="['left','left','left','center']" data-hoffset="['569','569','299','0']" data-y="['middle','middle','middle','middle']" data-voffset="['50','50','30','14']" data-color="['rgb(102,102,102)','rgb(102,102,102)','rgb(79,79,79)','rgb(79,79,79)']" data-width="373" data-height="72" data-whitespace="normal" data-type="text" data-responsive_offset="on" data-frames='[{"delay":970,"speed":880,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7; min-width: 373px; max-width: 373px; max-width: 72px; max-width: 72px; white-space: normal; font-size: 14px; line-height: 18px; font-weight: 300; color: #666666;font-family:Poppins;"><?=$homesliders["banner1"]->subtitlu?>

				</div>
				<?php endif; ?>

				<?php if(!empty($homesliders["banner1"]->thref1)): ?>
				<!-- LAYER NR. 4 -->
				<div class="tp-caption rev-btn " id="slide-101-layer-8" data-x="['left','left','left','center']" data-hoffset="['691','691','414','0']" data-y="['top','top','top','top']" data-voffset="['467','467','331','317']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-responsive_offset="on" data-responsive="off" data-frames='[{"delay":1440,"speed":860,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(255,255,255);bg:rgb(0,122,255);bs:solid;bw:0 0 0 0;"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[12,12,12,12]" data-paddingright="[35,35,35,35]" data-paddingbottom="[12,12,12,12]" data-paddingleft="[35,35,35,35]" style="z-index: 8; white-space: nowrap; font-size: 17px; line-height: 17px; font-weight: 500; color: #ffffff;font-family:Poppins;background-color:rgba(0,0,0,0.75);border-color:rgba(0,0,0,1);border-radius:30px 30px 30px 30px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;"><?=$homesliders["banner1"]->thref1?> </div>
				<?php endif; ?>
			</li>
			<?php endif; ?>

		</ul>
		<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
	</div>
</div>
