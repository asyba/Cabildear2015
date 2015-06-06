<a href="<?php getURL('/form');?>"><div class="wrapper"></div></a>

	
    <!-- Page Content -->
    <div class="container">

	<div class="boxi" style="display:none;">
	
	<textarea rows="4" cols="50" style="color: black; background-color: transparent;" >
	Mejor que hacer esot seria mejor un boton, desp carga ahi, ya que dos pasos esta de mas...
</textarea>
		<select>
		<option value="volvo">Tema 1</option>
		<option value="saab">Tema 2</option>
		<option value="opel">Tema 3</option>
		<option value="audi">Tema 4</option>
		</select>
		<select>
		<option value="volvo">Politico 1</option>
		<option value="saab">Politico 2</option>
		<option value="opel">Politico 3</option>
		<option value="audi">Todos</option>
		</select>
	</div>
	
        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header"></h1>
                <div style="margin-bottom: 30px;">
					<button type="button" id="propuestaBoton" class="btn btn-primary" style="background-color: rgb(0, 0, 0);">Propuestas</button>
                    <button type="button" id="legiladoresBoton"  class="btn btn-primary" style="background-color: rgb(189, 226, 221);color: #000;">Legisladores</button>
					<button type="button" id="noticiasBoton" class="btn btn-primary" style="background-color: rgb(189, 226, 221);color: #000;">Noticias</button>
					<button type="button" id="adherentesBoton" class="btn btn-primary" style="background-color: rgb(189, 226, 221);color: #000;">Adherentes</button>
                </div>
            </div>
			<div class="col-lg-12" id="lesgiladoresBotones" style="display:none;">
                <button type="button" class="btn btn-primary" style="background-color: rgb(189, 226, 221);color: #000;">Por respuestas</button>
                <button type="button" class="btn btn-primary" style="background-color: rgb(189, 226, 221);color: #000;">Por proyectos presentados</button>
                <button type="button" class="btn btn-primary" style="background-color: rgb(189, 226, 221);color: #000;">Por patrimonio</button>
            </div>
            <div id="legisladoresBox" class="classHide">
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="<?php getURL('/legislador/julio');?>">
                        <img class="img-responsive" src="<?php getURL('/lib/img/julio.jpg');?>" alt="">
                            <span><b>Julio Alberto Agosti</b></span>
                        <br><span>Frente Civico</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/orlando.jpg');?>" alt="">
                            <span><b>Orlando Arduh</b></span>
                        <br><span>Union Civica Radical</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/roberto.jpg');?>" alt="">
                            <span><b>Roberto Cesar Birri</b></span>
                        <br><span>Partido Socialista</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/ruben.jpg');?>" alt="">
                            <span><b>Ruben Alberto Borello</b></span>
                        <br><span>Frente Renovador</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/graciela.jpg');?>" alt="">
                            <span><b>Graciela Susana Brarda</b></span>
                        <br><span>Unión por Córdoba</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/luis.jpg');?>" alt="">
                            <span><b>Luis Alberto Brouwer de Koning</b></span>
                        <br><span>Union Civica Radical</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/anselmo.jpg');?>" alt="">
                            <span><b>Anselmo Emilio Bruno</b></span>
                        <br><span>Union Civica Radical</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/MariaElsa.jpg');?>" alt="">
                            <span><b>Maria Elsa Caffaratti</b></span>
                        <br><span>Union Civica Radical</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/mariaCarmen.jpg');?>" alt="">
                            <span><b>María del Carmen Ceballos</b></span>
                        <br><span>Union por Cordoba</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/maria.jpg');?>" alt="">
                            <span><b>María Amelia Chiofalo</b></span>
                        <br><span>Union por Cordoba</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb" style="opacity: 0.3;">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/juan.jpg');?>" alt="">
                            <span><b>Juan Manuel Cid</b></span>
                        <br><span>Union por Cordoba</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb" style="opacity: 0.3;">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/edgar.jpg');?>" alt="">
                            <span><b>Edgardo Santiago Clavijo</b></span>
                        <br><span>Frente Civico</span></br>
                    </a>
                </div>
                
                <div class="col-lg-3 col-md-4 col-xs-6 thumb" style="opacity: 0.3;">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/rodrigo.jpg');?>" alt="">
                            <span><b>Rodrigo Alfredo de Loredo</b></span>
                        <br><span>Union Civica Radical</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb" style="opacity: 0.3;">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/mariaAlejandra.jpg');?>" alt="">
                            <span><b>María Alejandra del Boca</b></span>
                        <br><span>Frente Civico</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb" style="opacity: 0.3;">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/carlos.jpg');?>" alt="">
                            <span><b>Carlos Alberto Felpeto</b></span>
                        <br><span>Union Civica Radical</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb" style="opacity: 0.3;">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/nadia.jpg');?>" alt="">
                            <span><b>Nadia Fernandez</b></span>
                        <br><span>Union por Cordoba</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb" style="opacity: 0.3;">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/ricardo.jpg');?>" alt="">
                            <span><b>Ricardo Oscar Fonseca</b></span>
                        <br><span>Frente Civico</span></br>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb" style="opacity: 0.3;">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php getURL('/lib/img/marisa.jpg');?>" alt="">
                            <span><b>Marisa Gamaggio Sosa</b></span>
                        <br><span>Union por Cordoba</span></br>
                    </a>
                </div>
            </div> <!-- #legisladoresBox -->
            
            <div id="propuestasBox">          
                <div class="container">
                  <div class="row">
                    <div class="col-md-12">
                        <ul class="thumbnails" id="hover-cap-4col">
                            
                            <?php 
            
                            $propuestas = getPropuestas(); 
                            foreach ($propuestas as $propuesta) {
                                ?>
                                <li class="col-md-4">
                                    <div class="thumbnail">
                                        <div class="caption">
                                             <h4><?php echo $propuesta['titulo']; ?></h4>
                                             <?php echo $propuesta['descripcion']; ?>
                                            <p><a href="#" class="btn btn-inverse" rel="tooltip" title="Preview"><i class="glyphicon glyphicon-eye-open"></i></a> 
                                                <a href="#" rel="tooltip" title="Share" class="btn btn-inverse"><i class="glyphicon glyphicon-share"></i></a>
                                            </p>
                                        </div>
                                        <?php if (!empty($propuesta['imagen'])): ?>
                                            <img src="<?php echo $propuesta['imagen']?>" alt="ALT NAME" class="img-responsive">
                                        <?php else: ?>
                                            <img src="<?php getURL('/lib/img/fondo.png');?>" alt="ALT NAME" class="img-responsive">
                                        <?php endif; ?>
                                    </div>
                                     <h4><?php echo $propuesta['titulo']; ?></h4>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            </div><!-- #propuestasBox -->
            
            <hr />
		
		<div id="adherentesBox" class="classHide">       
            <?php 
            $adherentes = getAdherentes(); 
            foreach ($adherentes as $adherente) {
                ?>
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="<?php echo $adherente['logo'];?>">
                        <img class="img-responsive" src="<?php echo $adherente['logo'];?>" alt="">
                            <span><b><?php echo $adherente['nombre'];?></b></span>
                    </a>
                </div>
                <?php
            }?>
        
		</div> <!-- #adherentesBox -->
            
        <div id="noticiasBox" class="classHide"></div><!-- #noticiasBox -->
    </div>
        
    <hr />