
<link href="assets/Styles/Body_Sections_Style.css" rel="stylesheet">    
    <?php  
        include ('DB_Connect.php');      
        $Page_Title = ""; 
        $Page_State = "";
        if(isset($_GET['page_id'])){
            $_SESSION['Page_ID'] = $_GET['page_id'];
            $Page_ID = $_GET['page_id'];
            $pageId = $Page_ID; 
        }
        if (isset($_SESSION['Page_ID'])) {
            $pageId = $_SESSION['Page_ID'];
            $sql = "SELECT * FROM Pages WHERE Page_ID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "i",  $_SESSION['Page_ID']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $Page_Title = $row['Title'];
                $Page_State = ($row['Active'] == 0 ? "Inactive" : "Active");
            }
        }
    ?>
    <script>
        function toggleInput(inputType) {
            var inputDiv = document.getElementById(inputType + "Input");
            if (inputDiv.style.display === "none") {
                inputDiv.style.display = "block";
            } else {
                inputDiv.style.display = "none";
            }
        }
    </script>  

<div class = "text-center"><h1><?php echo htmlspecialchars($Page_Title); ?> Page Content</h1><br></div>

<div style="display: flex; justify-content: center; margin-bottom: 30px; padding-bottom: 20px;">
    <form class="form-inline" id="body_sections_form">
        <div class="col">
            <input type = "hidden" id = "page" name = "page" value = "Body_Sections" >
            <br><div class="row-md-4">
                <h3>Page ID:</h3>
                <input type="number" class="form-control" id="page_id" value="<?php echo htmlspecialchars( $_SESSION['Page_ID']); ?>" name="page_id" disabled>
            </div><br>

            <div class="row-md-4">
                <h3>Page Title:</h3>
                <input type="text" class="form-control" id="title" value="<?php echo htmlspecialchars($Page_Title); ?>" name="title">
            </div><br>

            <div class="row-md-4">
                <h3>Page State:</h3><br>
                <select class="form-control" id="state" name="state" onchange="toggleInput('state')">
                    <option value="activate" <?php echo ($Page_State === "Active") ? "selected" : ""; ?>>Activate</option>
                    <option value="inactivate" <?php echo ($Page_State === "Inactive") ? "selected" : ""; ?>>Inactivate</option>
                </select>
            </div><br>

            <!-- Body Sections -->
            <h3>Body Sections:</h3><br>
            <?php include('Retrive_Page_Body_Sections.php'); ?>

            <div class="text-center">
                <button type="submit" class="btn  custom-search-button-2" style="width: 180px;" id="Update" name="Update" value="Update">
                    <h4>Update</h4>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
$(document).ready(function () {
    $('#body_sections_form').submit(function(e){
        e.preventDefault();
        start_load(); 

        $('input[type="hidden"]').remove();

        $('.summernote').each(function(index) {
            var editorId = $(this).attr('id');
            var content = $(this).summernote('code'); 

            console.log('Editor ID:', editorId, 'Content:', content);

            $('<input>').attr({
                type: 'hidden',
                id: 'hidden_' + editorId,
                name: editorId, 
                value: content
            }).appendTo('#body_sections_form');
        });

        $.ajax({
            url: 'ajax.php?action=save_pages',
            data: $('#body_sections_form').serialize(),
            method: 'POST',
            success: function(resp){
                console.log('Response:', resp); 
                if(resp == 1){
                    alert_toast("Data successfully added", 'success'); 
                    setTimeout(function(){
                        location.reload();
                    }, 1500);
                } else {
                    alert_toast("Error updating data", 'danger'); 
                }
            }
        });
    });
});
</script>


</body>
</html> 