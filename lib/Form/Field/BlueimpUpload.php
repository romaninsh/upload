<?php
namespace romaninsh\upload;

/**
 * Class implements file upload with progress monitoring
 */
class Form_Field_BlueimpUpload extends \Form_Field {
    public $progressbar;
    public $uploaded=null;
    function init()
    {
        parent::init();

        $l=$this->api->locate('addons','romaninsh/upload','location');
        $this->api->pathfinder->addLocation($this->api->locate('addons','romaninsh/upload'),array(
            'js'=>'js'
        ))->setParent($l);



        $this->js()->_load('blueimp/jquery.iframe-transport');
        $this->js()->_load('blueimp/jquery.fileupload');
        $this->js()->_load('blueimp/atk4-upload');

        $this->progressbar = $this->belowField()->add('View');
        $this->progressbar->js(true)->progressbar(array('value'=>0));
    }
    function isUploaded()
    {
        return $this->uploaded;
    }
    function getInput()
    {

        $f_id=$this->name.'_f';

        $this->js(true)->_selector('#'.$f_id)->atk4_blueimp_uploader(
            array(
                'progressbar'=>$this->progressbar,
                'input'=>$this,
                'fieldname'=>$this->short_name
            )
        );

        return parent::getInput().$this->getTag('input', array(
            'type'=>'file',
            'name'=>$this->name.'_f',
            'id'=>$this->name.'_f',
        ));
    }
    function getFilePath(){
        return $_FILES[$this->name.'_f']['tmp_name'];
    }
    function getOriginalType(){
        // detect filetype instead of relying on uploaded type
        if(function_exists('mime_content_type'))return mime_content_type($this->getFilePath());
        return $_FILES[$this->name]['type'];
    }
    function loadPOST(){
        parent::loadPOST();

        if(isset($_FILES[$this->name.'_f'])){
            $f=$_FILES[$this->name.'_f'];
            // Uploading something!

            if($f['error']){
                $this->uploadFailed('Error: '.$f['error']);
            }

            if($this->model){
                $model=$this->model;
                $model->set('filestore_volume_id',$model->getAvailableVolumeID());
                $model->set('original_filename',$this->getFilePath());
                $model->set('filestore_type_id',$model->getFiletypeID($this->getOriginalType()));
                $model->import($this->getFilePath());
                $model->save();

                $this->hook('uploaded',array($model));

                $this->uploadComplete($this->model->id, $this->model->get());
            }
        }
        $this->uploadFailed('You should set model for this field');
    }
    function uploadFailed($error){
        echo json_encode(array('error'=>$error));
        exit;
    }
    function uploadComplete($id=-1,$data=array()){
        echo json_encode(array('id'=>$id,'data'=>$data));
        exit;
    }
}
