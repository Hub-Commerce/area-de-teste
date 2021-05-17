$(function() {
$('#sociais').click(function(){

  $('#sociais').addClass('col-banner-80');  
  $('#sociais').removeClass('col-banner-20'); 
  $('#corporativos').addClass('col-banner-20');  
  $('#menu-social').addClass('menu-ativo');  
    $('#menu-corporativo').removeClass('menu-ativo'); 
    
});
});

$(function() {
$('#corporativos').click(function(){
  $('#corporativos').addClass('col-banner-80');  
  $('#corporativos').removeClass('col-banner-20'); 
  $('#sociais').addClass('col-banner-20');  
  $('#menu-social').removeClass('menu-ativo'); 
  $('#menu-corporativo').addClass('menu-ativo'); 

});
});