<div class="box">
<?/* <div class="box-heading"><?php echo $heading_title; ?></div>*/?>
<a href="javascript:void(0);" class="boxclose" style="display:none">x</a>
<h2><?php echo $heading_title; ?></h2>
  <div class="box-content">
    <ul class="box-category <?php if(array_key_exists('route',$this->request->get)) { ?> normal <?php } ?>">
      <?php foreach ($categories as $category) { ?>
      <li>
        <?php if ($category['category_id'] == $category_id) { ?>
        <a href="<?php echo $category['href']; ?>" class="active"><?php echo $category['name']; ?></a>
        <?php } else { ?>
        <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
        <?php } ?>
        <?php if ($category['children']) { ?>
        <ul class="subcategory">
          <?php foreach ($category['children'] as $child) { ?>
          <li>
            <?php if ($child['category_id'] == $child_id) { ?>
            <a href="<?php echo $child['href']; ?>" class="active" style="font-size:13px;"><?php echo $child['name']; ?></a>
            <?php } else { ?>
            <a href="<?php echo $child['href']; ?>" style="font-size:13px;"><?php echo $child['name']; ?></a>
            <?php } ?>
          </li>
          <?php } ?>
        </ul>
        <?php } ?>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>

<div class="serch-right">
<a href="javascript:void(0);" class="boxclosef" style="display:none">x</a>
<h2>Filtruj wg auta</h2>
		<form id="czesci_szuk" class="szukaja" action="<?php echo $car_action; ?>" method="get">

          
		
			<input type="hidden" value="<?php echo $route; ?>" name="route" />
            <input type="hidden" value="<?php echo $path; ?>" name="path" />

				
				<div style="display:table; clear:both; width:100%;">
					<div>
						<div class="marka">

							<select id="make" name="make" >
                                <option  >Marka</option>
                                <?php if(isset($makes)){ ?>
                                <?php foreach($makes as $make){ ?>
                                <?php if(isset($filters['cars']['make']) AND $filters['cars']['make']==$make['make_id']){ ?>

                                <option value="<?php echo $make['make_id']; ?>" selected="selected" ><?php echo $make['make_name']; ?></option>
                                <?php }else{ ?>

                                <option value="<?php echo $make['make_id']; ?>" ><?php echo $make['make_name']; ?></option>
                                <?php } ?>

                                <?php } ?>
                                <?php } ?>
							</select>
						</div>
					</div>
					<div>
						<div>
							<select id="model" name="model">
								<option>Model</option>
                                <?php if(isset($filters['models'])){ ?>
                                <?php foreach($filters['models'] as $model){ ?>
                                <?php if(isset($filters['cars']['model']) AND $filters['cars']['model']==$model['model_id']){ ?>
                                <option value="<?php echo $model['model_id']; ?>" selected="selected" ><?php echo $model['model_name']; ?></option>
                                <?php }else{ ?>

                                <option value="<?php echo $model['model_id']; ?>" ><?php echo $model['model_name']; ?></option>
                                <?php } ?>

                                <?php } ?>
                                <?php } ?>
							</select>
						</div>
					</div>
					<div>
						<div>
							<select id="type" name="type">
								<option>Typ</option>
                                <?php if(isset($filters['types'])){ ?>
                                <?php foreach($filters['types'] as $type){ ?>
                                <?php if(isset($filters['cars']['type']) AND $filters['cars']['type']==$type['type_id']){ ?>
                                <option value="<?php echo $type['type_id']; ?>" selected="selected" ><?php echo $type['type_name']; ?></option>
                                <?php }else{ ?>

                                <option value="<?php echo $type['type_id']; ?>" ><?php echo $type['type_name']; ?></option>
                                <?php } ?>

                                <?php } ?>
                                <?php } ?>
							</select>
						</div>
					</div>
				</div>	
				
			<div style="display:table; margin:5px 0; clear:both; width:100%;">
				<div style="padding:0 4px;">
					<input type="submit" id="szukaj-but" value="Znajdź teraz!" class="submit">
				</div>
			</div>
			
		</form>	

</div>

<script>
$(document).ready(function(){

        $('select').each(function(){
            var title = $(this).attr('title');
            if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
            $(this)
                .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
                .after('<span class="select"><span>' + title + '</span></span>')
                .change(function(){			
                    val = $('option:selected',this).text();
                    $(this).next().html('<span>' + val + '</span>');
					$(this).attr('title', val);
					if(val.length > 14) { $(this).next().html('<span>' + val.substring(0,14)+'...</span>');  }
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