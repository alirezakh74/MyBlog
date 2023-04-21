<div class="btn">
    <a href="dashboard.php?m=post&p=add">افزودن پست جدید</a>
</div>
<table class="dashboard_table">
    <thead>
        <th>شماره پست</th>
        <th>عنوان</th>
        <th>نمایش پست</th>
        <th>ویرایش</th>
        <th>حذف</th>
    </thead>
    <tbody>
        <?php
        // delete post
        if (isset($_GET['operation']) and ($_GET['operation'] == "delete") and isset($_GET['id'])) {
            if (!deletePost($_GET['id'])) {
                echo "حذف ناموفق بود";
                exit;
            }
        }

        $result = getPostInfo();
        foreach ($result as $row) {
        ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['title'] ?></td>
                <td><input type="checkbox" onchange="changeActive(this)" name="is_active" id="<?php echo $row['id']; ?>" <?php if ($row['active'] == 1) echo "checked"; ?>></td>
                <td><a href="<?php echo "dashboard.php?m=post&p=edit&id=" . $row['id'] ?>"><img src="icons/edit.png" alt=""></a></td>
                <td><a href="<?php echo "dashboard.php?m=post&p=index&operation=delete&id=" . $row['id'] ?>"><img src="icons/delete.png" alt=""></a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    function changeActive(this_check) {
        var id = this_check.id;
        var checked = this_check.checked;
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                //alert(response);
                if(response == "activation updated")
                {
                    //alert("done");
                }
                else if(response == "activation failed")
                {
                    //alert("error");
                }
            }
        };
        var url_query = "post/activate.php?id=" + id + "&active=" + checked;
        //alert(url_query);
        xmlhttp.open("GET", url_query, true);
        xmlhttp.send();
    }
</script>