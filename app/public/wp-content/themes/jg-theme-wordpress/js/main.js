

jQuery(document).ready( function($) {


//chargement du formulaire
 $('#fgpSubmit').click(function(){
     $("#fgpSubmit").html('remplisser leformulaire ci-dessous').css('background-color','green');
    $('#fgpFormContainer').slideToggle("fast");
 });



//traitement formulaire
    $("#fgpSend").click(function(e){
        e.preventDefault();
        alert("button clicked");
       

           let fgpNom = $("#fgpNom").val();
           let fgpPrenom=  $("#fgpPrenom").val();
           let fgpEmail = $("#fgpEmail").val();
           let fgpMessage =$("#fgpMessage").val();
           let fgpTel =$("#fgpTelephone").val();
alert(fgpNom);
    




     $.ajax({
        url:monscriptAjax.ajax_url,
        type:'POST',
        data:{
            action:'mon_script_action',
            security:monscriptAjax.nonce,
            message:fgpMessage,
            nom:fgpNom,
            email:fgpEmail,
            prenom:fgpPrenom,
            telephone:fgpTel,
        },
        success:function(response){
            if (response.success) {
                let data = response.data;
                $('#fgpFormContainer').slideUp("fast");
                $('#fgpOutput').html("merci monsieur:<b>"+data.nom+"</b>("+data.email+")<br>Votre message"+data.message+"<br>votre demande sera traité dans lesplus bref délais");
$('#fgpOutput').slideToggle('fast');

$("#fgpSubmit").html("Demander un devis").css('background-color','blue');
setTimeout(function(){
$('#fgpOutput').slideUp('fast');
},6000)
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