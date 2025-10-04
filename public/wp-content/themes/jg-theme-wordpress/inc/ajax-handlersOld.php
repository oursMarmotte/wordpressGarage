<?php

function jg_handle_ajax_request(){
    check_ajax_referer('mon-script_nonce','security');
    $message = sanitize_text_field($_POST['message']?? '');
    $nom= sanitize_text_field($_POST['nom']?? 'Inconnu');
     $prenom= sanitize_text_field($_POST['prenom']?? 'Inconnu');
    $email = sanitize_text_field($_POST['email']?? 'email@nonfourni');
    
    $response= array(
        'nom'=>$nom,
        'prenom'=>$prenom,
        'message'=>$message,
        'email'=>$email,
        'status'=>'ok'
    );

    wp_send_json_success($response);
    
}

add_action('wp_ajax_mon_script_action','jg_handle_ajax_request');

add_action('wp_ajax_nopriv_mon_script_action','jg_handle_ajax_request');


