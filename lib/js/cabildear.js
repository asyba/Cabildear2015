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




$('#noticiasBoton').click(function(){
	
	$('#noticiasBoton').addClass( "selec" ).removeClass("noSelec");
	$('#propuestaBoton').addClass( "noSelec" );
	$('#legiladoresBoton').addClass( "noSelec" );
	$('#adherentesBoton').addClass( "noSelec" );
	
	//$('#noticiasBoton').toggleClass('noSelec');
	$('#legisladoresBox').hide();
	$('#lesgiladoresBotones').hide();
	$('#adherentesBox').hide();
	$('#propuestasBox').hide();
	$('#noticiasBox').fadeIn('slow').show();
});


$('#propuestaBoton').click(function(){
	
	$('#noticiasBoton').addClass( "noSelec" );
	$('#propuestaBoton').addClass( "selec" ).removeClass("noSelec");
	$('#legiladoresBoton').addClass( "noSelec" );
	$('#adherentesBoton').addClass( "noSelec" );
	
	$('#legisladoresBox').hide();
	$('#noticiasBox').hide();
	$('#lesgiladoresBotones').hide();
	$('#adherentesBox').hide();
	$('#propuestasBox').fadeIn('slow').show();
});

$('#legiladoresBoton').click(function(){
	
	$('#noticiasBoton').addClass( "noSelec" );
	$('#propuestaBoton').addClass( "noSelec" );
	$('#legiladoresBoton').addClass( "selec" ).removeClass("noSelec");
	$('#adherentesBoton').addClass( "noSelec" );
	
	
	$('#propuestasBox').hide();
	$('#noticiasBox').hide();
	$('#adherentesBox').hide();
	$('#adherentesBox').hide();
	$('#lesgiladoresBotones').show();
	$('#legisladoresBox').fadeIn('slow').show();
});

$('#adherentesBoton').click(function(){
	
	$('#noticiasBoton').addClass( "noSelec" );
	$('#propuestaBoton').addClass( "noSelec" );
	$('#legiladoresBoton').addClass( "noSelec" );
	$('#adherentesBoton').addClass( "selec" ).removeClass("noSelec");
	
	$('#legisladoresBox').hide();
	$('#noticiasBox').hide();
	$('#lesgiladoresBotones').hide();
	$('#propuestasBox').hide();
	$('#adherentesBox').fadeIn('slow').show();
});