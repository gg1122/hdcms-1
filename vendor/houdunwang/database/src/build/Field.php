<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDPHP framework]
 * |      Site: www.hdphp.com  www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * |     Weibo: http://weibo.com/houdunwangxj
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace houdunwang\database\build;

/**
 * 数据迁移字段类型
 * Trait Field
 *
 * @package houdunwang\database\build
 */
trait Field
{
    //字段集
    protected $fields = [];

    protected function current()
    {
        return count($this->fields) - 1;
    }

    public function index($field)
    {
        $this->fields[$this->current()]['index'] = $field;

        return $this;
    }

    public function unique($field)
    {
        $this->fields[$this->current()]['unique'] = $field;

        return $this;
    }

    public function nullAble()
    {
        $this->fields[$this->current()]['null'] = ' NULL ';

        return $this;
    }

    public function defaults($value)
    {
        $this->fields[$this->current()]['default'] = is_string($value) ? "'$value'" : $value;

        return $this;
    }

    public function unsigned()
    {
        $this->fields[$this->current()]['unsigned'] = ' unsigned ';

        return $this;
    }

    public function comment($value)
    {
        $this->fields[$this->current()]['comment'] = $value;

        return $this;
    }

    public function increments($field)
    {
        $this->fields[] = [
            'field' => $field,
            'sql'   => $field." INT PRIMARY KEY AUTO_INCREMENT ",
        ];

        return $this;
    }

    public function tinyInteger($field)
    {
        $this->fields[] = [
            'field' => $field,
            'sql'   => $field." TINYINT ",
        ];

        return $this;
    }

    public function enum($field, $data)
    {
        $this->fields[] = ['field' => $field, 'sql' => $field." enum('".implode("','", $data)."') "];

        return $this;
    }

    public function integer($field)
    {
        $this->fields[] = ['field' => $field, 'sql' => $field." INT "];

        return $this;
    }

    public function datetime($field)
    {
        $this->fields[] = ['field' => $field, 'sql' => $field." DATETIME "];

        return $this;
    }

    public function timestamps()
    {
        $this->fields[] = [
            'field' => 'created_at',
            'sql'   => "created_at MEDIUMTEXT ",
        ];
        $this->fields[] = [
            'field' => 'updated_at',
            'sql'   => "updated_at MEDIUMTEXT ",
        ];
    }

    public function date($field)
    {
        $this->fields[] = ['field' => $field, 'sql' => $field." DATE "];

        return $this;
    }

    public function smallint($field)
    {
        $this->fields[] = [
            'field' => $field,
            'sql'   => $field." SMALLINT ",
        ];

        return $this;
    }

    public function mediumint($field)
    {
        $this->fields[] = [
            'field' => $field,
            'sql'   => $field." MEDIUMINT ",
        ];

        return $this;
    }

    public function decimal($field, $len, $de)
    {
        $this->fields[] = [
            'field' => $field,
            'sql'   => $field." decimal($len,$de) ",
        ];

        return $this;
    }

    public function float($field, $len, $de)
    {
        $this->fields[] = [
            'field' => $field,
            'sql'   => $field." float($len,$de) ",
        ];

        return $this;
    }

    public function double($field, $len, $de)
    {
        $this->fields[] = [
            'field' => $field,
            'sql'   => $field." double($len,$de) ",
        ];

        return $this;
    }

    public function char($field, $len = 255)
    {
        $this->fields[] = [
            'field' => $field,
            'sql'   => $field." char($len) ",
        ];

        return $this;
    }

    public function string($field, $len = 255)
    {
        $this->fields[] = [
            'field' => $field,
            'sql'   => $field." VARCHAR($len) ",
        ];

        return $this;
    }

    public function text($field)
    {
        $this->fields[] = [
            'field' => $field,
            'sql'   => $field." TEXT ",
        ];

        return $this;
    }

    public function mediumtext($field)
    {
        $this->fields[] = [
            'field' => $field,
            'sql'   => $field." MEDIUMTEXT ",
        ];

        return $this;
    }
}