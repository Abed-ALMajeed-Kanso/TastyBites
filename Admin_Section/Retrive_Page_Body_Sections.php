<?php
include('DB_Connect.php');
$pageId = $_SESSION['Page_ID'];
$sql = "SELECT Body_Section_ID FROM Pages_Body_sections WHERE Page_ID = ? ORDER BY Body_Section_ID ASC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $pageId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$counter = 0;
if ($result && mysqli_num_rows($result) > 0) {
    $counter = 1; 
    while ($row = mysqli_fetch_assoc($result)) {
        $bodyId = $row['Body_Section_ID'];
        $sqlBody = "SELECT Body_Section FROM Pages_Body_sections WHERE Page_ID = ? AND Body_Section_ID = ?";
        $stmtBody = mysqli_prepare($conn, $sqlBody);
        mysqli_stmt_bind_param($stmtBody, "ii", $pageId, $bodyId);
        mysqli_stmt_execute($stmtBody);
        $resultBody = mysqli_stmt_get_result($stmtBody);

        if ($resultBody && mysqli_num_rows($resultBody) > 0) {
            $rowBody = mysqli_fetch_assoc($resultBody);
            $bodySection = $rowBody['Body_Section'];
            $editorId = "summernote" . $bodyId;
            echo "<h5> Section " . $counter . "</h5><br>";
            echo "<div class='summernote-container-" . $bodyId . "'><textarea class='summernote' id='" . $editorId . "' name='" . $editorId . "'>$bodySection</textarea></div><br><br>";
            $counter++;
        }
        mysqli_stmt_close($stmtBody);
    }
} else {
    echo "No Body found for Page ID = " . $pageId . "<br>";
}
mysqli_stmt_close($stmt);
?>
<script>
$(document).ready(function () {
    <?php 
    for ($i = 1; $i <= $counter; $i++) {
        echo '$("#summernote' . $i . '").summernote({
            tabsize: 4,
            height: 100
        });';
    }
    ?>    
});
</script>
