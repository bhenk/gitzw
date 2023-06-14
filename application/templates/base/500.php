<?php
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<div id="nf_div1">
    <div id="nf_div2">
        <div id="nf_page">
            <div id="nf_dig">
                <div>500</div>
            </div>
            <div id="nf_text">
                <div>
                    <a href="/" title="home">
                        <div class="home_link"></div>
                    </a>
                </div>
                <div>
                    GITZ!. Something went wrong: <span><a
                                href="<?php echo $actual_link ?>"><?php echo $actual_link ?></a></span>
                </div>
            </div>
            <?php if ($this->getRequest()->hasSessionUser()) { ?>
                <div>
                    <?php $e = $this->getError();
                    if (!is_null($e)) {
                        do {
                            echo "<h2>" . $e::class . "</h2>" . $e->getMessage() . "<hr/>";
                            echo $e->getFile() . ":" . $e->getLine() . "<br/>"
                                . str_replace("\n", "<br/>", $e->getTraceAsString());
                            $e = $e->getPrevious();
                        } while (!is_null($e));
                    }
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
