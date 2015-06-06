<?php
require_once( dirname(__FILE__).'/form.lib.php' );

define( 'PHPFMG_USER', "propuesta@cabildear.org" ); // must be a email address. for sending password to you.
define( 'PHPFMG_PW', "Fopea2015" );

?>
<?php
/**
 * GNU Library or Lesser General Public License version 2.0 (LGPLv2)
*/

# main
# ------------------------------------------------------
error_reporting( E_ERROR ) ;
phpfmg_admin_main();
# ------------------------------------------------------




function phpfmg_admin_main(){
    $mod  = isset($_REQUEST['mod'])  ? $_REQUEST['mod']  : '';
    $func = isset($_REQUEST['func']) ? $_REQUEST['func'] : '';
    $function = "phpfmg_{$mod}_{$func}";
    if( !function_exists($function) ){
        phpfmg_admin_default();
        exit;
    };

    // no login required modules
    $public_modules   = false !== strpos('|captcha|', "|{$mod}|", "|ajax|");
    $public_functions = false !== strpos('|phpfmg_ajax_submit||phpfmg_mail_request_password||phpfmg_filman_download||phpfmg_image_processing||phpfmg_dd_lookup|', "|{$function}|") ;   
    if( $public_modules || $public_functions ) { 
        $function();
        exit;
    };
    
    return phpfmg_user_isLogin() ? $function() : phpfmg_admin_default();
}

function phpfmg_ajax_submit(){
    $phpfmg_send = phpfmg_sendmail( $GLOBALS['form_mail'] );
    $isHideForm  = isset($phpfmg_send['isHideForm']) ? $phpfmg_send['isHideForm'] : false;

    $response = array(
        'ok' => $isHideForm,
        'error_fields' => isset($phpfmg_send['error']) ? $phpfmg_send['error']['fields'] : '',
        'OneEntry' => isset($GLOBALS['OneEntry']) ? $GLOBALS['OneEntry'] : '',
    );
    
    @header("Content-Type:text/html; charset=$charset");
    echo "<html><body><script>
    var response = " . json_encode( $response ) . ";
    try{
        parent.fmgHandler.onResponse( response );
    }catch(E){};
    \n\n";
    echo "\n\n</script></body></html>";

}


function phpfmg_admin_default(){
    if( phpfmg_user_login() ){
        phpfmg_admin_panel();
    };
}



function phpfmg_admin_panel()
{    
    phpfmg_admin_header();
    phpfmg_writable_check();
?>    
<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign=top style="padding-left:280px;">

<style type="text/css">
    .fmg_title{
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
    }
    
    .fmg_sep{
        width:32px;
    }
    
    .fmg_text{
        line-height: 150%;
        vertical-align: top;
        padding-left:28px;
    }

</style>

<script type="text/javascript">
    function deleteAll(n){
        if( confirm("Are you sure you want to delete?" ) ){
            location.href = "admin.php?mod=log&func=delete&file=" + n ;
        };
        return false ;
    }
</script>


<div class="fmg_title">
    1. Email Traffics
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=1">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=1">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_EMAILS_LOGFILE) ){
            echo '<a href="#" onclick="return deleteAll(1);">delete all</a>';
        };
    ?>
</div>


<div class="fmg_title">
    2. Form Data
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=2">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=2">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_SAVE_FILE) ){
            echo '<a href="#" onclick="return deleteAll(2);">delete all</a>';
        };
    ?>
</div>

<div class="fmg_title">
    3. Form Generator
</div>
<div class="fmg_text">
    <a href="http://www.formmail-maker.com/generator.php" onclick="document.frmFormMail.submit(); return false;" title="<?php echo htmlspecialchars(PHPFMG_SUBJECT);?>">Edit Form</a> &nbsp;&nbsp;
    <a href="http://www.formmail-maker.com/generator.php" >New Form</a>
</div>
    <form name="frmFormMail" action='http://www.formmail-maker.com/generator.php' method='post' enctype='multipart/form-data'>
    <input type="hidden" name="uuid" value="<?php echo PHPFMG_ID; ?>">
    <input type="hidden" name="external_ini" value="<?php echo function_exists('phpfmg_formini') ?  phpfmg_formini() : ""; ?>">
    </form>

		</td>
	</tr>
</table>

<?php
    phpfmg_admin_footer();
}



function phpfmg_admin_header( $title = '' ){
    header( "Content-Type: text/html; charset=" . PHPFMG_CHARSET );
?>
<html>
<head>
    <title><?php echo '' == $title ? '' : $title . ' | ' ; ?>PHP FormMail Admin Panel </title>
    <meta name="keywords" content="PHP FormMail Generator, PHP HTML form, send html email with attachment, PHP web form,  Free Form, Form Builder, Form Creator, phpFormMailGen, Customized Web Forms, phpFormMailGenerator,formmail.php, formmail.pl, formMail Generator, ASP Formmail, ASP form, PHP Form, Generator, phpFormGen, phpFormGenerator, anti-spam, web hosting">
    <meta name="description" content="PHP formMail Generator - A tool to ceate ready-to-use web forms in a flash. Validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. ">
    <meta name="generator" content="PHP Mail Form Generator, phpfmg.sourceforge.net">

    <style type='text/css'>
    body, td, label, div, span{
        font-family : Verdana, Arial, Helvetica, sans-serif;
        font-size : 12px;
    }
    </style>
</head>
<body  marginheight="0" marginwidth="0" leftmargin="0" topmargin="0">

<table cellspacing=0 cellpadding=0 border=0 width="100%">
    <td nowrap align=center style="background-color:#024e7b;padding:10px;font-size:18px;color:#ffffff;font-weight:bold;width:250px;" >
        Form Admin Panel
    </td>
    <td style="padding-left:30px;background-color:#86BC1B;width:100%;font-weight:bold;" >
        &nbsp;
<?php
    if( phpfmg_user_isLogin() ){
        echo '<a href="admin.php" style="color:#ffffff;">Main Menu</a> &nbsp;&nbsp;' ;
        echo '<a href="admin.php?mod=user&func=logout" style="color:#ffffff;">Logout</a>' ;
    }; 
?>
    </td>
</table>

<div style="padding-top:28px;">

<?php
    
}


function phpfmg_admin_footer(){
?>

</div>

<div style="color:#cccccc;text-decoration:none;padding:18px;font-weight:bold;">
	:: <a href="http://phpfmg.sourceforge.net" target="_blank" title="Free Mailform Maker: Create read-to-use Web Forms in a flash. Including validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. " style="color:#cccccc;font-weight:bold;text-decoration:none;">PHP FormMail Generator</a> ::
</div>

</body>
</html>
<?php
}


function phpfmg_image_processing(){
    $img = new phpfmgImage();
    $img->out_processing_gif();
}


# phpfmg module : captcha
# ------------------------------------------------------
function phpfmg_captcha_get(){
    $img = new phpfmgImage();
    $img->out();
    //$_SESSION[PHPFMG_ID.'fmgCaptchCode'] = $img->text ;
    $_SESSION[ phpfmg_captcha_name() ] = $img->text ;
}



function phpfmg_captcha_generate_images(){
    for( $i = 0; $i < 50; $i ++ ){
        $file = "$i.png";
        $img = new phpfmgImage();
        $img->out($file);
        $data = base64_encode( file_get_contents($file) );
        echo "'{$img->text}' => '{$data}',\n" ;
        unlink( $file );
    };
}


