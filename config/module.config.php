<?php
return [
    'sv_images'       => [
        'transformers' => [
            'factories' => [
                \SvImages\Transformer\Crop::class => \SvImages\Transformer\Factory\CropTransformerFactory::class,
                \SvImages\Transformer\Fit::class  => \SvImages\Transformer\Factory\FitTransformerFactory::class,
            ],
        ],
    ],

    'service_manager' => [
        'factories' => [
            \SvImages\Transformer\TransformersManager::class       => \SvImages\Transformer\Factory\TransformersManagerFactory::class,
            \SvImages\Service\ImageService::class                  => \SvImages\Service\Factory\ImageServiceFactory::class,
            \SvImages\Service\CacheManager::class                  => \SvImages\Service\Factory\CacheManagerFactory::class,
            \SvImages\Options\ModuleOptions::class                 => \SvImages\Options\Factory\ModuleOptionsFactory::class,
            \SvImages\ImageManager\InterventionImageManager::class => \SvImages\ImageManager\InterventionImageManager::class,
        ]
    ],

    'controllers'     => [
        'factories' => [
            \SvImages\Controller\ImageController::class => \SvImages\Controller\Factory\ImageControllerFactory::class
        ],
    ],

    'route_manager'   => [
        'factories' => [
            \SvImages\Router\ImageRoute::class => \SvImages\Router\Factory\RouteFactory::class,
        ]
    ],
];