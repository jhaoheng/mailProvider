<?php  
return new \Phalcon\Config(array(
    // use `sending-confirmation-emails-phalcon-swift`
    'company' => 'default', // for view folder
    'mail' => array(
        'smtp' => array(
                'server'    => 'smtp.gmail.com',
                'port'      => 465,
                'security'  => 'ssl',
                'username'  => 'your@gmail.com',
                'password'  => '',
        )
    ),
    'mailFrom' => array(
        'Name' => 'Email Bot',
        'Email' => 'your@gmail.com' // the sam smtp->username
    ),
    // mail_type => title
    'subject' => array(
        'default' => 'Mail from mail provider',
    ),
));
?>