
<?php
function actionUpload(){
        if ((($_FILES["editormd-image-file"]["type"] == "image/gif")
                || ($_FILES["editormd-image-file"]["type"] == "image/jpeg")
                || ($_FILES["editormd-image-file"]["type"] == "image/pjpeg"))
            && ($_FILES["editormd-image-file"]["size"] < 20000))
        {
            if ($_FILES["editormd-image-file"]["error"] > 0)
            {
                echo "Return Code: " . $_FILES["editormd-image-file"]["error"] . "<br />";
            }
            else
            {
//                echo "Upload: " . $_FILES["editormd-image-file"]["name"] . "<br />";
//                echo "Type: " . $_FILES["editormd-image-file"]["type"] . "<br />";
//                echo "Size: " . ($_FILES["editormd-image-file"]["size"] / 1024) . " Kb<br />";
//                echo "Temp file: " . $_FILES["editormd-image-file"]["tmp_name"] . "<br />";

                if (file_exists("upload/" . $_FILES["editormd-image-file"]["name"]))
                {
                    echo $_FILES["editormd-image-file"]["name"] . " already exists. ";
                }
                else
                {
                    move_uploaded_file($_FILES["editormd-image-file"]["tmp_name"],
                        "upload/" . $_FILES["editormd-image-file"]["name"]);
                    echo "Stored in: " . "upload/" . $_FILES["editormd-image-file"]["name"];
                }
            }
        }
        else
        {
            echo "Invalid editormd-image-file";
        }
        $arr = [
            'success'=>1,
            'message'=>'成功',
            'url'=>'https://ss1.bdstatic.com/70cFuXSh_Q1YnxGkpoWK1HF6hhy/it/u=3300305952,1328708913&fm=27&gp=0.jpg'
        ];
        echo json_encode($arr);exit;

}
