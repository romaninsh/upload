<?php

namespace romaninsh\upload;

class View_Uploader extends \AbstractView
{

    public $options=array(
        'dataType'=>'json',
    );
    function init()
    {
        parent::init();

        $this->js(true)->fileupload($this->options);
    }
}
