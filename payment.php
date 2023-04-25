<?php

    /*Command line : 
        composer init
        composer require fedapay/fedapay-php
    */
    require_once 'vendor/autoload.php';
  
    \FedaPay\FedaPay::setApiKey("sk_live_V6YJP-TV1icq1Uc8OemWli0e");

    \FedaPay\FedaPay::setEnvironment('live'); //ou setEnvironment('live');

    //$montant=$_GET['montant'];
    /* Créer la transaction */
    $transaction = \FedaPay\Transaction::create(array(
    "description" => "Transaction for john.doe@example.com",
    "amount" => 500,
    "currency" => ["iso" => "XOF"],
    "callback_url" => "https://rntp.fr",
    "customer" => [
        "firstname" => "TOGNON",
        "lastname" => "Koffi",
        "email" => "tognonange.koffi@gmail.com",
        "phone_number" => [
            "number" => "+22957887411",
            "country" => "bj"
        ]
    ]
        ));
/* Générer le token et le lien de paiement de la transaction */
    $token=$transaction->generateToken();
    echo "$token->url";
/* fin */

/* afficher les données liées à la transaction*/
    $id_transation=$transaction->id;
    echo "\n\nID DE LA TRANSACTION : $transaction->id";
    echo "\n\nDATE DE LA TRANSACTION : $transaction->created_at";
/* fin */

    $transaction = \FedaPay\Transaction::retrieve($id_transation);
    if ($transaction->status == "approved") {
        echo "\n\nPaiement effectué";
    }elseif($transaction->status == "canceled"){
        echo "\n\nPaiement annulé";
    }else{
        echo "\n\nPaiement en attente";
    }
?>

