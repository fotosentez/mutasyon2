<?php
$profile = $dbase->get('*', 'superuser INNER JOIN adminStatus ON superuser_status = as_id', 'superuser_email = "'.$_SESSION ["email"].'" ');
$id = $dbase->getRow('superuser', 'superuser_email = "'.$_SESSION ["email"].'" ', 'superuser_id');

//Get invoices which added from this user
$date = date("Y");

//Sell acts
$extra = '
strftime("%Y", invoice_date) as Year,
strftime("%m", invoice_date) as Mouth,
strftime("%d", invoice_date) as Day
';
$invoices = $dbase->get('*, '.$extra.' ', 'invoice ', ' invoice_superuser_id = '.$id.' AND Year = "'.$date.'" ORDER BY invoice_date DESC ');

//Buy acts
$bextra = '
strftime("%Y", bi_date) as Year,
strftime("%m", bi_date) as Mouth,
strftime("%d", bi_date) as Day
';
$binvoices = $dbase->get('*, '.$bextra.' ', 'buyInvoice ', ' bi_superuser_id = '.$id.' AND Year = "'.$date.'" ');

//Smarty veriables
$smarty->assign ( array (
    "profile" => $profile,
    "invoices" => $invoices,
    "binvoices" => $binvoices,
));
Page::create("profile/profile", "profile", "", "profile");