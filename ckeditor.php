<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>A Simple Page with CKEditor</title>
        <!-- Make sure the path to CKEditor is correct. -->
        <script src="../ckeditor/ckeditor.js"></script>
    </head>
    <body>
        <form>
            <textarea name="editor1" id="editor1" rows="10" cols="80">
                This is my textarea to be replaced with CKEditor.
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1',{
                    extraPlugins: 'image2',

                // Upload images to a CKFinder connector (note that the response type is set to JSON).
                //uploadUrl: '/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files'
                              
                });

                
                /*CKEDITOR.replace( 'editor1',{
                  "filebrowserImageUploadUrl": "/path_to/ckeditor/plugins/imgupload.php"
                });*/
            </script>
        </form>
    </body>
</html>