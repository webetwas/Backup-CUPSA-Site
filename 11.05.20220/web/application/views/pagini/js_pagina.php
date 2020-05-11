<script type="text/javascript">
$(document).ready(function() {
	var toggler = document.getElementsByClassName("span-caret");
	var i;

	for (i = 0; i < toggler.length; i++) {
	  toggler[i].addEventListener("click", function() {
		this.parentElement.querySelector(".nested").classList.toggle("active");
		this.classList.toggle("span-caret-down");

		let parent_this = $(this).parents('ul.nested.active')[0];
		$.map($('ul.nested'), function(val, i) {
			if($(val).hasClass('active') &&
				val != this.parentElement.querySelector(".nested")
			)
			{
				if(parent_this !== undefined && parent_this == val)
				{
					return;
				}
				
				$(val).removeClass('active');
				let span = $(val).parent('li').find('span.span-caret-down').removeClass('span-caret-down');
			}
		}.bind(this));
	  });
	}	
});
</script>

<?php
if (isset($_GET['buletine']) || isset($_GET['an']) || isset($_GET['luna']) || isset($_GET['s'])) {
?>
	<script type="text/javascript">
		$('html, body').animate({
			scrollTop: ($('.filtreaza_buletine').offset().top -200)
		},500);
	</script>
<?php
}
?>