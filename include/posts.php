<main>
    <?php
    if (isset($_GET['page'])) {
        $current_page = $_GET['page'];
    } else {
        $current_page = 1;
    }

    $start_post = ($current_page - 1) * PER_PAGE_LIMIT;

    $result = getPosts($start_post, PER_PAGE_LIMIT);

    if ($result) {
        foreach ($result as $post) {
            echo "<article>";

            echo "<img src='" . "admin/upload/photos/posts/" . $post['photo'] . "' alt='' title=''>";

            echo "<h1>";
            echo $post['title'];
            echo "</h1>";

            echo "<p>";
            echo substr($post['body'], 0, GET_STRING_POST) . "...";
            echo "</p>";

            echo "<p class='author'>";
            $author = getAuthorName($post['user_id']);
            echo "نویسنده: " . $author['first_name'] . " " . $author['last_name'];
            echo "</p>";

            echo "<a href='single.php?post_id=" . $post['id'] . "'>";
            echo "ادامه مطلب";
            echo "</a>";

            echo "</article>";
        }
    } else {
        echo "<h3>پستی برای نمایش وجود ندارد. از بخش ادمین میتوانید پست اضافه کنید</h3>";
        echo "<a href='admin/index.php' style='text-decoration: none;'>پنل ادمین</a>";
    }
    ?>
    <!-- <article>
                <img src="images/1.jpg" alt="" title="">
                <h1>بهترین زبان های برنامه نویسی در سال 2023</h1>
                <p>
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                </p>
                <p class="author">نویسنده: علیرضا خدابنده</p>
                <a href="#">ادامه مطلب</a>
            </article> -->
</main>