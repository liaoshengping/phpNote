<?php
namespace user;

use Pimple\Container;

/**
 * user应用
 * Class Application
 */
class Application extends Container
{

    /**

     * Service Providers.

     *

     * @var array

     */

    protected $providers = [
        User::class,
    ];

    /**

     * Application constructor.

     *

     * @param array $config

     */

    public function __construct($config)
    {

        parent::__construct();

        $this['config'] = function () use ($config) {

        };
        if ($this['config']['debug']) {

            error_reporting(E_ALL);

        }
        $this->registerProviders();

    }



    /**

     * Add a provider.

     *

     * @param string $provider

     *

     * @return Application

     */

    public function addProvider($provider)

    {

        array_push($this->providers, $provider);



        return $this;

    }



    /**

     * Set providers.

     *

     * @param array $providers

     */

    public function setProviders(array $providers)

    {

        $this->providers = [];



        foreach ($providers as $provider) {

            $this->addProvider($provider);

        }

    }



    /**

     * Return all providers.

     *

     * @return array

     */

    public function getProviders()

    {

        return $this->providers;

    }



    /**

     * Magic get access.

     *

     * @param string $id

     *

     * @return mixed

     */

    public function __get($id)

    {

        return $this->offsetGet($id);

    }



    /**

     * Magic set access.

     *

     * @param string $id

     * @param mixed  $value

     */

    public function __set($id, $value)

    {
        $this->offsetSet($id, $value);

    }
    private function registerProviders()

    {

        foreach ($this->providers as $provider) {

            $this->register(new $provider());

        }

    }

}
