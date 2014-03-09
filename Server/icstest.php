<?php

function isiOS7($user_agent=NULL) {
    if(!isset($user_agent)) {
        $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    }
    return (strpos($user_agent, 'OS 7') !== FALSE);
}

# Output file contents - simple version
if(!isIphone() || isiOS7()) {
    # Send correct headers      
    header("Content-type: text/x-vcard; charset=utf-8"); 
                // Alternatively: application/octet-stream
                // Depending on the desired browser behaviour
                // Be sure to test thoroughly cross-browser

    header("Content-Disposition: attachment; filename=\"iphonecontact.vcf\";");
    # Output file contents 
    echo file_get_contents("iphonecontact.vcf");
    exit();
}

?>