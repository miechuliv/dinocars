<?php echo $header; ?><?php // echo $column_left; ?>
<div id="content" style="margin:0;"><?php // echo $content_top; ?>

	<div id="rightcol">
		<div id="homepage">
			<?php echo $column_left; ?>
		</div>
	</div>

	<div class="wyszukiwarka">
	<h1>Wybierz części do swojego samochodu:</h1>

	<?php // echo $content_bottom; ?>

		<div>
			<div>
				<select id="make">
					<option>Marka</option>
				</select>
			</div>
		</div>
		<div>
			<div>
				<select id="model">
					<option>Model</option>
				</select>
			</div>
		</div>
		<div>
			<div>
				<select id="type">
					<option>Typ</option>
				</select>
			</div>
		</div>

	
		<div class="submitto">
			<input type="button" value="szukaj części" class="submit">
		</div>
	

	</div>

</div>

<script>
$(document).ready(function(){
        $('select').each(function(){
            var title = $(this).attr('title');
            if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
            $(this)
                .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
                .after('<span class="select">' + title + '</span>')
                .change(function(){
                    val = $('option:selected',this).text();
                    $(this).next().text(val);
                    })
        });
});
</script>

<?php echo $footer; ?>