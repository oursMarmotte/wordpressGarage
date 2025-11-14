<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div class="response-div alert alert-success mb-5" id="autoOutput" style="display:none"></div>

<div class="autoReservation-message">
<p>Ce vehicule vous interesse ?</p>
<p>Rendez vous dans notre garage Caroccasion.com</p>
</div>


<button class="btn btn-primary" id="btn-auto-resa"> Demandez un rendez-vous</button>

 <div id="autoReservationForm" class="autoReservationForm" >
        <form id="autoformResa">
            <div class="mb-3">
              <label for="autoNom">Votre nom:</label>
               <input type="text" id="autoNom" name="nom" class="form-control">
            </div>
               <div class="mb-3">
              <label for="autoPrenom">Votre Prenom:</label>
               <input type="text" id="autoPrenom" name="prenom" class="form-control">
               </div>

               <div class="mb-3">
              <label for="autoEmail">Votre Email:</label>
               <input type="text" id="autoEmail" name="email" class="form-control">
               </div>

                <label for="autoMessage" class="form-label">Votre message :</label>
                <input type="text" id="autoMessage" name="message"class="form-control">


                <label for="autoTelephone" class="form-label">Votre numéro de tél:</label>
                <input type="text" id="autoTelephone" name="telephone"class="form-control">

				 <label for="autoDate" class="form-label">Date de visite souhaité:</label>
                <input type="date" id="autoDate" name="date"class="form-control">
           
            <button  id="autoSend" class="btn btn-success">Envoyer</button>
        </form>
 </div>