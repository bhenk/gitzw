<?php
/** @var NotFoundControl $ctrl */

use bhenk\gitzw\base\Site;
use bhenk\gitzw\ctrl\NotFoundControl;

$ctrl = $this;
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<div id="nf_div1">
    <div id="nf_div2">
        <div id="nf_page">
            <div id="nf_dig">
                <div><?php echo $ctrl->getErrorCode(); ?></div>
            </div>
            <div id="nf_text">
                <div>
                    <a href="/" title="home">
                        <div class="home_link"></div>
                    </a>
                </div>
                <div>
                    <?php echo $ctrl->getErrorString() ?>: <span><?php echo $actual_link ?></span>
                </div>
            </div>
            <?php
            if ($ctrl->showIP()) {
                $clientIP = Site::clientIp();
                echo "<div class='ip_text'>You are not eligible for login<br/>$clientIP</div>";
            }
            ?>
        </div>
    </div>
</div>