    <?php include('DB_Connect.php'); ?>
    <link href="assets/Styles/Body_Sections_Style.css" rel="stylesheet">

        <div class="row justify-content-center search_bar_main">
        <form id="search_bar2" method="GET"> 
            <div class = "form-group">
            <select class="form-control div-60" name="search_criteria" value="Search By">
                <option value="Page_ID">Page ID</option>
                <option value="Title">Page Title</option>
                <option value="Active">Active Pages</option>
            </select> 
            <input type = "hidden" id = "page" name = "page" value = "Manage_Pages" >
            <div class = "flex" >
                <input id = "inp2" type="text" class="form-control div-60" placeholder="Search By" name="search">
                <button id="search_btn2" class="btn btn-primary custom-search-button div-30" type="submit">Search</button>    
            </div>
            </div>
        </form>
        </div>

        <?php 
            $searchPerformed = false;
            $searchValue = '';
            
            if (isset($_GET['search_criteria']) && isset($_GET['search'])) {
                $searchCriteria = $_GET['search_criteria'];
                $searchPerformed = true;
                $searchValue = $_GET['search'];
                if($searchCriteria=="Active"){
                    if(strcasecmp($searchValue, "yes") === 0)
                        $searchValue = 1;
                    if(strcasecmp($searchValue, "no") === 0)
                        $searchValue = 0;
                }
                $sql = "SELECT * FROM Pages WHERE $searchCriteria LIKE '%$searchValue%'";
                $result = $conn->query($sql);
            } 
            else{ 
                $sql = "SELECT * FROM Pages";
                $result = $conn->query($sql);
            }
                if ($result && $result->num_rows > 0) {
            ?>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Page ID</th>
                                            <th>Page Title</th>
                                            <th>Active</th>
                                        </tr>
                                    </thead>
                                    <tbody>
            <?php      
                while ($row = $result->fetch_assoc()) {
            ?>

                <tr>
                    <td><?php echo $row["Page_ID"]; ?></td>
                    <td> 
                        <a href="<?php echo './index.php?page=Body_Sections&page_id=' . $row["Page_ID"]; ?>"><?php echo $row["Title"]; ?></a>
                    </td>
                    <td><?php echo ($row["Active"] == 0 ? "No" : "Yes")?></td>
                </tr>

                <?php } ?>  

                <?php } else { ?>

                    <div class="text-center br1">No data found in the Pages table.</div>

                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <div>
    </div>
