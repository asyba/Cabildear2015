<div class="container">
    <form action="<?php echo getUrl('/registro')?>" method="post"> 
        <p><label>Nombre de usuario <input type="text" name="nombre" /> </label></p>
        <p><label>Email <input type="email" name="email" /> </label></p>
        <p><label>Password <input type="password" name="password" /> </label></p>
        <p><label>Repetir Password <input type="password" name="password2" /> </label></p>
        <p><input type="submit" /></p>
    </form>