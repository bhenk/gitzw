<?php
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<div id="nf_div1">
    <div id="nf_div2">
        <div id="nf_page">
            <div id="nf_dig">
                <div>404</div>
            </div>
            <div id="nf_text">
                <div>
                    <a href="/" title="home">
                        <div class="home_link"></div>
                    </a>
                </div>
                <div>
                    Not found: <span><?php echo $actual_link ?></span>
                </div>
            </div>
        </div>
    </div>
</div>