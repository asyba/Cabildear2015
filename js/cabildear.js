$(document).ready(function(){
 
    $("[rel='tooltip']").tooltip();    
 
    $('#hover-cap-4col .thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    );    
 
});        



$('#propuestaBoton').click(function(){
	$('#legisladoresBox').hide();
	$('#lesgiladoresBotones').hide();
	$('#adherentesBox').hide();
	$('#propuestasBox').fadeIn('slow').show();
});

$('#legiladoresBoton').click(function(){
	$('#propuestasBox').hide();
	$('#adherentesBox').hide();
	$('#adherentesBox').hide();
	$('#lesgiladoresBotones').show();
	$('#legisladoresBox').fadeIn('slow').show();
});

$('#adherentesBoton').click(function(){
	$('#legisladoresBox').hide();
	$('#lesgiladoresBotones').hide();
	$('#propuestasBox').hide();
	$('#adherentesBox').fadeIn('slow').show();
});