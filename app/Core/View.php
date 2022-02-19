<?php

namespace app\Core;

class View
{
    protected $title = '';
    protected $links = '';
    protected $scripts = '';

    public function addCSS($files)
    {
        if (!is_array($files)) {
            $files = (array) $files;
        }
        foreach ($files as $file) {
            $this->links .= '<link type="text/css" rel="stylesheet" href="' . $file . '" />' . "\n\t";
        }
    }

    public function addData(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function addScript($files)
    {
        if (!is_array($files)) {
            $files = (array) $files;
        }
        foreach ($files as $file) {
            $this->links .= '<script src="' . $file . '"></script>' . "\n\t";
        }
    }

    public function getCSS()
    {
        return($this->links);
    }

    public function getFile($filepath)
    {
        $filename = VIEW_PATH . $filepath . ".php";
        if (file_exists($filename)) {
            require $filename;
        }
    }

    public function getScripts()
    {
        return($this->scripts);
    }

    public function render($filepath, array $data = [])
    {
        $this->addData($data);
        $this->getFile(DEFAULT_HEADER_PATH);
        $this->getFile($filepath);
        $this->getFile(DEFAULT_FOOTER_PATH);
    }
}