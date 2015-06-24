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
            <textarea name="editor1" id="editor1" rows="50" cols="80">
                This is my textarea to be replaced with CKEditor.
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
               CKEDITOR.replace( 'editor1',{
                    // add class img-responsive for img tag
                    //allowContent:'',
                    //extraAllowedContent: '' ,

                    // call plugin
                    extraPlugins: 'image2,imageresponsive,tableresize'



                
                });

               

                
                /*CKEDITOR.replace( 'editor1',{
                  "filebrowserImageUploadUrl": "/path_to/ckeditor/plugins/imgupload.php"
                });*/
            </script>
        </form>
    </body>
</html>