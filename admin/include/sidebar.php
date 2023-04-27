    <!-- (A) sidebar -->
    <div id="pgside">
        <!-- (A1) Branding or User -->
        <!-- link to dashboard or logout -->
        <div id="pguser">
            <img src="<?php if(isset($_SESSION['user_photo'])) { echo "upload/photos/users/" . $_SESSION['user_photo']; } else { echo "images/admin.jpg"; } ?>" alt="تصویر ادمین" title="تصویر مدیر">
            <span class="txt username"><?php echo($_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name']) ?></span>
        </div>
        <!-- (A2) menu items -->
        <a href="dashboard.php?m=index&p=index" class="<?php if((isset($_GET['m']) and ($_GET['m'] == 'index')) or (!isset($_GET['m']))) echo 'active'; ?>">
            <!-- <i class="ico">&#x2302;</i> -->
            <span class="material-symbols-outlined">home</span>
            <i class="txt">داشبورد</i>
        </a>
        <a href="dashboard.php?m=post&p=index" class="<?php if(isset($_GET['m']) and ($_GET['m'] == 'post')) echo 'active'; ?>">
            <!-- <i class="ico">&#9776;</i> -->
            <span class="material-symbols-outlined">article</span>
            <i class="txt">مقالات</i>
        </a>
        <a href="dashboard.php?m=category&p=index" class="<?php if(isset($_GET['m']) and ($_GET['m'] == 'category')) echo 'active'; ?>">
            <!-- <i class="ico">&#x2630;</i> -->
            <span class="material-symbols-outlined">folder_managed</span>
            <i class="txt">دسته بندی</i>
        </a>
        <a href="dashboard.php?m=comment&p=index" class="<?php if(isset($_GET['m']) and ($_GET['m'] == 'comment')) echo 'active'; ?>">
            <!-- <i class="ico">&#x2630;</i> -->
            <!-- <span class="material-symbols-outlined">folder_managed</span> -->
            <span class="material-symbols-outlined">auto_awesome_motion</span>
            <i class="txt">کامنت ها</i>
        </a>
        <a href="logout.php" class="">
            <!-- <i class="ico">&#x2630;</i> -->
            <!-- <span class="material-symbols-outlined">folder_managed</span> -->
            <span class="material-symbols-outlined">logout</span>
            <i class="txt">خروج</i>
        </a>
    </div>