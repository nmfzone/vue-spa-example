<?php

if (! function_exists('resourceNames')) {
    /**
     * Get the array of name for the route resource.
     *
     * @param  string  $name
     * @return array
     */
    function resourceNames($name)
    {
        return [
            'index' => $name . '.index',
            'create' => $name . '.create',
            'store' => $name . '.store',
            'show' => $name . '.show',
            'edit' => $name . '.edit',
            'update' => $name . '.update',
            'destroy' => $name . '.destroy',
        ];
    }
}

if (! function_exists('apiResource')) {
    /**
     * Lumen RESTful route.
     *
     * @param  mixed  $router
     * @param  string  $name
     * @param  string  $controller
     * @param  string  $binding
     * @param  string  $namespace
     * @return void
     */
    function apiResource(&$router, $name, $controller, $binding = null)
    {
        $binding = $binding ?: str_singular($name);

        $router->get($name, $controller.'@all');
        $router->get($name.'/{'.$binding.'}', $controller.'@get');
        $router->post($name, $controller.'@store');
        $router->put($name.'/{'.$binding.'}', $controller.'@update');
        $router->delete($name.'/{'.$binding.'}', $controller.'@destroy');
    }
}

if (! function_exists('updateDotEnv')) {
    /**
     * Update the .env value based on the given data.
     *
     * @param  array   $data
     * @return boolean
     */
    function updateDotEnv($data = [])
    {
        if (count($data) > 0) {
            $env = file_get_contents(base_path() . '/.env');
            $env = explode(PHP_EOL, $env);

            foreach ($data as $key => $value) {
                foreach ($env as $env_key => $env_value) {
                    $entry = explode("=", $env_value, 2);
                    if ($entry[0] == $key) {
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        $env[$env_key] = $env_value;
                    }
                }
            }

            $env = implode("\n", $env);
            file_put_contents(base_path() . '/.env', $env);

            return true;
        }

        return false;
    }
}
