
<?php
// Domain
$domain = "danstestingdomain.io";
$o365 = "Yes";

// Root A record
$a_record_host = "";
$a_record_ip = "185.160.167.27";

// Subdomain A Records
$a_record_sub_1_dom = "";
$a_record_sub_1_ip = "";

$a_record_sub_2_dom = "";
$a_record_sub_2_ip = "";

// MX Record
$mx_record = "mail.example.com";

// www cname
$cname_www = "www";

// ftp cname
$cname_ftp ="ftp";

// SPF record
$spf_record = "spf=txt";

// TXT records
$txt1 = "test";

// O365 Records
$msoid_cname = "clientconfig.microsoftonline-p.net";
$enterprisereg = "enterpriseregistration.windows.net";
$enterpriseenrol = "enterpriseenrollment.manage.microsoft.com";
$lyncdiscover = "webdir.online.lync.com";
$sip = "sipdir.online.lync.com";

// Nameservers - DO NOT TOUCH
$ns1_ns = "ns1.wessex.cloud";
$ns2_ns = "ns2.wessex.cloud";
$ns3_ns = "ns3.wessex.cloud";


### Include Extras ###
include 'assets/colours.php';
$colors = new Colors();


//
// This is for debugging
//
echo $colors->getColoredString("
#################################################

        Domain is $domain

        A     $domain $a_record_ip
        MX    $domain $mx_record
        CNAME $cname_www $domain
        TXT   $domain $txt1
        NS    $domain $ns1_ns
        NS    $domain $ns2_ns
        NS    $domain $ns3_ns

#################################################", "cyan") . "\n";



$command_del_all = "plesk bin dns --del-all $domain";
$add_a_record_1 = "plesk bin dns -a $domain -a \"\" -ip $a_record_ip";
$add_cname_www_record = "plesk bin dns --add $domain -cname $cname_www -canonical $domain";
$add_mx_record = "plesk bin dns -a $domain -mx \"\" -mailexchanger $mx_record -priority 0";
$add_txt_record ="plesk bin dns -a $domain -txt \"$txt1\"";
$add_ns1 = "plesk bin dns -a $domain -ns \"\" -nameserver $ns1_ns";
$add_ns2 = "plesk bin dns -a $domain -ns \"\" -nameserver $ns2_ns";
$add_ns3 = "plesk bin dns -a $domain -ns \"\" -nameserver $ns3_ns";

// o365 records
$add_autodiscover = "plesk bin dns --add $domain -cname autodiscover -canonical autodiscover.outlook.com";
$add_sip = "plesk bin dns --add $domain -cname sip -canonical sipdir.online.lync.com";

echo $colors->getColoredString("\n\nCommands:", "yellow", "black") . "\n";
echo $colors->getColoredString("Clear existing records", "red") . "\n";
//$command_del_all
 echo shell_exec($command_del_all);


// Only add A record if record has value
if(!($a_record_ip == NULL)) {
echo shell_exec($add_a_record_1);
echo $colors->getColoredString("Added A record", "green") . "\n";
}

// Only add www CNAME if record has value
if(!($cname_www == NULL)) {
echo shell_exec($add_cname_www_record);
echo $colors->getColoredString("Added www CNAME record", "green") . "\n";
}

// Only add MX record if record has value
if(!($mx_record == NULL)) {
echo shell_exec($add_mx_record);
echo $colors->getColoredString("Added MX record", "green") . "\n";
}

// Only add txt record if record has value
if(!($txt1 == NULL)) {
echo shell_exec($add_txt_record);
echo $colors->getColoredString("Added TXT record", "green") . "\n";
}

// Only add O365 records if yes
if($o365 == "Yes") {
echo shell_exec($add_autodiscover);
echo shell_exec($add_sip);
echo $colors->getColoredString("Added Office 365 records", "green") . "\n";
}

// Add Nameservers
echo shell_exec($add_ns1);
echo shell_exec($add_ns2);
echo shell_exec($add_ns3);
echo $colors->getColoredString("Added Nameserver records", "green") . "\n";
echo "\n\n";
// echo shell_exec($command2);






// Continue or Die

//echo "Do you want to update all DNS records for $domain now?  Type 'yes' to continue: ";
//$handle = fopen ("php://stdin","r");
//$line = fgets($handle);
//if(trim($line) != 'yes'){
//        echo "Fuck dat! ABORTING!\n";
//        exit;
//}
//fclose($handle);
//echo"\n";
//echo"Thank you, continuing.\n";
//echo "All Done M80\n";

// Finish





// End
?>
