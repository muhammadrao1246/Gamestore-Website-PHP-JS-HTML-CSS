<div class="header">
        <div class="left-header">
            <a class="left-head-anchors" href="/practice/index.php?root=Home">Home</a>
            <div name="games" id="games-section">
                <a class="left-head-anchors" href="/practice/index.php?root=Games">Games</a>
                <div>
                    <div class="dropdown">
                    <?php 
                        $r_games=mysqli_query($con,'select distinct genre from games order by genre;');
                        while($row_games=mysqli_fetch_array($r_games))
                        {
                    ?>
                        <a class="left-head-anchors" href="/practice/index.php?category=<?php  echo $row_games['genre']; ?>">
                            <?php  echo $row_games['genre']; ?>
                        </a>
                    <?php
                        }
                    ?>
                    </div>
                </div>
            </div>
            <a class="left-head-anchors" href="/practice/index.php?root=Support">Support</a>
            <a class="left-head-anchors" href="/practice/index.php?root=About Us">About Us</a>
        </div>
        <div class="right-header">
                <a class="right-head-anchor" href="/practice/login.php?root=Login">Login</a>
                <a class="right-head-anchor" href="/practice/signup.php?root=Sign Up">Sign Up</a>
        </div>


    </div>