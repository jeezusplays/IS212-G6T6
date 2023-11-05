<?php

return [
    /**
     * Default route to see the UML diagram.
     */
    'route' => '/uml',
    
    /**
     * You can turn on or off the indexing of specific types
     * of classes. By default, LTU processes only controllers 
     * and models.
     */
    'casts'         => false,
    'channels'      => false,
    'commands'      => false,
    'components'    => false,
    'controllers'   => true,
    'events'        => false,
    'exceptions'    => false,
    'jobs'          => false,
    'listeners'     => false,
    'mails'         => false,
    'middlewares'   => false,
    'models'        => true,
    'notifications' => false,
    'observers'     => false,
    'policies'      => false,
    'providers'     => false,
    'requests'      => true,
    'resources'     => false,
    'rules'         => false,

    /**
     * You can define specific nomnoml styling.
     * For more information: https://github.com/skanaar/nomnoml
     */

    'style' => [
        // Background color of the UML diagram
        'background' => '#FFFFFF',
    
        // Color of lines and borders
        'stroke' => '#333333',
    
        // Size of arrowheads
        'arrowSize' => 1,
    
        // Curvature of edges
        'bendSize' => 0.2,
    
        // Direction of the diagram (you can use 'right' or 'down')
        'direction' => 'down',
    
        // Spacing between diagram elements
        'gutter' => 10,
    
        // Margin for edges
        'edgeMargin' => 5,
    
        // Attraction force between diagram elements
        'gravity' => 1,
    
        // Style of edges (e.g., 'rounded', 'sharp', 'smooth')
        'edges' => 'rounded',
    
        // Fill color of shapes
        'fill' => '#EFEFEF',
    
        // Display fill color in arrowheads
        'fillArrows' => true,
    
        // Font family for text
        'font' => 'Arial',
    
        // Font size for text
        'fontSize' => 14,
    
        // Line spacing
        'leading' => 1.5,
    
        // Line width for borders
        'lineWidth' => 2,
    
        // Padding around shapes
        'padding' => 10,
    
        // Spacing between diagram elements
        'spacing' => 50,
    
        // Title text to be displayed on the diagram
        'title' => 'Laravel UML Diagram',
    
        // Zoom level for the diagram
        'zoom' => 1,
    
        // Type of acyclic layout
        'acyclicer' => 'greedy',
    
        // Method for ranking elements
        'ranker' => 'network-simplex',
    ],
    

    /**
     * Specific files can be excluded if need be.
     * By default, all default Laravel classes are ignored.
     */
    'excludeFiles' => [
        'Http/Kernel.php',

        'Console/Kernel.php',
        
        'Exceptions/Handler.php',
        
        'Http/Middleware/Authenticate.php',
        'Http/Middleware/EncryptCookies.php',
        'Http/Middleware/PreventRequestsDuringMaintenance.php',
        'Http/Middleware/RedirectIfAuthenticated.php',
        'Http/Middleware/TrimStrings.php',
        'Http/Middleware/TrustHosts.php',
        'Http/Middleware/TrustProxies.php',
        'Http/Middleware/VerifyCsrfToken.php',

        'Http/Controllers/Controller.php',
        'Http/Controllers/Auth/ConfirmPasswordController.php',
        'Http/Controllers/Auth/ForgotPasswordController.php',
        'Http/Controllers/Auth/LoginController.php',
        'Http/Controllers/Auth/RegisterController.php',
        'Http/Controllers/Auth/ResetPasswordController.php',
        'Http/Controllers/Auth/VerificationController.php',
        
        'Http/Controllers/HomeController.php',
        'Http/Controllers/testController.php',

        'Providers/AppServiceProvider.php',
        'Providers/AuthServiceProvider.php',
        'Providers/BroadcastServiceProvider.php',
        'Providers/EventServiceProvider.php',
        'Providers/RouteServiceProvider.php',
    ],

    /**
     * In case you changed any of the default directories
     * for different classes, please amend below.
     */
    'directories' => [
        'casts'         => 'Casts/',
        'channels'      => 'Broadcasting/',
        'commands'      => 'Console/Commands/',
        'components'    => 'View/Components/',
        'controllers'   => 'Http/Controllers/',
        'events'        => 'Events/',
        'exceptions'    => 'Exceptions/',
        'jobs'          => 'Jobs/',
        'listeners'     => 'Listeners/',
        'mails'         => 'Mail/',
        'middlewares'   => 'Http/Middleware/',
        'models'        => 'Models/',
        'notifications' => 'Notifications/',
        'observers'     => 'Observers/',
        'policies'      => 'Policies/',
        'providers'     => 'Providers/',
        'requests'      => 'Http/Requests/',
        'resources'     => 'Http/Resources/',
        'rules'         => 'Rules/',
    ],
];