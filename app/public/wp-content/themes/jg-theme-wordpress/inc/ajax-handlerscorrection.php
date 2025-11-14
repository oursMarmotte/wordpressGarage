// LIGNE 79 - Corriger la table SQL
$sql= "CREATE TABLE IF NOT EXISTS $table_name(
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    nom varchar(100) NOT NULL,
    prenom varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    telephone varchar(100) NOT NULL,
    date_rdv datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    message text NOT NULL,
    date_envoi datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    status varchar(20) DEFAULT 'non_lu' NOT NULL,
    PRIMARY KEY (id)
)$charset_collate;";

// LIGNE 107 - Corriger delete
if(isset($_GET['action']) && $_GET['action']==='delete' && isset($_GET['id'])){
    $id = intval($_GET['id']);
    $wpdb->delete($table_name, array('id'=>$id), array('%d'));
    echo '<div class="notice notice-success"><p>Message supprimé avec succès.</p></div>';
}

// LIGNE 112 - Ajouter $id manquant
if(isset($_GET['action']) && $_GET['action']=== 'mark_read' && isset($_GET['id'])) {
    $id = intval($_GET['id']); // ← AJOUT
    $wpdb->update($table_name, array('status' =>'lu'), array('id'=>$id), array('%s'), array('%d'));
    echo '<div class="notice notice-success"><p>Message marqué comme lu.</p></div>';
}

// LIGNES 149, 152, 154, 167 - Corriger le slug de page
<a href="?page=message-clients-auto&action=view&id=<?php echo $msg->id; ?>
<a href="?page=message-clients-auto&action=mark_read&id=<?php echo $msg->id; ?>
<a href="?page=message-clients-auto&action=delete&id=<?php echo $msg->id; ?>
<a href="?page=message-clients-auto" class="button">Retour à la liste</a>