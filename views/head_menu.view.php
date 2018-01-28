
<div class = "navbar navbar-inverse navbar-fixed-top" >
    <div class = "container-fluid" >
        <div class = "navbar-header" >
            <a class = "navbar-brand" href="#">Suñu Salon</a>                    
        </div>
        <ul class = "nav navbar-nav" >
            <li class = <?php echo $_SESSION['active_page'] == ACCUEIL_VIEW_ROUTE ? 'active' : '' ?>  ><a href="<?php echo INDEX_ROUTE?>">Accueil</a></li>
            <li class = <?php echo $_SESSION['active_page'] == CONNEXION_VIEW_ROUTE ? 'active' : '' ?> ><a href="<?php echo CONNEXION_VIEW_ROUTE?>">Connnexion</a></li>
            
            <?php if(isset($_SESSION['user'])&& $_SESSION['user']=="gerant"){ ?>
                <li ><a href="#">Rendez-vous</a></li>
                <li class = <?php echo $_SESSION['active_page'] == EMPLOYES_VIEW_ROUTE ? 'active' : '' ?> ><a href="<?php echo EMPLOYES_VIEW_ROUTE?>">Employes</a></li>
                <li class = <?php echo $_SESSION['active_page'] == CLIENTS_VIEW_ROUTE ? 'active' : '' ?> ><a href="<?php echo CLIENTS_VIEW_ROUTE?>">Clients</a></li>
            <?php } ?>
        </ul>

        <?php
            if(isset($_SESSION['prenom'])&& !is_null($_SESSION['prenom'])){ ?>
            <form class="navbar-form navbar-right inline-form" method="GET" action = " <?php echo CONNEXION_VIEW_ROUTE ?>" >
                <div class="form-group">
                    <input type="hidden" name = "message" value = "success" >
                    <button type="submit" class="btn btn-default btn-sm"> <?php echo $_SESSION['prenom']." ".$_SESSION['nom']?> <span class="glyphicon glyphicon-user"></span> </button>
                </div>
            </form>
        <?php } ?>
        
        <form class="navbar-form navbar-right inline-form">
            <div class="form-group">
                <input type="search" class="input-sm form-control" placeholder="Recherche">
                <button type="submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open"></span> Chercher</button>
            </div>
        </form>

    </div>
</div>