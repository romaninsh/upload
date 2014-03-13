Upload Field (2.0) for ATK
====

Uploading files have been a challenge with Agile Toolkit. Filestore and "Upload" field have had a great functionality allowing you to upload files much simpler, however the upload field didn't provide all the great features and flexibility it could. 

This add-on implements a better upload field. 

Features
----

### Field/Upload

Simple file uploading, just one file, after complete says "Upload OK"

  * Compatible with Upload field. Simple use different class
  * Uses BlueImp Upload jQuery widget instead of built-in
  * Will use AJAX uploading if available or iFrame as a fall-back
  * Allow you to define PHP hook which is executed on successful file upload
  * Triggers JavaScript event when upload is finished (compatibility) 
  * Show progress-bar during upload
  * Cancelled upload show field again
  * Supports File and Image upload
  * By default will display "OK", but can use some other view instead, from below

Notes:

 * Requires filestore, can't use without
 * Supports single file upload, although comes with FileManager view 
 
 
**NOTE: Perhaps will re-shuffle those views to group them**
 
### View/FileAdmin

 * Basically a regular View with pre-defined template similar to original upload
 * Allows to delete or download file
 * Uses similar template to original upload field

### View/Thumb

 * This is a simple View which will show a thumbnail. 
 * $thumb->setModel($file)->load(10);
 * can be used with upload file
 * displays blank image when model is not loaded

### View/ThumbAdmin

 * Extends Thumb
 * Adds a cross, with JS functionality to delete image

### Controller/DropZone

 * Add this controller to a view, and you'll be able to drop images there
 * Will automatically add a hidden upload field or can use the one you specify
 * Ideal for use with View/Thumb. Drop image into a thumb to upload new

 
### View/FileList

 * Lister similar to Thumb but shows multiple files
 * Does not require model to be loaded, will iterate it
 * Still supports drop-zone
 * Can enable re-ordering easily
 * Can link with form field, which would contain list of model IDs
 
### View/FileListAdmin

 * Lister similar to ThumbAdmin, allowing to delete individual images
 
API Reference
----

### Stand-alone use:
```
$uploader = $this->add('romaninsh/upload/View_Uploader');
$uploader -> setModel('filestore/File');
```
This works without a form. Simply relies on BlueImp Uploader here. You can specify $uploder->options to change anything about the uploading. You can use hook "uploaded" to do something useful with this.

Test case: test/romaninsh/upload/test1

#### Form use:
```
$uploader = $form->addField('romaninsh/upload/Upload','file_id');
$uploader -> setModel('filestore/File');
```

After file is uploaded will put the model->id inside a hidden 'file_id' field. This field automatically relies on View/FileAdmin or View/ThumbAdmin (depending on your model) to display uploaded file. It will also hide upload field after successful upload and show it back if you remove the file.

Will also trigger 'upload' so that it's more or less compatible with previous uploader implementation.

If you enable multi-file use, then it would be relying on the lister view.

