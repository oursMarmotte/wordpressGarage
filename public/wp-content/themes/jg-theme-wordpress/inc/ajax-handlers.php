<?php

// Fonction pour gérer la requête AJAX
function jg_handle_ajax_request(){
    check_ajax_referer('mon-script_nonce','security');
    
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    $nom = sanitize_text_field($_POST['nom'] ?? 'Inconnu');
    $prenom = sanitize_text_field($_POST['prenom'] ?? 'Inconnu');
    $email = sanitize_email($_POST['email'] ?? 'email@nonfourni');
    
    // Validation de l'email
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Email invalide'));
        return;
    }
    
    // S'assurer que la table existe
    jg_create_messages_table();
    
    // Enregistrement dans la base de données
    global $wpdb;
    $table_name = $wpdb->prefix . 'messages_clients';
    
    $inserted = $wpdb->insert(
        $table_name,
        array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'message' => $message,
            'date_envoi' => current_time('mysql'),
            'status' => 'non_lu'
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s')
    );
    
    if ($inserted === false) {
        wp_send_json_error(array(
            'message' => 'Erreur lors de l\'enregistrement',
            'error' => $wpdb->last_error
        ));
        return;
    }
    
    // Envoi de l'email à l'administrateur
    $admin_email = get_option('admin_email');
    $subject = 'Nouveau message de contact : ' . $nom . ' ' . $prenom;
    
    $email_message = "Vous avez reçu un nouveau message de contact.\n\n";
    $email_message .= "Nom : " . $nom . "\n";
    $email_message .= "Prénom : " . $prenom . "\n";
    $email_message .= "Email : " . $email . "\n\n";
    $email_message .= "Message :\n" . $message . "\n\n";
    $email_message .= "---\n";
    $email_message .= "Vous pouvez consulter tous les messages dans votre tableau de bord WordPress.";
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . $admin_email . '>',
        'Reply-To: ' . $email
    );
    
    $mail_sent = wp_mail($admin_email, $subject, $email_message, $headers);
    
    // Email de confirmation au client (optionnel)
    $client_subject = 'Confirmation de réception de votre message';
    $client_message = "Bonjour " . $prenom . " " . $nom . ",\n\n";
    $client_message .= "Nous avons bien reçu votre message et nous vous remercions de nous avoir contactés.\n";
    $client_message .= "Notre équipe vous répondra dans les plus brefs délais.\n\n";
    $client_message .= "Cordialement,\n";
    $client_message .= get_bloginfo('name');
    
    wp_mail($email, $client_subject, $client_message, array('Content-Type: text/plain; charset=UTF-8'));
    
    $response = array(
        'nom' => $nom,
        'prenom' => $prenom,
        'message' => $message,
        'email' => $email,
        'status' => 'ok',
        'mail_sent' => $mail_sent
    );
    
    wp_send_json_success($response);
}

add_action('wp_ajax_mon_script_action', 'jg_handle_ajax_request');
add_action('wp_ajax_nopriv_mon_script_action', 'jg_handle_ajax_request');

// Création de la table lors de l'activation du plugin/thème
function jg_create_messages_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'messages_clients';
    $charset_collate = $wpdb->get_charset_collate();
    
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        nom varchar(100) NOT NULL,
        prenom varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        message text NOT NULL,
        date_envoi datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
        status varchar(20) DEFAULT 'non_lu' NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// Pour un plugin : register_activation_hook(__FILE__, 'jg_create_messages_table');
// Pour functions.php : décommentez la ligne suivante
//add_action('after_setup_theme', 'jg_create_messages_table');

// Ajout d'un menu dans le dashboard WordPress
function jg_add_admin_menu() {
    add_menu_page(
        'Messages Clients',           // Titre de la page
        'Messages Clients',           // Titre du menu
        'manage_options',             // Capacité requise
        'messages-clients',           // Slug du menu
        'jg_display_messages_page',   // Fonction callback
        'dashicons-email-alt',        // Icône
        26                            // Position
    );
}
add_action('admin_menu', 'jg_add_admin_menu');