function phpfmg_dd_lookup(){
    $paraOk = ( isset($_REQUEST['n']) && isset($_REQUEST['lookup']) && isset($_REQUEST['field_name']) );
    if( !$paraOk )
        return;
        
    $base64 = phpfmg_dependent_dropdown_data();
    $data = @unserialize( base64_decode($base64) );
    if( !is_array($data) ){
        return ;
    };
    
    
    foreach( $data as $field ){
        if( $field['name'] == $_REQUEST['field_name'] ){
            $nColumn = intval($_REQUEST['n']);
            $lookup  = $_REQUEST['lookup']; // $lookup is an array
            $dd      = new DependantDropdown(); 
            echo $dd->lookupFieldColumn( $field, $nColumn, $lookup );
            return;
        };
    };
    
    return;
}


function phpfmg_filman_download(){
    if( !isset($_REQUEST['filelink']) )
        return ;
        
    $info =  @unserialize(base64_decode($_REQUEST['filelink']));
    if( !isset($info['recordID']) ){
        return ;
    };
    
    $file = PHPFMG_SAVE_ATTACHMENTS_DIR . $info['recordID'] . '-' . $info['filename'];
    phpfmg_util_download( $file, $info['filename'] );
}


class phpfmgDataManager
{
    var $dataFile = '';
    var $columns = '';
    var $records = '';
    
    function phpfmgDataManager(){
        $this->dataFile = PHPFMG_SAVE_FILE; 
    }
    
    function parseFile(){
        $fp = @fopen($this->dataFile, 'rb');
        if( !$fp ) return false;
        
        $i = 0 ;
        $phpExitLine = 1; // first line is php code
        $colsLine = 2 ; // second line is column headers
        $this->columns = array();
        $this->records = array();
        $sep = chr(0x09);
        while( !feof($fp) ) { 
            $line = fgets($fp);
            $line = trim($line);
            if( empty($line) ) continue;
            $line = $this->line2display($line);
            $i ++ ;
            switch( $i ){
                case $phpExitLine:
                    continue;
                    break;
                case $colsLine :
                    $this->columns = explode($sep,$line);
                    break;
                default:
                    $this->records[] = explode( $sep, phpfmg_data2record( $line, false ) );
            };
        }; 
        fclose ($fp);
    }
    
    function displayRecords(){
        $this->parseFile();
        echo "<table border=1 style='width=95%;border-collapse: collapse;border-color:#cccccc;' >";
        echo "<tr><td>&nbsp;</td><td><b>" . join( "</b></td><td>&nbsp;<b>", $this->columns ) . "</b></td></tr>\n";
        $i = 1;
        foreach( $this->records as $r ){
            echo "<tr><td align=right>{$i}&nbsp;</td><td>" . join( "</td><td>&nbsp;", $r ) . "</td></tr>\n";
            $i++;
        };
        echo "</table>\n";
    }
    
    function line2display( $line ){
        $line = str_replace( array('"' . chr(0x09) . '"', '""'),  array(chr(0x09),'"'),  $line );
        $line = substr( $line, 1, -1 ); // chop first " and last "
        return $line;
    }
    
}
# end of class



# ------------------------------------------------------
class phpfmgImage
{
    var $im = null;
    var $width = 73 ;
    var $height = 33 ;
    var $text = '' ; 
    var $line_distance = 8;
    var $text_len = 4 ;

    function phpfmgImage( $text = '', $len = 4 ){
        $this->text_len = $len ;
        $this->text = '' == $text ? $this->uniqid( $this->text_len ) : $text ;
        $this->text = strtoupper( substr( $this->text, 0, $this->text_len ) );
    }
    
    function create(){
        $this->im = imagecreate( $this->width, $this->height );
        $bgcolor   = imagecolorallocate($this->im, 255, 255, 255);
        $textcolor = imagecolorallocate($this->im, 0, 0, 0);
        $this->drawLines();
        imagestring($this->im, 5, 20, 9, $this->text, $textcolor);
    }
    
    function drawLines(){
        $linecolor = imagecolorallocate($this->im, 210, 210, 210);
    
        //vertical lines
        for($x = 0; $x < $this->width; $x += $this->line_distance) {
          imageline($this->im, $x, 0, $x, $this->height, $linecolor);
        };
    
        //horizontal lines
        for($y = 0; $y < $this->height; $y += $this->line_distance) {
          imageline($this->im, 0, $y, $this->width, $y, $linecolor);
        };
    }
    
    function out( $filename = '' ){
        if( function_exists('imageline') ){
            $this->create();
            if( '' == $filename ) header("Content-type: image/png");
            ( '' == $filename ) ? imagepng( $this->im ) : imagepng( $this->im, $filename );
            imagedestroy( $this->im ); 
        }else{
            $this->out_predefined_image(); 
        };
    }

    function uniqid( $len = 0 ){
        $md5 = md5( uniqid(rand()) );
        return $len > 0 ? substr($md5,0,$len) : $md5 ;
    }
    
    function out_predefined_image(){
        header("Content-type: image/png");
        $data = $this->getImage(); 
        echo base64_decode($data);
    }
    
