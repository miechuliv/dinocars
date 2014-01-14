<?php echo $header; ?><?php // echo $column_left; ?>
<div id="content" style="margin:0;"><?php // echo $content_top; ?>

	<div id="rightcol">
		<div id="homepage">
			<?php echo $column_left; ?>
		</div>
	</div>

	<div class="wyszukiwarka"> 
	<h1>Znajdź potrzebne części wg auta</h1>
	<h2>Wystarczy że wybierzesz markę, model i typ swojego pojazdu!</h2>
	
	<form id="czesci_szuk" action="<?php echo $car_action; ?>" method="get">
    <input type="hidden" value="product/category" name="route" />


			<div>
				<div class="marka">
					<select id="make" name="make">
						<option>Marka</option>
					</select>
				</div>
			</div>
			<div>
				<div>
					<select id="model" name="model">
						<option>Model</option>
					</select>
				</div>
			</div>
			<div>
				<div>
					<select id="type" name="type">
						<option>Typ</option>
					</select>
				</div>
			</div>

		
			<div class="submitto">
				<input type="submit" id="szukaj-but" value="Znajdź teraz!" class="submit">
			</div>
		<?/*
			<div id="car">
				<img src="./catalog/view/theme/default/img/car.png" alt=""/>
			</div>
			*/?>
		</div>
	
	</form>
	
	<?php // echo $content_bottom; ?>

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
					$(this).attr('title', val);
					if(val.length > 17) { $(this).next().text(val.substring(0,17)+"...");  }
                    })
        });		
	
	$('#make').change(function(){
		$('#model').next('.select').addClass("wybrany_select");   
	});

	$('#model').change(function(){
		$('#type').next('.select').addClass("wybrany_select");   
	});

});	
</script>

<?php echo $footer; ?>