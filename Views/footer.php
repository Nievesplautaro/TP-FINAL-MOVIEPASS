<footer class="footer">
    <div class="sociales">
        <ul>
            <li><a href="https://www.facebook.com/" target="_blank"><img src="<?php echo IMG_PATH ?>facebook.png" alt=""></a></li>
            <li><a href="https://instagram.com/" target="_blank"><img src="<?php echo IMG_PATH ?>instagram.png" alt=""></a></li>
            <li><a href="https://open.spotify.com/user/" target="_blank"><img src="<?php echo IMG_PATH ?>spotify.png" alt=""></a></li>
            <li><a href="https://www.youtube.com/user/" target="_blank"><img src="<?php echo IMG_PATH ?>youtube.png" alt=""></a></li>
            <li><a href="https://twitter.com/" target="_blank"><img src="<?php echo IMG_PATH ?>twitter.png" alt=""></a></li>            
            <li><a href="https://www.google.com//" target="_blank"><img src="<?php echo IMG_PATH ?>google-plus.png" alt=""></a></li>            
        </ul>        
    </div>
    <div class="texto">                
            AV. DORREGO 281, B7600 - BUENOS AIRES - ARGENTINA - TEL. (+555) 123 4567 - 0800 9999<br> 
            <a href="/privacidad">Políticas de Privacidad</a> | 
            <a href="/terminos">Términos y Condiciones</a> | 
            <a href="/servicios/contacto">Contacto</a><br/>
            COPYRIGHT © 2020 MOVIE-PASS
    </div>
    <div class="texto sello">
        <a target="_blank" href="#">  
            <img src="<?php echo IMG_PATH ?>MoviePass_b.png" alt="BUENARDO">                 
            B.T.P.V. DEVELOPENT - Web Design Buenardo
        </a>
        <?php
        if(!isset($_SESSION["loggedUser"])){
        ?>
        <a href="<?php echo FRONT_ROOT ?>Admin/ShowAdminView" class="admin">
            <div class="">
                LOG AS ADMIN
            </div>
        </a>
        <?php
        }
        ?>
    </div> 
</footer>
</body>
</html>
