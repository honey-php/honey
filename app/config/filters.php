<?php
/**
 * Middlewares(filters)
 */

return array(

    /**
     * An example filter, redirects to /secret
     * when you add "?code=topsecret" to your URL address
     */
    'exampleFilter' => function($route) use($app){
        if ($app->request->get('code') == 'topsecret') {
            $app->redirect($app->base() . '/secret');
        }
    }

);