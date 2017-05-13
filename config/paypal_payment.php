<?php
return array(
    // set your paypal credential
    'client_id' => 'AbWfXobLubNgCTgRCqpG8euEnj061SMcYhPYxgfP0OXuob0ri1x5dhOZOdRrcIeSxxCATU2a7srTpTik',
    'secret' => 'EJqGpnpEvSvkdk6Tc6N0j3zYB6P8rBv3Oi5XWUEN7HaxyxjOVo-ZYEosMgIqva1ZhYlqPOxGuw1RxgSb',
    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);