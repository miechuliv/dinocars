<?php echo $header; ?>
<div id="content">
    <form method="post" action="<?php echo $action; ?>" >
        <table>
            <?php foreach($extensions as $extension){ ?>
                      <tr>
                <td>
                    <?php echo $extension['code']; ?>
                </td>
                <td>
                    <input type="checkbox" name="extensions[<?php echo $extension['extension_id']; ?>][]" value="0"
                    <?php if(in_array(0,$extension['stores'])){ echo 'checked="checked"'; } ?>
                    /> Store: 'Default';
                    <?php foreach($stores as $store){ ?>
                    <input name="extensions[<?php echo $extension['extension_id']; ?>][]" type="checkbox" value="<?php echo $store['store_id']; ?>"
                    <?php if(in_array($store['store_id'],$extension['stores'])){ echo 'checked="checked"'; } ?>
                    /> Store: <?php echo $store['store_id']; ?>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>
        <input type="submit" value="Zapisz"/>
</div>



</form>


<?php echo $footer; ?>