<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    $_SESSION['active_page'] = CONNEXION_VIEW_ROUTE;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    $email = (isset($_SESSION['email']) && isset($_GET['message']) && $_GET['message']=="success") ? $_SESSION['email'] : "";
    if(isset($_GET["email"]) && !is_null($_GET["email"]) && $email == "") $email = $_GET["email"];
    
    require $wwwDir.'/sunusalon/mail/vendor/autoload.php';
    $mail = new PHPMailer(true);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href='../styles/bootstrap-3.3.7-dist/css/bootstrap' rel='stylesheet'>
    <link href="../styles/colors" rel="stylesheet" >
    <link href="../styles/paddings" rel="stylesheet" >
    <script src = "../js/jquery-3.2.1" ></script>

    <title>Connéxion</title>
</head>

<body>

    <div class = "container" > 
            <?php include_once $wwwDir.HEAD_MENU_VIEW_ROUTE; ?> 
    </div>
    <form method="POST" action = "<?php echo CONNEXION_CONTROLLER_ROUTE?>">


        <div class = "container _margin-top" >
            <div class = "row center-block text-center " >
                <section class= "col-lg-4 col-lg-push-4 graye ">
                <div class = "_title col-lg-12">
                    <div class = "_title col-lg-10  col-lg-push-1">
                        <legend>Connexion</legend>
                    </div>
                </div>

                    <div class="form-group has-error has-feedback _error">
                        <?php 
                            if(isset($_GET["message"]) && !is_null($_GET["message"]) && $_GET["message"] != "success") {
                                if($_GET["message"]=="error_id"){
                                    echo "<h4> IDENTIFIANT OU MOT DE PASSE INCERRECT </h4>";
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
                        <input type="email" class = "form-control input-lg" name = "email" placeholder = "Email" value = "<?php echo $email?>" required = "true">
                    </div>

                    <div class = "form-group input-group" >
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class = "form-control input-lg" name = "password" placeholder = "Mot de passe"  required = "true">
                    </div>

                    <div class = "form-group row" >
                        <div class = "col-xs-6" > <a href="">Mot de passe oubié ?</a></div>
                        <div class = "col-xs-5 col-xs-offset-1" > <a href=" <?php echo INSCRIPTION_VIEW_ROUTE.'?user=client&_action=add'; ?>" >S'inscrire</a> </div>
                    </div>
                    
                    <div class = "form-group" >
                        <input type="submit" class = "btn btn-primary" value = "Se connecter" >
                    </div>

                </section>
            </div>
        </div>
    </form>
</body>

</html>