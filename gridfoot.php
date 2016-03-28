<?php 
global $Pagina;
?>
<br><br>

<!-- Fim da Grid -->
<p>
    <a href="?page=<?= $Pagina - 1 ?>">Página Anterior</a>
     - <?php echo $Pagina ?> - 
    <a href="?page=<?= $Pagina + 1 ?>">Próxima Página</a>
</p>
</fieldset>

<!-- Fim Div wrapper -->
</div>
<div class="row">
    <div class="col-sm-12" style="margin-top: 50px"></div>
    <div class="footer">
        <div class="col-md-6 text-left">
            <small>powered by ASIX6</small>
        </div>
        <div class="col-md-6 text-right">
            <small>© 2016</small>
        </div>
    </div>
</div>
</div>