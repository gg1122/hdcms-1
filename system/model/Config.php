<?php namespace system\model;

use houdunwang\config\Config as C;

/**
 * 系统配置
 * Class Config
 *
 * @package system\model
 */
class Config extends Common
{
    protected $table = 'config';

    protected $auto = [];

    protected $config = ['site' => [], 'register' => []];
    //允许填充字段
    protected $allowFill = ['*'];

    /**
     * 初始配置
     */
    public function initConfig()
    {
        $this->initSiteConfig();
        $this->initRegisterConfig();
        if (empty($this['site'])) {
            foreach ($this->config as $field => $value) {
                $this[$field] = json_encode($value);
            }
            $this->save();
        }
    }

    /**
     * 初始站点配置
     */
    protected function initSiteConfig()
    {
        $this->config['site'] = Arr::merge([
            'is_open'             => 1,
            'close_message'       => '网站维护中,请稍候访问',
            'enable_code'         => 1,
            'hdcms_update_notice' => 1,
            'upload'              => [
                'size' => '200000000',
                'type' => 'jpg,jpeg,gif,png,zip,rar,doc,txt,pem,json,php',
                'path' => 'attachment',
                'mold' => 'local',
            ],
            'http'                => ['rewrite' => 1,],
            'app'                 => ['debug' => 1,],
            'aliyun'              => [
                'accessId'  => '',
                'accessKey' => '',
            ],
            'oss'                 =>
                [
                    'endpoint'      => '',
                    'bucket'        => '',
                    'custom_domain' => 1,
                ],
        ], isset($this['site']) ? json_decode($this['site'], true) : []);
        C::set('upload', array_merge(C::get('upload'), $this->config['site']['upload']));
        C::set('upload.size', $this->config['site']['upload']['size'] * 1024);
        C::set('app', array_merge(C::get('app'), $this->config['site']['app']));
        C::set('http', array_merge(C::get('http'), $this->config['site']['http']));
        C::set('aliyun', array_merge(C::get('aliyun'), $this->config['site']['aliyun']));
        C::set('oss', array_merge(C::get('oss'), $this->config['site']['oss']));
        v('config.site', $this->config['site']);
    }

    /**
     * 初始注册配置
     */
    protected function initRegisterConfig()
    {
        $this->config['register'] = Arr::merge([
            //开启注册
            'is_open'              => 1,
            'audit'                => 0,
            'enable_register_code' => 1,
            'enable_login_code'    => 1,
            'groupid'              => 1,
        ], $this['register'] ? json_decode($this['register'], true) : []);
        v('config.register', $this->config['register']);
    }
}