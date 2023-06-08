<?php

?>

<div id="update_order">
    <h2>Update order of works</h2>

    <ul>
        <li>This action will update column `order` in `tbl_works`.</li>
        <li>Column `order` is used to order
            works along `category`, YEAR(`date`), `ordinal`.
        </li>
    </ul>

    <div>
    <form action="/admin/works/order" method="post">
        <input type="submit" name="submit" value="Update">
    </form>
    </div>

</div>