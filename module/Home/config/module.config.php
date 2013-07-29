<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Home\Controller\Index' => 'Home\Controller\IndexController',
        ),
    ),

    'navigation' => array(
    'default' => array(
        array(
            'label' => 'Home',
            'route' => 'home',
        ),
        array(
            'label' => 'Project',
            'route' => 'project',
            'pages' => array(
                array(
                    'label' => 'Add',
                    'route' => 'project',
                    'action' => 'add',
                ),
                array(
                    'label' => 'Edit',
                    'route' => 'project',
                    'action' => 'edit',
                ),
                array(
                    'label' => 'Delete',
                    'route' => 'project',
                    'action' => 'delete',
                ),
            ),
        ),
    ),
    ),

    'router' => array(
        'routes' => array(
           'index' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/index[/:action][/:id]',
                    'constraints'  => array(
                        'action'   => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'       => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Home\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),

    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'home' => __DIR__ . '/../view',
        ),
    ),
);