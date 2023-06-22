<?php

use bhenk\gitzw\base\Site;
use chillerlan\QRCode\QRCode;

?>
<!-- login.php -->
<div class="center-screen">
    <div id="login-container">
        <div>
            <a href="/" title="home">
                <div class="home_link"></div>
            </a>
        </div>
        <div>Login <?php echo Site::hostName() ?></div>
        <hr>
        <?php if ($this->getSessionUser()) { ?>
            <div class="row">
                <?php echo $this->getSessionUserFullName();// . " (" . $this->getSessionUserName() . ")"; ?>
            </div>
            <div class="row"><?php echo $this->getSessionUserLastLogin(); ?>&nbsp;</div>
            <div class="row">
                <a href="/logout">
                    <button class="btn">Logout</button>
                </a>
                <a href="/admin">
                    <button class="btn">Admin page</button>
                </a>
            </div>
        <?php } else { ?>
            <div class="row"><?php echo $this->getMessage(); ?>&nbsp;</div>
            <form action="/login" method="post">
                <div class="row">
                    <div class="col-label"><label for="username">Username</label></div>
                    <div class="col-input">
                        <input type="text" id="username" name="username" value="<?php echo $this->getUserName() ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-label"><label for="password">Password</label></div>
                    <div class="col-input">
                        <input type="password" id="password" name="password">
                        <p id="cl_text">WARNING! Caps lock is ON.</p>
                    </div>
                </div>
                <div class="row"><input type="hidden" name="action" value="login"></div>
                <div class="row">
                    <input type="submit" class="btn" value="Login">
                </div>
            </form>
        <?php } ?>

        <div class="row">
            <span><?php echo $this->getClientIp(); ?></span>
            <span title="copy IP" class="copyprevious"
                  onclick="copyPrevious(this)" style="color: inherit;">&nbsp;&#10064; </span>
        </div>

        <form action="/login" method="post">
            <div class="row">
                <div class="col-label"><input type="submit" class="btn" value="Hash"></div>
                <div class="col-input"><input type="text" name="word" value=""></div>
            </div>
            <div class="row"><input type="hidden" name="action" value="hash"></div>
        </form>
        <span class="hash"><?php echo $this->getHash(); ?></span>
        <?php if ($this->getHash() != "") { ?>
            <span title="copy hash" class="copyprevious"
                  onclick="copyPrevious(this)" style="color: inherit;">&nbsp;&#10064; </span>
        <?php } ?>

    </div>
</div>

<script>
    let input = document.getElementById("password");
    let pw_text = document.getElementById("cl_text");
    pw_text.style.display = "none"

    input.addEventListener("keyup", function(event) {
        if (event.getModifierState("CapsLock")) {
            pw_text.style.display = "block";
            pw_text.style.color = "red";
        } else {
            pw_text.style.display = "none"
        }
    });
</script>
<!-- /login.php -->