    // Use predefined captcha random images if web server doens't have GD graphics library installed  
    function getImage(){
        $images = array(
			'A459' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7GB0YWllDHaY6IImxBjBMZW1gCAhAEhOZwhDKClQtgiQW0MroyjoVLgZ2UtRSIMjMigpDcl9Aq0grkJyKrDc0VDTUoSGgAdU8oFsaAhzQxRgdHVDcAhJjCGVAcfNAhR8VIRb3AQB8/cwDK9sgewAAAABJRU5ErkJggg==',
			'2505' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nM2Quw2AMAwFX4psYPZJCnojxQVM4xTZILBBmkxJSiMoQcKvO/lzMvqtFH/KJ36eJ0F1woZRJYW4YPu4kLoYLwyFktdlDtbv2Fvr67ZZP0aelZXM7Nh+Y14px3HDMlJfIGDrJ+ISKvbwg/+9mAe/E14NyvGszfiUAAAAAElFTkSuQmCC',
			'F9EA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QkMZQ1hDHVqRxQIaWFtZGximOqCIiTS6NjAEBGCIMTqIILkvNGrp0tTQlVnTkNwX0MAYiKQOKsYA0hsagiLG0oipDuQWdDGQmx1RxAYq/KgIsbgPALe8zHXMpZZ4AAAAAElFTkSuQmCC',
			'8126' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7WAMYAhhCGaY6IImJTGEMYHR0CAhAEgtoZQ1gbQh0EEBRB9QLFEN239KoVVGrVmamZiG5D6yulRHNPKDYFEYHEXSxAFQxkF5GBwYUvUCXhLKGBqC4eaDCj4oQi/sAWUXJGaiOq8cAAAAASUVORK5CYII=',
			'8A50' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7WAMYAlhDHVqRxUSmMIawNjBMdUASC2hlbQWKBQSgqBNpdJ3K6CCC5L6lUdNWpmZmZk1Dch9InUNDIEwd1DzRUEwxoHkNARh2ODo6oLiFNQBoXigDipsHKvyoCLG4DwDW980I3osAxQAAAABJRU5ErkJggg==',
			'20CA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WAMYAhhCHVqRxUSmMIYwOgRMdUASC2hlbWVtEAgIQNbdKtLo2sDoIILsvmnTVqauWpk1Ddl9ASjqwBDIA4mFhiC7pQFkhyCKOpEGkFsCUcRCQ0FudkQRG6jwoyLE4j4AIWvKXN9dxRMAAAAASUVORK5CYII=',
			'A207' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAd0lEQVR4nM2QsQ2AMAwEP0U2CPs4Bb2LuGEEpggFG3iFFGRKQkUsKEHgl1ycbOtk1Etl/Cmv+DlyCeokdcyzXyHIoWNBwxIjGcYrljFzy+k3lVpKnba582tz6o/e7YqAG1OYe80mElvmM8SRZYOQWvbV/x7Mjd8OCWrMEeZHJA0AAAAASUVORK5CYII=',
			'A0B9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7GB0YAlhDGaY6IImxBjCGsDY6BAQgiYlMYW1lbQh0EEESC2gVaXRtdISJgZ0UtXTaytTQVVFhSO6DqHOYiqw3NBQo1hDQgGoeyI4ANDsw3RLQiunmgQo/KkIs7gMAufjM+/artDgAAAAASUVORK5CYII=',
			'FCDD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAVElEQVR4nGNYhQEaGAYTpIn7QkMZQ1mB2AFJLKCBtdG10dEhAEVMpMG1IdBBBE2MFSEGdlJo1LRVS1dFZk1Dch+aOrximHZgcwummwcq/KgIsbgPAG8YzggZPhJPAAAAAElFTkSuQmCC',
			'BF1E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAW0lEQVR4nGNYhQEaGAYTpIn7QgNEQx2mMIYGIIkFTBFpYAhhdEBWF9Aq0sCILgZSNwUuBnZSaNTUsFXTVoZmIbkPTR3cPKLEsOgNDQC6JdQRxc0DFX5UhFjcBwCdJcr6Rg7h5gAAAABJRU5ErkJggg==',
			'C63E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7WEMYQxhDGUMDkMREWllbWRsdHZDVBTSKNDI0BKKKNYg0MCDUgZ0UtWpa2KqpK0OzkNwX0CDayoBuXoNIowO6eY2YYtjcgs3NAxV+VIRY3AcA7e/LQFbQS9oAAAAASUVORK5CYII=',
			'0D65' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7GB1EQxhCGUMDkMRYA0RaGR0dHZDViUwRaXRtQBULaAWJMbo6ILkvaum0lalTV0ZFIbkPrM7RoUEEQ28AihjEjkAHEQy3OAQguw/iZoapDoMg/KgIsbgPAHE1y9D+OUYsAAAAAElFTkSuQmCC',
			'B68D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QgMYQxhCGUMdkMQCprC2Mjo6OgQgi7WKNLI2BDqIoKgTaQCpE0FyX2jUtLBVoSuzpiG5L2CKaCuSOrh5rujmYRPD4hZsbh6o8KMixOI+AB7zzDo8UqopAAAAAElFTkSuQmCC',
			'D466' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QgMYWhlCGaY6IIkFTGGYyujoEBCALAZUxdrg6CCAIsboytrA6IDsvqilQDB1ZWoWkvsCWkVaWR0d0cwTDXVtCHQQQbWjlRVdbApDK7pbsLl5oMKPihCL+wAKVcz3fTcXiQAAAABJRU5ErkJggg==',
			'CD21' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WENEQxhCGVqRxURaRVoZHR2mIosFNIo0ujYEhKKINYg0OjQEwPSCnRS1atrKrJVZS5HdB1bXimoHWGwKmhjQDocALG5xQBUDuZk1NCA0YBCEHxUhFvcBADAbzPrOPCcUAAAAAElFTkSuQmCC',
			'A363' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7GB1YQxhCGUIdkMRYA0RaGR0dHQKQxESmMDS6Njg0iCCJBbQytLKCaCT3RS1dFbZ06qqlWUjuA6tzdGhANi80FGReALp5WMQw3RLQiunmgQo/KkIs7gMAJ9XNT6cyutYAAAAASUVORK5CYII=',
			'C5ED' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7WENEQ1lDHUMdkMREWkUaWBsYHQKQxAIaIWIiyGINIiFIYmAnRa2aunRp6MqsaUjuA5rT6IqhF4tYowiGmEgrayu6W1hDGEPQ3TxQ4UdFiMV9ANBsyyA14E2IAAAAAElFTkSuQmCC',
			'555E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QkNEQ1lDHUMDkMQCGkQaWBsYHRgIiAUGiISwToWLgZ0UNm3q0qWZmaFZyO5rZWh0aAhE0YtNLKBVpNEVTUxkCmsro6MjihhrAGMIQygjipsHKvyoCLG4DwDcn8o6TUosegAAAABJRU5ErkJggg==',
			'6C2E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WAMYQxlCGUMDkMREprA2Ojo6OiCrC2gRaXBtCEQVaxABknAxsJMio6atWrUyMzQLyX0hU4DqWhlR9bYCxaZgijkEoIqB3eKAKgZyM2toIIqbByr8qAixuA8ADH/KaKQtmuUAAAAASUVORK5CYII=',
			'ABD8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7GB1EQ1hDGaY6IImxBoi0sjY6BAQgiYlMEWl0bQh0EEESC2gFqmsIgKkDOylq6dSwpauipmYhuQ9NHRiGhmI1D7sdaG4JaMV080CFHxUhFvcBAFFgzjXVaPB/AAAAAElFTkSuQmCC',
			'0436' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7GB0YWhlDGaY6IImxBjBMZW10CAhAEhOZwhDK0BDoIIAkFtDK6MrQ6OiA7L6opUuXrpq6MjULyX0BrSKtQHUo5gW0ioY6AM0TQbWjlQFNDOiWVnS3YHPzQIUfFSEW9wEAgcLLvskiNowAAAAASUVORK5CYII=',
			'264A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7WAMYQxgaHVqRxUSmsLYytDpMdUASC2gVaWSY6hAQgKy7VaSBIdDRQQTZfdOmha3MzMyahuy+ANFW1ka4OjBkdBBpdA0NDA1BdkuDSKMDmjqRBqBb0MRCQ0FuRhUbqPCjIsTiPgC1/Mu0nIVXuAAAAABJRU5ErkJggg==',
			'12EE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7GB0YQ1hDHUMDkMRYHVhbWYEyyOpEHUQaXdHEgDxkMbCTVmatWro0dGVoFpL7gCqmoJsH5AVgijE6YIqxNmC4JUQ01BXNzQMVflSEWNwHANcYxkuNnqYeAAAAAElFTkSuQmCC',
			'B669' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QgMYQxhCGaY6IIkFTGFtZXR0CAhAFmsVaWRtcHQQQVEn0sDawAgTAzspNGpa2NKpq6LCkNwXMEW0ldXRYaoImnmuDQENWMTQ7MB0CzY3D1T4URFicR8AY9LNS/EWTSkAAAAASUVORK5CYII=',
			'0F0E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7GB1EQx2mMIYGIImxBog0MIQyOiCrE5ki0sDo6IgiFtAq0sDaEAgTAzspaunUsKWrIkOzkNyHpg6nGDY7sLmF0QEohubmgQo/KkIs7gMAkhvJSXRJiQIAAAAASUVORK5CYII=',
			'D215' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nM2QsRHAIAhFocgGZh8s0lNI4zRauAHJBhZxyljimTK5k9+9+3DvgDZNgpXyi58wBlAUNox1KxCQbI+Ly35ikEnxIOMXa6vtumM0fr2nPcmNuzyzfl+R3OiSeo+tn/AuXuikBf73YV78HmxqzJFPbKobAAAAAElFTkSuQmCC',
			'5769' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7QkNEQx1CGaY6IIkFNDA0Ojo6BASgibk2ODqIIIkFBjC0sjYwwsTATgqbtmra0qmrosKQ3dfKEMDq6DAVWS9DK6MDK9BUZLEAoGlAMRQ7RKaINDCiuYU1AKgCzc0DFX5UhFjcBwBB9cwNDltkKAAAAABJRU5ErkJggg==',
			'0DC2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7GB1EQxhCHaY6IImxBoi0MjoEBAQgiYlMEWl0bRB0EEESC2gFiQHlkNwXtXTaylQQjeQ+qLpGB0y9rQwYdghMYcDiFkw3O4aGDILwoyLE4j4A0pnMpUy5IT0AAAAASUVORK5CYII=',
			'0BBA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7GB1EQ1hDGVqRxVgDRFpZGx2mOiCJiUwRaXRtCAgIQBILaAWpc3QQQXJf1NKpYUtDV2ZNQ3IfmjqYGNC8wNAQDDsCUdRB3IKqF+JmRhSxgQo/KkIs7gMAQhTMIF68troAAAAASUVORK5CYII=',
			'1A81' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7GB0YAhhCGVqRxVgdGEMYHR2mIouJOrC2sjYEhKLqFWl0dHSA6QU7aWXWtJVZoauWIrsPTR1UTDTUtSGgFd08bGLoekVDRBodQhlCAwZB+FERYnEfAJoEyb7nRMTAAAAAAElFTkSuQmCC',
			'CD50' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7WENEQ1hDHVqRxURaRVpZGximOiCJBTSKNLo2MAQEIIs1AMWmMjqIILkvatW0lamZmVnTkNwHUufQEAhTh1sMbEcAih0gtzA6OqC4BeRmhlAGFDcPVPhREWJxHwCr8c1lD1lf/AAAAABJRU5ErkJggg==',
			'F487' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7QkMZWhlCGUNDkMQCGhimMjo6NIigioWyAklUMUZXkLoAJPeFRi1duip01cosJPcBdbUC1bUyoOgVDXVtCJiCKsbQCrQjAF2M0dHRAV0M6GYUsYEKPypCLO4DAKbezG/Tq2e1AAAAAElFTkSuQmCC',
			'2FA1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7WANEQx2mMLQii4lMEWlgCGWYiiwW0CrSwOjoEIqiGyjGCpRBcd+0qWFLV0UtRXFfAIo6MGR0AIqFooqxNmCqE8EiFhoKFgsNGAThR0WIxX0ABRDMTkEXtFIAAAAASUVORK5CYII=',
			'EABF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7QkMYAlhDGUNDkMQCGhhDWBsdHRhQxFhbWRsC0cREGl0R6sBOCo2atjI1dGVoFpL70NRBxURDXbGZh98OqJuBYqGMKGIDFX5UhFjcBwAsEMxcp6UhOgAAAABJRU5ErkJggg==',
			'6039' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WAMYAhhDGaY6IImJTGEMYW10CAhAEgtoYW1laAh0EEEWaxBpdGh0hImBnRQZNW1l1tRVUWFI7guZAlLnMBVFbytQDGQCihjIjgAUO7C5BZubByr8qAixuA8ABvTM8ibKMuwAAAAASUVORK5CYII=',
			'933A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WANYQxhDGVqRxUSmiLSyNjpMdUASC2hlaHRoCAgIQBUDijo6iCC5b9rUVWGrpq7MmobkPlZXFHUQCDYvMDQESUwAIoaiDuIWVL0QNzOimjdA4UdFiMV9AEykzA4xiMN7AAAAAElFTkSuQmCC',
			'C804' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7WEMYQximMDQEIImJtLK2MoQyNCKLBTSKNDo6OrSiiDWwtrI2BEwJQHJf1KqVYUtXRUVFIbkPoi7QAVWvSKNrQ2BoCKYd2NyCIobNzQMVflSEWNwHAMDPzkwBBuZIAAAAAElFTkSuQmCC',
			'AA63' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7GB0YAhhCGUIdkMRYAxhDGB0dHQKQxESmsLayNjg0iCCJBbSKNLqCaCT3RS2dtjJ16qqlWUjuA6tzdGhANi80VDTUFSiCaR6mmCOaW0BiDmhuHqjwoyLE4j4A1N7OH87f/UoAAAAASUVORK5CYII=',
			'3873' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7RAMYQ1hDA0IdkMQCprC2MjQEOgQgq2wVaXRoCGgQQRYDqQOLIty3Mmpl2Kqlq5ZmIbsPpG4KQwOGeQEMqOYBxRwdUMVAbmFtYERxC9jNDQwobh6o8KMixOI+ADxYzNHfmYqVAAAAAElFTkSuQmCC',
			'E3F4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7QkNYQ1hDAxoCkMQCGkRaWRsYGlHFGBpdGxha0cRA6qYEILkvNGpV2NLQVVFRSO6DqGN0wDSPMTQE0w5sbkERA7sZTWygwo+KEIv7AOfZzlzc5AM7AAAAAElFTkSuQmCC',
			'3712' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nM2QsQ3AIAwEnyIbwD5mAxfQMA0U2cDJDmHKQNIYJWUi4e9e/6+TUR+XMZN+4XPsIgk2Uh4LCgUw6+SK4oMhqz1priBbxXekujfVpPkEjL457Bm6+oO39KxgYLF3f2C22UQfwwT/+1AvfCed3suduDUfhQAAAABJRU5ErkJggg==',
			'F91D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QkMZQximMIY6IIkFNLC2MoQwOgSgiIk0OgLFRNDEHKbAxcBOCo1aujRr2sqsaUjuC2hgDERSBxVjaMQUY8EiBnTLFHS3MIYwhjqiuHmgwo+KEIv7ACeNzEWGvwhJAAAAAElFTkSuQmCC',
			'E812' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QkMYQximMEx1QBILaGBtZQhhCAhAERNpdAxhdBBBVzeFoUEEyX2hUSvDVk1btSoKyX1QdY0OaOY5TGFoZcAUm8KAaUcAupsZQx1DQwZB+FERYnEfAE7izSOPH1XTAAAAAElFTkSuQmCC',
			'F0A0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QkMZAhimMLQiiwU0MIYwhDJMdUARY21ldHQICEARE2l0bQh0EEFyX2jUtJWpqyKzpiG5D00dQiwUXYy1lbUhAM0OxhCgGJpbGAKAYihuHqjwoyLE4j4A5sLN2UTKN2UAAAAASUVORK5CYII=',
			'F999' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7QkMZQxhCGaY6IIkFNLC2Mjo6BASgiIk0ujYEOojgFgM7KTRq6dLMzKioMCT3BTQwBjqEBExF1cvQ6AAyAUWMpdGxIQDNDmxuwXTzQIUfFSEW9wEAyOHNjHX18DoAAAAASUVORK5CYII=',
			'7E7C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7QkNFQ1lDA6YGIIu2igDJgAARDLFABxZksSlAsUZHBxT3RU0NW7V0ZRay+xgdgOqmMDog28vaABQLQBUTAUJGB0YUOwKAYqxAlSIoYkA3NzCgunmAwo+KEIv7AEP3yoEFRQEdAAAAAElFTkSuQmCC',
			'D460' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7QgMYWhlCgRhJLGAKw1RGR4epDshiQFWsDQ4BAShijK6sDYwOIkjui1oKBFNXZk1Dcl9Aq0grq6MjTB1UTDTUtSEQTYyhlbUhANWOKQyt6G7B5uaBCj8qQizuAwCFns1UmbqUWAAAAABJRU5ErkJggg==',
			'5CE3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QkMYQ1lDHUIdkMQCGlgbXRsYHQJQxEQaXIG0CJJYYIBIAytYDuG+sGnTVi0NXbU0C9l9rSjqUMSQzQtoxbRDZAqmW1gDMN08UOFHRYjFfQBuq80LBkpMfgAAAABJRU5ErkJggg==',
			'FE3D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAUklEQVR4nGNYhQEaGAYTpIn7QkNFQxmB0AFJLKBBpIG10dEhAE2MoSHQQQRdDKhOBMl9oVFTw1ZNXZk1Dcl9aOrwm4dFDNMtmG4eqPCjIsTiPgAZJMz46bGQwAAAAABJRU5ErkJggg==',
			'4828' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpI37pjCGMIQyTHVAFgthbWV0dAgIQBJjDBFpdG0IdBBBEmOdwtrK0BAAUwd20rRpK8NWrcyamoXkvgCQulYGFPNCQ0UaHaYwopjHMAUoFoAuBnSLA6pekJtZQwNQ3TxQ4Uc9iMV9AGS6y5wUynlSAAAAAElFTkSuQmCC',
			'374A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7RANEQx0aHVqRxQKmMABFHKY6IKtsBYpNdQgIQBabAhQNdHQQQXLfyqhV01ZmZmZNQ3bfFIYA1ka4Oqh5jA6soYGhIShirA0MaOoCpohgiIkGYIoNVPhREWJxHwCNq8wtd96fEQAAAABJRU5ErkJggg==',
			'C140' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WEMYAhgaHVqRxURaGQMYWh2mOiCJBTSyBjBMdQgIQBZrAOoNdHQQQXJfFBCtzMzMmobkPpA61ka4OoRYaCCqWCPYLSh2iLSCxVDcwhrCGoru5oEKPypCLO4DAO6+yzYeBAosAAAAAElFTkSuQmCC',
			'565C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7QkMYQ1hDHaYGIIkFNLC2sjYwBIigiIk0sjYwOrAgiQUCVbBOZXRAdl/YtGlhSzMzs1Dc1yraClTtgGJzq0ijA5pYAFDMFSiGbIfIFNZWRkcHFLewBjCGMIQyoLh5oMKPihCL+wDU+8sIbYR5GQAAAABJRU5ErkJggg==',
			'EF97' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7QkNEQx1CGUNDkMQCGkQaGB0dgCSqGCuYxBQLQHJfaNTUsJWZUSuzkNwH1hUS0MqAphdITkEXY2wICMAQc3R0QHUzUG8oI4rYQIUfFSEW9wEAVsHM2suAVYkAAAAASUVORK5CYII=',
			'AA14' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7GB0YAhimMDQEIImxBjCGMIQwNCKLiUxhbQWKtiKLBbSKNDpMYZgSgOS+qKXTVmZNWxUVheQ+iDpGB2S9oaGioUCx0BBM8xqw2IEh5hjqgCI2UOFHRYjFfQB9MM62sEVWzAAAAABJRU5ErkJggg==',
			'226E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WAMYQxhCGUMDkMREprC2Mjo6OiCrC2gVaXRtQBVjaGUAijHCxCBumrZq6dKpK0OzkN0XwDCFFc08oK4A1oZAFDFWoCi6mAhIFE1vaKhoqAOamwcq/KgIsbgPAHSCySvlTxswAAAAAElFTkSuQmCC',
			'3437' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7RAMYWhlDGUNDkMQCpjBMZW10aBBBVtnKEAqUQRWbwujKAFQXgOS+lVFLl66aumplFrL7poi0AtW1otjcKhrqALIJ1Q6gmoAABlS3tLI2OjpgcTOK2ECFHxUhFvcBAFMAzBvoQjOCAAAAAElFTkSuQmCC',
			'9440' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WAMYWhkaHVqRxUSmMExlaHWY6oAkFtDKEMow1SEgAEWM0ZUh0NFBBMl906YuXboyMzNrGpL7WF1FWlkb4eogsFU01DU0EEVMoBXsFhQ7gG4BiaG4BZubByr8qAixuA8Aaz/MXJt9M7AAAAAASUVORK5CYII=',
			'D4E2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7QgMYWllDHaY6IIkFTGGYytrAEBCALNbKEMrawOgggiLG6ApU1yCC5L6opUAQCqSR3BfQKtIKVNeIYkeraKhrA0MrA6odIHVTGFDdAhILwHSzY2jIIAg/KkIs7gMARxfNB2GojkMAAAAASUVORK5CYII=',
			'1370' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7GB1YQ1hDA1qRxVgdRID8gKkOSGKiDgyNDg0BAQEoehlaGRodHUSQ3Lcya1XYqqUrs6YhuQ+sbgojTB1MrNEhAFPM0YEBzQ6RVtYGBlS3hADd3MCA4uaBCj8qQizuAwC1Hck9JhbdegAAAABJRU5ErkJggg==',
			'9193' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WAMYAhhCGUIdkMREpjAGMDo6OgQgiQW0sgawNgQ0iKCIMYDFApDcN23qqqiVmVFLs5Dcx+oKtCMErg4CgXoZ0MwTAIoxoomJTGHAcAvQJaHobh6o8KMixOI+ALDZyiJ1QCNvAAAAAElFTkSuQmCC',
			'4E53' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpI37poiGsoY6hDogi4WINLA2MDoEIIkxgsUYGkSQxFinAMWmMjQEILlv2rSpYUszs5ZmIbkvYApIV0ADsnmhoRAxZPMYQOZhEWN0dERxC8jNDECI4uaBCj/qQSzuAwDu4cwbiyl5AwAAAABJRU5ErkJggg==',
			'77F3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7QkNFQ11DA0IdkEVbGRpdGxgdAjDEGBpEkMWmMLSyAukAZPdFrZq2NHTV0iwk9zE6MAQgqQNDVqAoK5p5IkBRdLEAsCiqWyBiDKhuHqDwoyLE4j4A9FjL7VPbRRkAAAAASUVORK5CYII=',
			'CE17' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7WENEQxmmMIaGIImJtIo0MIQAaSSxgEaRBkZ0MRBvCohGuC9q1dSwVdNWrcxCch9UXSsDpt4pDGh2AEUCGNDdMoXRAd3NjKGOKGIDFX5UhFjcBwBLIstRRM49ywAAAABJRU5ErkJggg==',
			'A21A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpIn7GB0YQximMLQii7EGsLYyhDBMdUASE5ki0ugYwhAQgCQW0MrQ6DCF0UEEyX1RS1ctXTVtZdY0JPcB1U1hQKgDw9BQhgCgWGgIinmMDujqAlpZGzDFREMdQx1RxAYq/KgIsbgPAP3jy2ACec31AAAAAElFTkSuQmCC',
			'1B54' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7GB1EQ1hDHRoCkMRYHURaWRsYGpHFRB1EGl0bGFoDUPQC1U1lmBKA5L6VWVPDlmZmRUUhuQ+kjqEh0AFNb6NDQ2BoCJqYK9Al6HYwOqK6TzRENIQhlAFFbKDCj4oQi/sA6DjLQpUJVCwAAAAASUVORK5CYII=',
			'4071' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpI37pjAEsIYGtKKIhTCGMDQETEUWYwxhBaoJCEUWY50i0ujQ6ADTC3bStGnTVmYtXbUU2X0BIHVTGFDsCA0FigWgijFMYW1ldEAXA9rcgC4GdHMDQ2jAYAg/6kEs7gMAlYDLokWGnh4AAAAASUVORK5CYII=',
			'D339' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QgNYQxhDGaY6IIkFTBFpZW10CAhAFmtlaHRoCHQQQRUDijrCxMBOilq6KmzV1FVRYUjug6hzmCqCYV5AAxYxVDuwuAWbmwcq/KgIsbgPACPfzp6XXrAMAAAAAElFTkSuQmCC',
			'3E2F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7RANEQxlCGUNDkMQCpog0MDo6OqCobBVpYG0IRBUDqmNAiIGdtDJqatiqlZmhWcjuA6lrZcQwj2EKFrEAVDGwWxxQxUBuZg1Fc8sAhR8VIRb3AQCqzshfMCirngAAAABJRU5ErkJggg==',
			'85AC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WANEQxmmMEwNQBITmSLSwBDKECCCJBbQKtLA6OjowIKqLoS1IdAB2X1Lo6YuXboqMgvZfSJTGBpdEeqg5gHFQtHFRMDqUO1gbWVtCEBxC2sAI9DeABQ3D1T4URFicR8ABtnMVm+kHfEAAAAASUVORK5CYII=',
			'CC61' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7WEMYQxlCGVqRxURaWRsdHR2mIosFNIo0uDY4hKKINYg0sDbA9YKdFLVq2qqlU1ctRXYfWJ2jQyum3oBWTDsCsLkFRQzq5tCAQRB+VIRY3AcATkrNKa3YxbwAAAAASUVORK5CYII=',
			'D666' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QgMYQxhCGaY6IIkFTGFtZXR0CAhAFmsVaWRtcHQQQBVrYG1gdEB2X9TSaWFLp65MzUJyX0CraCuroyOGea4NgQ4ihMSwuAWbmwcq/KgIsbgPAFr3zT1t3BFoAAAAAElFTkSuQmCC',
			'9EC7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7WANEQxlCHUNDkMREpog0MDoENIggiQW0ijSwNghgEQPSSO6bNnVq2NJVq1ZmIbmP1RWsrhXFZojeKchiAhA7Ahgw3BLogMXNKGIDFX5UhFjcBwD+psrn0NeGJQAAAABJRU5ErkJggg==',
			'7953' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7QkMZQ1hDHUIdkEVbWVtZGxgdAlDERBpdgbQIstgUoNhUhoYAZPdFLV2ampm1NAvJfYwOjIEOQFXI5rE2MDSCxJDNE2lgAdqBKhbQwNrK6OiI4paABsYQhlAGVDcPUPhREWJxHwDeOszUK6q0WAAAAABJRU5ErkJggg==',
			'98B5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDGUMDkMREprC2sjY6OiCrC2gVaXRtCEQTA6tzdUBy37SpK8OWhq6MikJyH6srSJ1DgwiyzWDzAlDEBKB2iGC4xSEA2X0QNzNMdRgE4UdFiMV9ANy5zBBh+VniAAAAAElFTkSuQmCC',
			'C9EC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7WEMYQ1hDHaYGIImJtLK2sjYwBIggiQU0ijS6NjA6sCCLNUDEkN0XtWrp0tTQlVnI7gtoYAxEUgcVY2jEEGtkwbADm1uwuXmgwo+KEIv7AAfhyzyKYhsYAAAAAElFTkSuQmCC',
			'B2B6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7QgMYQ1hDGaY6IIkFTGFtZW10CAhAFmsVaXRtCHQQQFHH0Oja6OiA7L7QqFVLl4auTM1Cch9Q3RTWRkc08xgCWIHmiaCIMTpgiE1hbUB3S2iAaKgrmpsHKvyoCLG4DwBhB83voqkN+QAAAABJRU5ErkJggg==',
			'8344' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7WANYQxgaHRoCkMREpoi0MrQ6NCKLBbQCVU11aEVVx9DKEOgwJQDJfUujVoWtzMyKikJyH0gda6OjA7p5rqGBoSHodmBzC5oYNjcPVPhREWJxHwC7yc8Yd6qJgAAAAABJRU5ErkJggg==',
			'DA94' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7QgMYAhhCGRoCkMQCpjCGMDo6NKKItbK2sgJJVDGRRleg6gAk90UtnbYyMzMqKgrJfSB1DiGBDqh6RUMdGgJDQ9DMcwS6BNUtQDFHBxSx0ACgeWhuHqjwoyLE4j4A62XQSMX4P7YAAAAASUVORK5CYII=',
			'7C7D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7QkMZQ1lDA0MdkEVbWRsdGgIdAlDERBpAYiLIYlOAvEZHmBjETVHTVq1aujJrGpL7GEEqpjCi6GVtAPICUMVEgNDRAVUsoIG10RVoQgCKGNDNQIzi5gEKPypCLO4DAJ8sy5aaQS8SAAAAAElFTkSuQmCC',
			'67D0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7WANEQ11DGVqRxUSmMDS6NjpMdUASC2gBijUEBAQgizUwtLI2BDqIILkvMmrVtKWrIrOmIbkvZApDAJI6iN5WRgdMMdYGVjQ7RKaINLCiuYU1ACiG5uaBCj8qQizuAwDNMs1h36WPXAAAAABJRU5ErkJggg==',
			'CB41' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7WENEQxgaHVqRxURaRVoZWh2mIosFNIo0Okx1CEURA6pkCITrBTspatXUsJWZWUuR3QdSx4pmB1Cs0TU0oBXDDmxuQRODujk0YBCEHxUhFvcBAFJMzfzat21VAAAAAElFTkSuQmCC',
			'9F57' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7WANEQ11DHUNDkMREpog0sIJoJLGAVhxiU4E0kvumTZ0atjQza2UWkvtYXUXAqlFsbgWLTUEWEwDbERCALAZyC6OjowOqm4F6QxlRxAYq/KgIsbgPAItNy1U7f0upAAAAAElFTkSuQmCC',
			'FF05' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7QkNFQx2mMIYGIIkFNIg0MIQyOjCgiTE6OmKIsTYEujoguS80amrY0lWRUVFI7oOoA5uKphdTDGQHuhhDKEMAhvumMEx1GAThR0WIxX0AiajMqqzojG8AAAAASUVORK5CYII=',
			'ABEF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWElEQVR4nGNYhQEaGAYTpIn7GB1EQ1hDHUNDkMRYA0RaWYEyyOpEpog0uqKJBbSiqAM7KWrp1LCloStDs5Dch6YODENDsZpHyA6oGNjNKGIDFX5UhFjcBwAbO8nmF/bYvgAAAABJRU5ErkJggg==',
			'A5EF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7GB1EQ1lDHUNDkMRYA0QaWIEyyOpEpmCKBbSKhCCJgZ0UtXTq0qWhK0OzkNwX0MrQ6IqmNzQUUwxoHhYx1lZMexlDgG5GERuo8KMixOI+ANK3ybA0JWIRAAAAAElFTkSuQmCC',
			'6EA7' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7WANEQxmmMIaGIImJTBFpYAgF0khiAS0iDYyODqhiQB4rkAxAcl9k1NSwpauiVmYhuS9kClhdK7K9Aa1AsdCAKRhiDQEBDGhuYW0IdEB3M7rYQIUfFSEW9wEAknfMgKgTvcAAAAAASUVORK5CYII=',
			'38E0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7RAMYQ1hDHVqRxQKmsLayNjBMdUBW2SrS6NrAEBCALAZWx+ggguS+lVErw5aGrsyahuw+VHVI5mETQ7UDm1uwuXmgwo+KEIv7ABP3y1TFbLwDAAAAAElFTkSuQmCC',
			'5E05' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7QkNEQxmmMIYGIIkFNIg0MIQyOjCgiTE6OqKIBQaINLA2BLo6ILkvbNrUsKWrIqOikN3XClIHNhUBsYgFtELsQBYTmQJyC0MAsvtYA0BuZpjqMAjCj4oQi/sAxT3LGfgLH+AAAAAASUVORK5CYII=',
			'E510' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QkNEQxmmMLQiiwU0iDQwhDBMdUATYwxhCAhAFQthmMLoIILkvtCoqUtXTVuZNQ3JfUA9jQ4IdXjERIBi6HawtgLdh+KW0BDGEMZQBxQ3D1T4URFicR8AAIXM+WcjHfAAAAAASUVORK5CYII=',
			'3B25' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7RANEQxhCGUMDkMQCpoi0Mjo6OqCobBVpdG0IRBUDqmNoCHR1QHLfyqipYatWZkZFIbsPpA6oUgTNPIcpWMQCGB1E0N3iwBCA7D6Qm1lDA6Y6DILwoyLE4j4Aqo/LF//AEbMAAAAASUVORK5CYII=',
			'8D7F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7WANEQ1hDA0NDkMREpoi0MjQEOiCrC2gVaXRAEwOqa3RodISJgZ20NGrayqylK0OzkNwHVjeFEdO8AEwxRwdGdDtaWRtQxcBuRhMbqPCjIsTiPgD9/crijvtX1gAAAABJRU5ErkJggg==',
			'18C2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7GB0YQxhCHaY6IImxOrC2MjoEBAQgiYk6iDS6Ngg6iKDoZW1lBdIiSO5bmbUybCmQjkJyH1RdowOKXpB5DK0MGGICUxjQ7AC5BVlMNATkZsfQkEEQflSEWNwHALjayWuw81xNAAAAAElFTkSuQmCC',
			'2071' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nM2QsQ3AIAwETeENGIgRvsBLZApTsAFhA4owZZCiSFhJmUj4u5NfPpn6Y5RWyi9+DAIL8sx8cZEU+8yQeexATDv7FFK4u5dTrcfWejN+GHuFzA0XBoNlrJxdsMyri6yWiQxnJcEC//swL34nQOjLQbXJIrYAAAAASUVORK5CYII=',
			'F1D1' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAVUlEQVR4nGNYhQEaGAYTpIn7QkMZAlhDGVqRxQIaGANYGx2mooqxBrA2BISiijGAxGB6wU4KjVoVtRSEkNyHpo50sUYHNDHWUKCbQwMGQfhREWJxHwDrNMwWk1CimQAAAABJRU5ErkJggg==',
			'DC1D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYElEQVR4nGNYhQEaGAYTpIn7QgMYQxmmMIY6IIkFTGFtdAhhdAhAFmsVaXAEiomgiQH1wsTATopaOm3Vqmkrs6YhuQ9NHV4xB3QxkFumoLoF5GbGUEcUNw9U+FERYnEfABXdzPhPr0irAAAAAElFTkSuQmCC',
			'155D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7GB1EQ1lDHUMdkMRYHUQaWIEyAUhiolAxERS9IiGsU+FiYCetzJq6dGlmZtY0JPcxOjA0OjQEounFJibS6IohxtrK6OiI6pYQxhCGUEYUNw9U+FERYnEfADJzyEl6JayZAAAAAElFTkSuQmCC',
			'6AB8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7WAMYAlhDGaY6IImJTGEMYW10CAhAEgtoYW1lbQh0EEEWaxBpdEWoAzspMmraytTQVVOzkNwXMgVFHURvq2ioK7p5rUB1aGIiWPSyBgDF0Nw8UOFHRYjFfQBkg85GQdgYuAAAAABJRU5ErkJggg==',
			'992A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAd0lEQVR4nGNYhQEaGAYTpIn7WAMYQxhCGVqRxUSmsLYyOjpMdUASC2gVaXRtCAgIQBNzaAh0EEFy37SpS5dmrczMmobkPlZXxkCHVkaYOghsZWh0mMIYGoIkJtDK0ugQgKoO7BYHVDGQm1lDA1HNG6DwoyLE4j4A+pHK4aGYX50AAAAASUVORK5CYII=',
			'5240' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nGNYhQEaGAYTpIn7QkMYQxgaHVqRxQIaWFsZWh2mOqCIiTQCRQICkMQCA4A6Ax0dRJDcFzZt1dKVmZlZ05Dd18owhbURrg4mFsAaGogiFtDK6AA0EcUOkSmsDQyNqG5hDRANdUBz80CFHxUhFvcBAJOKzSKpmVvtAAAAAElFTkSuQmCC'        
        );
        $this->text = array_rand( $images );
        return $images[ $this->text ] ;    
    }
    