// Affichage de la page des messages dans le dashboard
function jg_display_messages_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'messages_clients';
    
    // Gestion de la suppression
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $wpdb->delete($table_name, array('id' => $id), array('%d'));
        echo '<div class="notice notice-success"><p>Message supprimé avec succès.</p></div>';
    }
    
    // Gestion du changement de statut
    if (isset($_GET['action']) && $_GET['action'] === 'mark_read' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $wpdb->update($table_name, array('status' => 'lu'), array('id' => $id), array('%s'), array('%d'));
        echo '<div class="notice notice-success"><p>Message marqué comme lu.</p></div>';
    }
    
    $messages = $wpdb->get_results("SELECT * FROM $table_name ORDER BY date_envoi DESC");
    
    ?>
    <div class="wrap">
        <h1>Messages Clients</h1>
        
        <?php if (empty($messages)): ?>
            <p>Aucun message pour le moment.</p>
        <?php else: ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $msg): ?>
                        <tr style="<?php echo $msg->status === 'non_lu' ? 'background-color: #f0f8ff;' : ''; ?>">
                            <td><?php echo esc_html($msg->id); ?></td>
                            <td><?php echo esc_html($msg->nom); ?></td>
                            <td><?php echo esc_html($msg->prenom); ?></td>
                            <td><a href="mailto:<?php echo esc_attr($msg->email); ?>"><?php echo esc_html($msg->email); ?></a></td>
                            <td><?php echo esc_html(wp_trim_words($msg->message, 15)); ?></td>
                            <td><?php echo esc_html(date('d/m/Y H:i', strtotime($msg->date_envoi))); ?></td>
                            <td>
                                <span class="<?php echo $msg->status === 'non_lu' ? 'dashicons dashicons-marker' : 'dashicons dashicons-yes'; ?>"></span>
                                <?php echo esc_html(ucfirst(str_replace('_', ' ', $msg->status))); ?>
                            </td>
                            <td>
                                <a href="?page=messages-clients&action=view&id=<?php echo $msg->id; ?>" class="button button-small">Voir</a>
                                <?php if ($msg->status === 'non_lu'): ?>
                                    <a href="?page=messages-clients&action=mark_read&id=<?php echo $msg->id; ?>" class="button button-small">Marquer lu</a>
                                <?php endif; ?>
                                <a href="?page=messages-clients&action=delete&id=<?php echo $msg->id; ?>" class="button button-small button-link-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?');">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    
    <?php
    // Modal pour afficher le message complet
    if (isset($_GET['action']) && $_GET['action'] === 'view' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $message = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id));
        
        if ($message) {
            // Marquer comme lu automatiquement
            $wpdb->update($table_name, array('status' => 'lu'), array('id' => $id), array('%s'), array('%d'));
            ?>
            <div style="margin-top: 20px; padding: 20px; background: white; border: 1px solid #ccc;">
                <h2>Détails du message #<?php echo $message->id; ?></h2>
                <p><strong>De :</strong> <?php echo esc_html($message->prenom . ' ' . $message->nom); ?></p>
                <p><strong>Email :</strong> <a href="mailto:<?php echo esc_attr($message->email); ?>"><?php echo esc_html($message->email); ?></a></p>
                <p><strong>Date :</strong> <?php echo esc_html(date('d/m/Y à H:i', strtotime($message->date_envoi))); ?></p>
                <hr>
                <p><strong>Message :</strong></p>
                <p><?php echo nl2br(esc_html($message->message)); ?></p>
                <a href="?page=messages-clients" class="button">Retour à la liste</a>
            </div>
            <?php
        }
    }
}

// Badge de notification pour les nouveaux messages
function jg_add_notification_badge() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'messages_clients';
    $count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE status = 'non_lu'");
    
    if ($count > 0) {
        echo '<style>
            #adminmenu .wp-menu-name .awaiting-mod {
                background-color: #d63638;
                color: #fff;
                padding: 2px 6px;
                border-radius: 10px;
                font-size: 11px;
                margin-left: 5px;
            }
        </style>';
        
        echo '<script>
            jQuery(document).ready(function($) {
                $("#adminmenu a[href=\'admin.php?page=messages-clients\'] .wp-menu-name").append(\' <span class="awaiting-mod">' . $count . '</span>\');
            });
        </script>';
    }
}
add_action('admin_head', 'jg_add_notification_badge');

?>