<?php namespace Idee\Sharp;

use \Dvlpp\Sharp\Auth\SharpAuth as SharpAuthInterface;
use Illuminate\Contracts\Config\Repository;
use Session;

class Auth implements SharpAuthInterface {

    protected $user = false;

    /**
     * @var Repository
     */
    protected $config;

    /**
     * @param Repository $config
     */
    function __construct(Repository $config)
    {
        $this->config = $config;
    }

    public function checkAdmin()
    {
        return $this->getUser();
    }

    public function login($login, $password)
    {
        if ($login == $this->config->get('idee.sharp_login') && $password == $this->config->get('idee.sharp_pwd'))
        {
            \Session::put("sharp_admin", $login);
            return $login;
        }
        return false;
    }

    public function logout()
    {
        \Session::forget("sharp_admin");
    }

    public function checkAccess($user, $type, $action, $key)
    {
        return $this->getUser();
    }

    private function getUser()
    {
        if($this->user == false)
        {
            $this->user = \Session::get("sharp_admin");
        }

        return $this->user;
    }
}