    function out_processing_gif(){
        $image = dirname(__FILE__) . '/processing.gif';
        $base64_image = "R0lGODlhFAAUALMIAPh2AP+TMsZiALlcAKNOAOp4ANVqAP+PFv///wAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCgAIACwAAAAAFAAUAAAEUxDJSau9iBDMtebTMEjehgTBJYqkiaLWOlZvGs8WDO6UIPCHw8TnAwWDEuKPcxQml0Ynj2cwYACAS7VqwWItWyuiUJB4s2AxmWxGg9bl6YQtl0cAACH5BAUKAAgALAEAAQASABIAAAROEMkpx6A4W5upENUmEQT2feFIltMJYivbvhnZ3Z1h4FMQIDodz+cL7nDEn5CH8DGZhcLtcMBEoxkqlXKVIgAAibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkphaA4W5upMdUmDQP2feFIltMJYivbvhnZ3V1R4BNBIDodz+cL7nDEn5CH8DGZAMAtEMBEoxkqlXKVIg4HibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpjaE4W5tpKdUmCQL2feFIltMJYivbvhnZ3R0A4NMwIDodz+cL7nDEn5CH8DGZh8ONQMBEoxkqlXKVIgIBibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpS6E4W5spANUmGQb2feFIltMJYivbvhnZ3d1x4JMgIDodz+cL7nDEn5CH8DGZgcBtMMBEoxkqlXKVIggEibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpAaA4W5vpOdUmFQX2feFIltMJYivbvhnZ3V0Q4JNhIDodz+cL7nDEn5CH8DGZBMJNIMBEoxkqlXKVIgYDibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpz6E4W5tpCNUmAQD2feFIltMJYivbvhnZ3R1B4FNRIDodz+cL7nDEn5CH8DGZg8HNYMBEoxkqlXKVIgQCibbK9YLBYvLtHH5K0J0IACH5BAkKAAgALAEAAQASABIAAAROEMkpQ6A4W5spIdUmHQf2feFIltMJYivbvhnZ3d0w4BMAIDodz+cL7nDEn5CH8DGZAsGtUMBEoxkqlXKVIgwGibbK9YLBYvLtHH5K0J0IADs=";
        $binary = is_file($image) ? join("",file($image)) : base64_decode($base64_image); 
        header("Cache-Control: post-check=0, pre-check=0, max-age=0, no-store, no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: image/gif");
        echo $binary;
    }

}
# end of class phpfmgImage
# ------------------------------------------------------
# end of module : captcha


