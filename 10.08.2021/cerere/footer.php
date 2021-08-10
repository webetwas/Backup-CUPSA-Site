<style type="text/css">
	.background-aqua{
		background: url(assets/img/div/banner-aqua-1.jpg) no-repeat;
		background-size: cover;
	}
	/*.background-aqua img {
	    opacity: 0.5;
	    filter: alpha(opacity=50);
	}*/

	.text-black{
		color: #56595c;
		}
	/*.transparence{
		padding:20px 10px 0 10px;
		border-radius: 20px;
		background-color: rgba(228, 227, 226, 0.5);
		background: rgba(228, 227, 226, 0.5);
		color: rgba(228, 227, 226, 0.5);
	}*/
</style>
	<!-- <footer class="background-dark padding-top-100px"> -->
	<footer class="background-aqua padding-top-50px">
		<div class="container transparence">
			<div class="row padding-tb-25px">
				<div class="col-lg-4">
					<ul class="last-posts margin-0px padding-0px list-unstyled text-black">
						<li>
							<a href="#" class="float-left margin-right-15px d-block width-50px"><img src="assets/img/div/2.jpg" alt=""></a>
							<a href="#" class="d-block text-capitalize text-grey-2">Stire ...</a>
							<span class="text-extra-small text-grey-3">data :  <a href="#" class="text-grey-3">Octombrie 15, 2018</a></span>
							<hr class="border-grey-4">
							<div class="clearfix"></div>
						</li>
						<li>
							<a href="#" class="float-left margin-right-15px d-block width-50px"><img src="assets/img/div/2.jpg" alt=""></a>
							<a href="#" class="d-block  text-capitalize text-grey-2">Stire ...</a>
							<span class="text-extra-small text-grey-3">data :  <a href="#" class="text-grey-3">Octombrie 15, 2018</a></span>
							<hr class="border-grey-4">
							<div class="clearfix"></div>
						</li>
						<li>
							<a href="#" class="float-left margin-right-15px d-block width-50px"><img src="assets/img/div/2.jpg" alt=""></a>
							<a href="#" class="d-block text-capitalize text-grey-2">Stire ...</a>
							<span class="text-extra-small text-grey-3">data :  <a href="#" class="text-grey-3">Octombrie 15, 2018</a></span>
							<div class="clearfix"></div>
						</li>
					</ul>
				</div>
				<div class="col-lg-4">
					<div class="text-black">
						<ul class="margin-0px padding-0px list-unstyled text-black">
							<li class="padding-tb-7px"><i class="far fa-hospital margin-right-10px"></i><strong>Compania de Utilitati Publice Focsani</strong></li>
							<li class="padding-tb-7px"><i class="far fa-map margin-right-10px"></i> Str. Nicolaie Titulescu nr. 9</li>
							<li class="padding-tb-7px"><i class="far fa-bookmark margin-right-10px"></i> Focsani, Vrancea, Romania</li>
							<li class="padding-tb-7px"><i class="fas fa-phone margin-right-10px"></i> Tel: 0237 226 400</li>
							<li class="padding-tb-7px"><i class="far fa-envelope-open margin-right-10px"></i> office@cupfocsani.ro</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4">
					<ul class="footer-menu-2 row margin-0px padding-0px list-unstyled text-black">
						<li class="col-6  padding-tb-5px"><a href="#" class="text-grey-2">Acasa</a></li>
						<li class="col-6  padding-tb-5px"><a href="#" class="text-grey-2">Despre noi</a></li>
						<li class="col-6  padding-tb-5px"><a href="#" class="text-grey-2">Feedback</a></li>
						<li class="col-6  padding-tb-5px"><a href="#" class="text-grey-2">Pune o intrebare</a></li>
						<li class="col-6  padding-tb-5px"><a href="#" class="text-grey-2">Echipa</a></li>
						<li class="col-6  padding-tb-5px"><a href="#" class="text-grey-2">Servicii</a></li>
						<li class="col-6  padding-tb-5px"><a href="#" class="text-grey-2">Harta site</a></li>
						<li class="col-6  padding-tb-5px"><a href="#" class="text-grey-2">Contact</a></li>
					</ul>
				</div>
			</div>
		</div>


		<script type="text/javascript">
		$(document).ready(function(){
		  $(".owl-carousel").owlCarousel({
				items: 1,
				pagination: false,
				autoPlay: true,
				navigation: true,
				slideSpeed : 2000,
				navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				itemsDesktop: [1199, 1],
		    itemsDesktopSmall: [979, 1],
            itemsMobile : [767,1]
			});
		});

		$(document).ready(function(){
		  $(".owl-carousel-1").owlCarousel({
				items: 1,
				pagination: false,
				autoPlay: true,
				navigation: true,
				slideSpeed : 2000,
				navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				itemsDesktop: [1199, 1],
		    itemsDesktopSmall: [979, 1],
        itemsMobile : [767,1]
			});
		});

		var stickymenu = document.getElementById("main-nav-bar")
		var stickymenuoffset = stickymenu.offsetTop

		window.addEventListener("scroll", function(e){
		    requestAnimationFrame(function(){
		        if (window.pageYOffset > stickymenuoffset){
		            stickymenu.classList.add('sticky')
		        }
		        else{
		            stickymenu.classList.remove('sticky')
		        }
		    })
		})
		</script>
	</footer>
