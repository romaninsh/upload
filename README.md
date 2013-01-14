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
 