# module user
# ------------------------------------------------------
function phpfmg_user_isLogin(){
    return ( isset($_SESSION['authenticated']) && true === $_SESSION['authenticated'] );
}


function phpfmg_user_logout(){
    session_destroy();
    header("Location: admin.php");
}

function phpfmg_user_login()
{
    if( phpfmg_user_isLogin() ){
        return true ;
    };
    
    $sErr = "" ;
    if( 'Y' == $_POST['formmail_submit'] ){
        if(
            defined( 'PHPFMG_USER' ) && strtolower(PHPFMG_USER) == strtolower($_POST['Username']) &&
            defined( 'PHPFMG_PW' )   && strtolower(PHPFMG_PW) == strtolower($_POST['Password']) 
        ){
             $_SESSION['authenticated'] = true ;
             return true ;
             
        }else{
            $sErr = 'Login failed. Please try again.';
        }
    };
    
    // show login form 
    phpfmg_admin_header();
?>
<form name="frmFormMail" action="" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:380px;height:260px;">
<fieldset style="padding:18px;" >
<table cellspacing='3' cellpadding='3' border='0' >
	<tr>
		<td class="form_field" valign='top' align='right'>Email :</td>
		<td class="form_text">
            <input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" class='text_box' >
		</td>
	</tr>

	<tr>
		<td class="form_field" valign='top' align='right'>Password :</td>
		<td class="form_text">
            <input type="password" name="Password"  value="" class='text_box'>
		</td>
	</tr>

	<tr><td colspan=3 align='center'>
        <input type='submit' value='Login'><br><br>
        <?php if( $sErr ) echo "<span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
        <a href="admin.php?mod=mail&func=request_password">I forgot my password</a>   
    </td></tr>
</table>
</fieldset>
</div>
<script type="text/javascript">
    document.frmFormMail.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();
}


