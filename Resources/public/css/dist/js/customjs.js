$(document).ready(function() {
    $('.bg2').click(function() {
		$('.usertable').hide();
		$(".bg1").removeClass("dark");
		$(".bg2").removeClass("light");
		$(".bg2").addClass("dark");
		$(".bg1").addClass("light");
		
            $('.cmstable').show();
			
    });
	$('.bg1').click(function() {
		$('.cmstable').hide();
		$(".bg2").removeClass("dark");
		$(".bg1").removeClass("light");
		$(".bg1").addClass("dark");
		$(".bg2").addClass("light");
		
            $('.usertable').show();
			
    });
});
var x = [
'<div class="col-sm-12" style="margin-left: 53px;">',
'            <label class="tit">Allowed Territory</label>',
'              <select class="form-control terr">',
'              <option value="0">Select</option>',
'                        <option value="1">India</option>',
'                        <option value="2">Bangladesh</option>',
'                        <option value="3">China</option>',
'                        <option value="4">Pakistan</option>',
'                        </select>',
'                        <div class="col-sm-8 cir" style="display: none;">',
'              <label>Allowed Circles</label><br/>',
'               <select class="form-control select2" multiple="multiple" data-placeholder="Select a State">',
'                        <option>Gujarat</option>',
'                        <option>Rajasthan</option>',
'                        <option>Bihar</option>',
'                        <option>Maharashtra</option>',
'                        </select>',
'              </div>',
'              </div>'
].join('');

$(document).ready(function(){
	

	
    $('.more').click(function(){
		// $('#field').clone().insertAfter('#field');
		$(".select2").select2();
		 $("#field").append(x);
        
     $('.terr').on('change', function() {
		 $(".select2").select2();
      $(this).next('.cir').show();
	 });
    });
   });
$(document).ready(function(){
    $('.terr').on('change', function() {
      $(this).next('.cir').show();
      
      
    });
});











var x1 = [
'<div class="col-sm-12"  style="margin-left: 53px;">',
'            <label class="tit">Resolution</label>',
'             <select  class="form-control terr1">',
'              <option value="0">Select</option>',
'                        <option value="1">1300x500</option>',
'                        <option value="2">1600x1000</option>',
'                        <option value="3">320x480</option>',
                        
'                        </select>',
'                        <div class="col-sm-4 cir1" style="display: none;">',
'             <label>OS</label>',
'               <select class="form-control" multiple="">',
'                        <option value="1" selected>Android</option>',
'                          <option value="2">Windows</option>',
'                        <option value="3">IOSr</option>',
'                        <option selected="" value="4">BlackBerry</option>',
'                        </select>',
'              </div>',
'                        <div class="col-sm-4 cir1" style="display: none;">',
'             <label>Device List</label>',
'               <select class="form-control" multiple="" disabled="disabled">',
'                        <option value="1" >Black Berry 1</option>',
'                          <option value="2">Black Berry 1</option>',
'                        <option value="3">Black Berry 1</option>',
'                        <option value="4">Black Berry 1</option>',
'                        </select>',
'              </div>',
'              </div>'
].join('');

$(document).ready(function(){
	

	
    $('.more1').click(function(){
		// $('#field').clone().insertAfter('#field');
		 $("#field1").append(x1);
        
     $('.terr1').on('change', function() {
      $(this).nextAll('.cir1').show();
	 });
    });
   });
$(document).ready(function(){
    $('.terr1').on('change', function() {
      $(this).nextAll('.cir1').show();
      
      
    });
});
$(document).ready(function(){
	
  $('input[type=file]').change(function(){
		$('#detailform').show();
  });
});