<?php 
    if(!isset($_SESSION)) session_start();
    $wwwDir = $_SERVER['DOCUMENT_ROOT'];
    require_once $wwwDir."/sunusalon/routers/route.php";
    //require_once $wwwDir.AJOUT_EMPLOYE_MODEL_ROUTE;
    require_once $wwwDir.USERS_MODEL_ROUTE;


function loadEmployez(){
    $result = load_employe_from_DB();
    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";
    
?>
<link href="../styles/paddings.css" rel="stylesheet" />
<script src = "../js/jquery-3.2.1" ></script>


<div class="panel panel-primary">
  <table class="table table-condensed">
    <div class="panel-heading"> 
      <h3 class="panel-title">
        Liste des employés 
        <?php 
          echo " <a href='".AJOUT_EMPLOYE_VIEW_ROUTE."?user=employe&_action=add'>  <div class = 'edit btn btn-primary  glyphicon glyphicon-plus '> </div>  </a> "
        ?>
      </h3>
    </div>
    <thead>
      <tr>
        <th width='25%' align='center'>PRENOM</th>
        <th min-width='25%' align='center'>NOM</th>
        <th width='15%' align='center'>TELEPHONE</th>
        <th width='30%' align='center'>ADESSE</th>
        <th  max-width='1%' align='center'>EMAIL</th>
      </tr>
    </thead>
    <tbody>
    <script>
      employe = [];
    </script>
    <?php

        foreach($result as $cle=>$value){
    ?>
      <script>
        employe[ "<?php echo $cle ?>" ] = {
          prenom: " <?php echo $value['prenom'] ?> " ,
          nom: "<?php echo $value['nom'] ?>" ,
          tel: "<?php echo $value['tel'] ?>" ,
          adresse:"<?php echo $value['adresse'] ?>" ,
          email: "<?php echo $value['email'] ?>"
        };
      </script>
      <?php
            echo 
            "<tr id = '".$cle."' >
                 <td width='25%' align='center' id = 'prenom_".$cle."' >".$value['prenom']."</td>".
                "<td width='15%' align='center' id = 'nom_".$cle."' >".$value['nom']."</td>".
                "<td width='15%' align='center' id = 'tel_".$cle."' >".$value['tel']."</td>".
                "<td width='30%' align='center' id = 'adresse_".$cle."' >".$value['adresse']."</td>".
                "<td width='15%' align='center' id = 'email_".$cle."' >".$value['email']."</td>".
                "<td width='15%' align='center'>   <a href='".AJOUT_EMPLOYE_VIEW_ROUTE."?email=".$value['email']."&user=employe&_action=edit'>  <div id = 'edit_".$cle."' class = 'edit btn btn-default  glyphicon glyphicon-edit edite'> </div>  </a> </td>".
                "<td width='15%' align='center'>   <div id = 'remove_".$cle."' class = 'remove btn btn-danger  glyphicon glyphicon-remove edite'> </div></td>".
            "</tr>";

        }

    ?>
    </tbody>
  </table>
</div>

<script>

  $(document).ready(function(){
      $(".remove").on("click", function(){
          //alert($(this).attr('id'));
          remove_id = $(this).attr('id');
          remove_id = remove_id.split("remove_")[1];
          //alert(remove_id);
          console.log(employe[remove_id]);
          if(confirm("Voulez-vous vraiment supprimer cet employé ?")){
            console.log("supprimer");
            //$this.attr('data-email');
            //url = <?php echo DELETE_MODEL_ROUTE;?>;
            $.post('/sunusalon/models/delete.model.php', {
              email: employe[remove_id]['email'],
              user: 'employe',
              _action: 'delete'
            }, function(data, status){
              //request_result = JSON.stringify(status);
              console.log(status);
              $("#"+remove_id).remove();
            });
            // <?php 
            //   $email_to_delete = "employe[remove_id]['email']" ; 
            //   delete_employe_in_DB($email_to_delete);
            //   echo "console.log(".$email_to_delete.");";
            //   // if($succes){
            //   //   //echo "console.log(".$email_to_delete.");";
            //   //   loadEmployez();
            //   // }
            // ?>
            
          }
      });




      // $(".edit").on("click", function(){

      //   edit_id = $(this).attr('id');
      //   edit_id = edit_id.split("edit_")[1];
      //   console.log(employe[edit_id]);
      //   if(confirm("Voulez-vous vraiment modifier les informations de cet employé ?")){
      //     console.log("modifier");

      //     // $.post('/sunusalon/views/ajout_employe.view.php', {
      //     //   prenom: employe[edit_id]['prenom'],
      //     //   nom: employe[edit_id]['nom'],
      //     //   adresse: employe[edit_id]['adresse'],
      //     //   tel: employe[edit_id]['tel'],
      //     //   email: employe[edit_id]['email'],
      //     //   password: employe[edit_id]['password'], 
      //     //   user: 'employe', 
      //     //   _action: 'edite'
      //     //   }, function(data, status){
      //     //   console.log(status);
      //     //   window.location = "/sunusalon/views/ajout_employe.view.php";
      //     // });




      //     $.ajax({
      //       type: "POST",
      //       url: "/sunusalon/views/ajout_employe.view.php",
      //       data: {
      //       prenom: employe[edit_id]['prenom'],
      //       nom: employe[edit_id]['nom'],
      //       adresse: employe[edit_id]['adresse'],
      //       tel: employe[edit_id]['tel'],
      //       email: employe[edit_id]['email'],
      //       password: employe[edit_id]['password'], 
      //       user: 'employe', 
      //       _action: 'edite'
      //       },
      //       success: function (response) {
      //         window.location = "/sunusalon/views/ajout_employe.view.php";
      //       },
      //       failure: function (response) {
      //           alert(response.d);
      //       }
      //   });

          
      //   }


      // });



  });

</script>

<?php

}