function phpfmg_mail_request_password(){
    $sErr = '';
    if( $_POST['formmail_submit'] == 'Y' ){
        if( strtoupper(trim($_POST['Username'])) == strtoupper(trim(PHPFMG_USER)) ){
            phpfmg_mail_password();
            exit;
        }else{
            $sErr = "Failed to verify your email.";
        };
    };
    
    $n1 = strpos(PHPFMG_USER,'@');
    $n2 = strrpos(PHPFMG_USER,'.');
    $email = substr(PHPFMG_USER,0,1) . str_repeat('*',$n1-1) . 
            '@' . substr(PHPFMG_USER,$n1+1,1) . str_repeat('*',$n2-$n1-2) . 
            '.' . substr(PHPFMG_USER,$n2+1,1) . str_repeat('*',strlen(PHPFMG_USER)-$n2-2) ;


    phpfmg_admin_header("Request Password of Email Form Admin Panel");
?>
<form name="frmRequestPassword" action="admin.php?mod=mail&func=request_password" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:580px;height:260px;text-align:left;">
<fieldset style="padding:18px;" >
<legend>Request Password</legend>
Enter Email Address <b><?php echo strtoupper($email) ;?></b>:<br />
<input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" style="width:380px;">
<input type='submit' value='Verify'><br>
The password will be sent to this email address. 
<?php if( $sErr ) echo "<br /><br /><span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
</fieldset>
</div>
<script type="text/javascript">
    document.frmRequestPassword.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();    
}


