<script type="text/javascript">
$(function(){
  // bind change event to select
  $('#gfsectiuni').on('change', function () {
      // $(".cssload-container").show();
      var url = '<?=base_url();?>actionariat/sectiune/' +$(this).val(); // get selected value
      if (url) { // require a URL
          window.location = url; // redirect
      }
      return false;
  });
});
</script>