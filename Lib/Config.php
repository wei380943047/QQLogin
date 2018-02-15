<?php
/**
 * Created by PhpStorm.
 * User: wei
 * Date: 2018/2/14
 * Time: 21:52
 */

namespace QQLogin\Lib;


class Config
{
    private static $data;
    private $config;
    private static $instance = null;

    /**
     * @return Config
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * @param mixed $config
     */
    public function init(array $config)
    {
        $this->config = $config;
        if (empty($_SESSION['QC_userData'])) {
            self::$data = array();
        } else {
            self::$data = $_SESSION['QC_userData'];
        }
    }

    public function write($name, $value)
    {
        self::$data[$name] = $value;
    }

    public function read($name)
    {
        if (empty(self::$data[$name])) {
            return null;
        } else {
            return self::$data[$name];
        }
    }

    public function getConfig($name)
    {
        if (empty($this->config[$name])) {
            return null;
        } else {
            return $this->config[$name];
        }
    }

    public function delete($name)
    {
        unset(self::$data[$name]);
    }

    function __destruct()
    {
        $_SESSION['QC_userData'] = self::$data;
    }
}