function phpfmg_mail_password(){
    phpfmg_admin_header();
    if( defined( 'PHPFMG_USER' ) && defined( 'PHPFMG_PW' ) ){
        $body = "Here is the password for your form admin panel:\n\nUsername: " . PHPFMG_USER . "\nPassword: " . PHPFMG_PW . "\n\n" ;
        if( 'html' == PHPFMG_MAIL_TYPE )
            $body = nl2br($body);
        mailAttachments( PHPFMG_USER, "Password for Your Form Admin Panel", $body, PHPFMG_USER, 'You', "You <" . PHPFMG_USER . ">" );
        echo "<center>Your password has been sent.<br><br><a href='admin.php'>Click here to login again</a></center>";
    };   
    phpfmg_admin_footer();
}


function phpfmg_writable_check(){
 
    if( is_writable( dirname(PHPFMG_SAVE_FILE) ) && is_writable( dirname(PHPFMG_EMAILS_LOGFILE) )  ){
        return ;
    };
?>
<style type="text/css">
    .fmg_warning{
        background-color: #F4F6E5;
        border: 1px dashed #ff0000;
        padding: 16px;
        color : black;
        margin: 10px;
        line-height: 180%;
        width:80%;
    }
    
    .fmg_warning_title{
        font-weight: bold;
    }

</style>
<br><br>
<div class="fmg_warning">
    <div class="fmg_warning_title">Your form data or email traffic log is NOT saving.</div>
    The form data (<?php echo PHPFMG_SAVE_FILE ?>) and email traffic log (<?php echo PHPFMG_EMAILS_LOGFILE?>) will be created automatically when the form is submitted. 
    However, the script doesn't have writable permission to create those files. In order to save your valuable information, please set the directory to writable.
     If you don't know how to do it, please ask for help from your web Administrator or Technical Support of your hosting company.   
</div>
<br><br>
<?php
}


