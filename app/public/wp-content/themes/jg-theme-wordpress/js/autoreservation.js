//traitement formulaire
    jQuery(document).ready(function($){
$("#autoSend").click(function(e){
        e.preventDefault();
       
       

           let fgpNom = $("#autoNom").val();

          
           let fgpDate = $("#autoDate").val();
           
           let fgpPrenom=  $("#autoPrenom").val();
           let fgpEmail = $("#autoEmail").val();
           let fgpMessage =$("#autoMessage").val();
           let fgpTel =$("#autoTelephone").val();

    




     $.ajax({
        url:autoreservationAjax.ajax_url,
        type:'POST',
        data:{
            action:'auto_reservation_action',
            security:autoreservationAjax.nonce,
            message:fgpMessage,
            nom:fgpNom,
            email:fgpEmail,
            prenom:fgpPrenom,
            telephone:fgpTel,
            date:fgpDate,
        },
        success:function(response){
            if (response.success) {
                let data = response.data;
                $('#autoReservationForm').slideUp("fast");
                $('#autoOutput').html("Merci monsieur:<b>"+data.nom+"</b>("+data.email+")<br<br>votre demande est enregistré et sera traité dans les plus bref délais");
$('#autoOutput').slideToggle('fast');

$("#btn-auto-resa").html("Demander un rendez-vous").css('background-color','blue');
setTimeout(function(){
$('#autoOutput').slideUp('fast');

       
    
},8000)
}else{
    alert("erreur coté serveur");
   }
 },
        error:function(error){
console.log("Erreur AJAX",error);

        }
    });
    });


    });

