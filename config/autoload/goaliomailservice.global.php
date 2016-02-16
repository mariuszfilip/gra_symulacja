<?php
/**
 * GoalioMailService Configuration
 *
 * If you have a ./config/autoload/ directory set up for your project, you can
 * drop this config file in it and change the values as you wish.
 */
$settings = array(
    /**
     * Transport Class
     *
     * Name of Zend Transport Class to use
     */
    'type' => 'Zend\Mail\Transport\Smtp',

    'transport_class' => 'Zend\Mail\Transport\Smtp',

    'options_class' => 'Zend\Mail\Transport\SmtpOptions',

    'options' => array(
        'host' => 'smtp.gmail.com',
        'connection_class' => 'login',
        'connection_config' => array(
            'ssl' => 'tls',
            'username' => 'test@gmail.com',
            'password' => 'test'
        ),
        'port' => 587
    )
);


/**
 * You do not need to edit below this line
 */
return array(
    'goaliomailservice' => $settings,
);
