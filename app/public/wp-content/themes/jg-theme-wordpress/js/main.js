

jQuery(document).ready( function($) {


//chargement du formulaire
 $('#fgpSubmit').click(function(){
     $("#fgpSubmit").html('Veuillez remplir le formulaire ci-dessous').css({'background-color':'green','color':'white'});
    $('#fgpFormContainer').slideToggle("fast");
    $('#img-devis').slideUp("fast");

 

 });

 $('#btn-auto-resa').click(function(){
$('#btn-auto-resa').html('Veuillez remplir le formulaire ci-dessus').css('background-color','green');
$('#autoReservationForm').slideToggle("fast");
 });



//traitement formulaire
    $("#fgpSend").click(function(e){
        e.preventDefault();
        
       

           let fgpNom = $("#fgpNom").val();
           let fgpPrenom=  $("#fgpPrenom").val();
           let fgpEmail = $("#fgpEmail").val();
           let fgpMessage =$("#fgpMessage").val();
           let fgpTel =$("#fgpTelephone").val();

    




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
                $('#fgpOutput').html("Merci monsieur:<b>"+data.nom+"</b>("+data.email+")<br<br>votre demande est enregistré sous la référence:<strong>"+data.message+"</strong><br><br>Votre demande sera traité dans les plus bref délais");
$('#fgpOutput').slideToggle('fast');

$("#fgpSubmit").html("Demander un devis").css('background-color','blue');
setTimeout(function(){
$('#fgpOutput').slideUp('fast');

         $('#img-devis').slideToggle("fast");
    
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


$("#nousTrouver").click(function(){
    $("#nousTrouver").css({'background-color':'black','color':'white'});
    $("#fgpNousTrouver").slideToggle("fast");

})

});