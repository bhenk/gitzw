<?php ?>

<div id="copyright"><?php echo $this->getCopyrightText(); ?></div>

<div class="license">
    <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/" target="_blank">
        <img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" />
    </a>
</div>

<script>
    window.addEventListener("DOMContentLoaded", () => {
        const elem = document.getElementById("copyright");
        let text = elem.textContent;
        text = text.replace("info", "<a href='mai__002");
        text = text.replace("__002", "lto:info__003");
        text = text.replace("__003", "@__004");
        text = text.replace("__004", "gitzw.art'>");
        text = text.replace(" at gitzw.art", "info at gitzw.art</a>");
        elem.innerHTML = text;
    });
</script>