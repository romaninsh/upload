<?php
class View_File extends AbstractView {
    function setModel($m)
    {
        $m=parent::setModel($m);
        if ($m instanceof filestore\Model_Image) {
            $this->initializeTemplate(null,array($this->addon.'./view/thumb'));
        } else {
            $this->initializeTemplate(null,array($this->addon.'./view/file'));
        }

        $this->uploader = $this->add($this->addon.'/View_Uploader');

        $this->uploader->addHook('afterUpload',$this);
    }
    function afterUpload()
    {
        return $this->js()->reload();
    }
    function addDropAction($selector)
    {
    }
    function defaultTemplate()
    {
        return false;
    }
}