function phpfmg_log_view(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    
    phpfmg_admin_header();
   
    $file = $files[$n];
    if( is_file($file) ){
        if( 1== $n ){
            echo "<pre>\n";
            echo join("",file($file) );
            echo "</pre>\n";
        }else{
            $man = new phpfmgDataManager();
            $man->displayRecords();
        };
     

    }else{
        echo "<b>No form data found.</b>";
    };
    phpfmg_admin_footer();
}


function phpfmg_log_download(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );

    $file = $files[$n];
    if( is_file($file) ){
        phpfmg_util_download( $file, PHPFMG_SAVE_FILE == $file ? 'form-data.csv' : 'email-traffics.txt', true, 1 ); // skip the first line
    }else{
        phpfmg_admin_header();
        echo "<b>No email traffic log found.</b>";
        phpfmg_admin_footer();
    };

}


function phpfmg_log_delete(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    phpfmg_admin_header();

    $file = $files[$n];
    if( is_file($file) ){
        echo unlink($file) ? "It has been deleted!" : "Failed to delete!" ;
    };
    phpfmg_admin_footer();
}


function phpfmg_util_download($file, $filename='', $toCSV = false, $skipN = 0 ){
    if (!is_file($file)) return false ;

    set_time_limit(0);


    $buffer = "";
    $i = 0 ;
    $fp = @fopen($file, 'rb');
    while( !feof($fp)) { 
        $i ++ ;
        $line = fgets($fp);
        if($i > $skipN){ // skip lines
            if( $toCSV ){ 
              $line = str_replace( chr(0x09), ',', $line );
              $buffer .= phpfmg_data2record( $line, false );
            }else{
                $buffer .= $line;
            };
        }; 
    }; 
    fclose ($fp);
  

    
    /*
        If the Content-Length is NOT THE SAME SIZE as the real conent output, Windows+IIS might be hung!!
    */
    $len = strlen($buffer);
    $filename = basename( '' == $filename ? $file : $filename );
    $file_extension = strtolower(substr(strrchr($filename,"."),1));

    switch( $file_extension ) {
        case "pdf": $ctype="application/pdf"; break;
        case "exe": $ctype="application/octet-stream"; break;
        case "zip": $ctype="application/zip"; break;
        case "doc": $ctype="application/msword"; break;
        case "xls": $ctype="application/vnd.ms-excel"; break;
        case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
        case "gif": $ctype="image/gif"; break;
        case "png": $ctype="image/png"; break;
        case "jpeg":
        case "jpg": $ctype="image/jpg"; break;
        case "mp3": $ctype="audio/mpeg"; break;
        case "wav": $ctype="audio/x-wav"; break;
        case "mpeg":
        case "mpg":
        case "mpe": $ctype="video/mpeg"; break;
        case "mov": $ctype="video/quicktime"; break;
        case "avi": $ctype="video/x-msvideo"; break;
        //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
        case "php":
        case "htm":
        case "html": 
                $ctype="text/plain"; break;
        default: 
            $ctype="application/x-download";
    }
                                            

    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");
    //Force the download
    header("Content-Disposition: attachment; filename=".$filename.";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    
    while (@ob_end_clean()); // no output buffering !
    flush();
    echo $buffer ;
    
    return true;
 
    
}
?>