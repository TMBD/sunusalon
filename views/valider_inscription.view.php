<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    $_SESSION['active_page'] = CONNEXION_VIEW_ROUTE;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href='../styles/bootstrap-3.3.7-dist/css/bootstrap' rel='stylesheet'>
    <link href="../styles/colors" rel="stylesheet" >
    <link href="../styles/paddings" rel="stylesheet" >
    <script src = "../js/jquery-3.2.1" ></script>

    <title>Validation</title>
</head>

<body>

    <form method="POST" action = "<?php echo VALIDER_INSCRIPTION_CONTROLLER_ROUTE?>">
        <div class = "container _margin-top" >
            <div class = "row center-block text-center " >
                <section class= "col-lg-4 col-lg-push-4 graye ">
                    <div class = "_title col-lg-12">
                        <div class = "_title col-lg-10  col-lg-push-1">
                            <legend>Validation</legend>
                        </div>
                    </div>

                    <div class="form-group has-error has-feedback _error">
                        <?php 
                            if(isset($_GET["message"]) && !is_null($_GET["message"]) && $_GET["message"] != "success") {
                                if($_GET["message"]=="error_id"){
                                    echo "<h4> EMAIL OU CODE INCORRECT </h4>";
                                }
                                else if($_GET["message"]=="error_isset" || $_GET["message"]=="error_null"){
                                    echo "<h4> VEUILLEZ RENSEIGNER CORRECTEMENT LES CHAMPS </h4>";
                                }
                                ?>
                                    <script> 
                                        $("._error").slideDown("slow").delay(5000).hide("slow");
                                    </script>
                                <?php
                            }

                        ?>
                        <span class = "glyphicon glyphicon-alert" ></span>
                    </div>

                    <div class = "form-group input-group" >
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="email" class = "form-control input-lg" name = "email" placeholder = "Email" required = "true">
                    </div>
                    <div class = "form-group input-group" >
                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                        <input type="text" class = "form-control input-lg" name = "code" placeholder = "Code" required = "true">
                    </div>
                    
                    <div class = "form-group" >
                        <input type="submit" class = "btn btn-primary" value = "Valider" >
                    </div>

                </section>
            </div>
        </div>
    </form>
</body>

</html>