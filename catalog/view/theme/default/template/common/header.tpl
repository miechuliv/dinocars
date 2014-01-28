<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/stylesheet.css" />
<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery.cycle.js"></script>
<?/*
<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/phpfreechat-2.1.0/client/themes/default/jquery.phpfreechat.min.css" />
<script src="/phpfreechat-2.1.0/client/jquery.phpfreechat.min.js" type="text/javascript"></script>
*/?>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if IE 7]> 
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie7.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->

<script type="text/javascript"><!--



function dynafoot() {
	var szerokoscstopki = $('#footer').height();

	if($(window).scrollTop() + $(window).height() > $(document).height() - szerokoscstopki) {
		setTimeout(function() { $('#ultraheader').addClass('klej'); },200);
	} else {
		setTimeout(function() { $('#ultraheader').removeClass('klej'); },200);
	}
	if($(window).scrollTop() > 75) {
		$('#mobileheader').addClass('stick');
	} else {
		$('#mobileheader').removeClass('stick');
	}
}

function showmenu() {
	$('#zaciem').css('display','block');
	$('#mobileheader').addClass('podmenu');
	$('.nohome .box').css('display','block');
}

function hidemenu() {
	$('#zaciem').css('display','none');
	$('#mobileheader').removeClass('podmenu');
	$('.nohome .box').css('display','none');
}

function showsearch() {
	$('#zaciem').css('display','block');
	$('.serch-right').css('display','block');
	$('#mobileheader').addClass('podmenu');
}

function hidesearch() {
	$('#zaciem').css('display','none');
	$('.serch-right').css('display','none');
	$('#mobileheader').removeClass('podmenu');
}


$(window).scroll(function() {
	dynafoot();
});

$(document).ready(function() {

$('#showmobilemenu').click(function() { showmenu(); });
$('#showmobilefilter').click(function() { showsearch(); });
$('.boxclose').click(function() { hidemenu(); });
$('.boxclosef').click(function() { hidesearch(); });

	dynafoot();

<?php if ($stores) { ?>
<?php foreach ($stores as $store) { ?>
$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
<?php } ?>
    <?php } ?>



    <?php if(isset($filters['price_min_value'])){ ?>
        <!-- slider cena -->



        var price_min_values = [<?php foreach($filters['price_min_value'] as $value){ echo $value.','; }; ?>];
        var price_max_values = [<?php foreach($filters['price_max_value'] as $value){ echo $value.','; }; ?>];


        var numPos=0;
        var step=250/<?php echo $filters['number_price_sections']; ?>;
        var max=250;
        var position_min=<?php if(isset($filters['current_price_min'])){echo $filters['current_price_min'].'*';}else{echo $filters['default_current_price_min'].'*';}?>(step);
        var position_max=<?php if(isset($filters['current_price_max'])){ echo $filters['current_price_max'].'*';}else{echo $filters['default_current_price_max'].'*';}?>(step);



        $("#slider_price").slider({
            min:0,
            max:250,
            step:250/<?php echo $filters['number_price_sections']; ?>,
        values:[position_min, position_max],
                slide: function(event, ui) {

            if(ui.values[0]>ui.values[1]){
                var newvalues=[ui.values[1]-step,ui.values[1]];
                $("#slider_price").slider('values',0,newvalues[0]); // sets first handle

                return false;
            }




            numPos1 = (parseInt(ui.values[0])/max)*<?php echo $filters['number_price_sections']; ?>;
            numPos2 = (parseInt(ui.values[1])/max)*<?php echo $filters['number_price_sections']; ?>;
            numPos1=numPos1.toFixed(0);
            numPos2=numPos2.toFixed(0);

            $("#cena_min").val(price_min_values[numPos1]);
            $("#cena_max").val(price_max_values[numPos2]);
            $("#price_search").val(ui.values);
        }
    });

    $("#slider_price").mouseup(function(){
        $("#miechu_form").submit();
    });
    <?php } ?>

    });


//--></script>

    <script>
        $(document).ready(function(){
            $('.kill-filter span').click(function(){
                var elem = $(this).parents('.kill-filter');


                killFilter(elem);
            });
        });




        function killFilter(elem)
        {
            var input_name = $(elem).find('input[name="input_name"]').val();


            var def_value = $(elem).find('.filter-name').text();


            var target = $('select[name="'+input_name+'"] option:eq(0)');

            if(target.length)
            {
                $(target).prop('selected', true);
                $(target).attr('selected', 'selected');

                $('select[name="'+input_name+'"]').next('.select').html(def_value);
            }
            else
            {
                target = $('input[name="'+input_name+'"]');

                $.each(target,function(key,elem){

                            $(elem).attr('checked',false);

                            $(elem).parent().removeClass('active');

                }
                )



            }







            $(elem).remove();
        }
    </script>

<?php echo $google_analytics; ?>

  <?php /*  <script type="text/javascript" src="catalog/view/javascript/project_specyfic/translator.js"></script> */ ?>
  <?php /*  <script type="text/javascript" src="catalog/view/javascript/project_specyfic/comments.js"></script>  */ ?>

 <?php /*   <script type="text/javascript">

         var comment = new Comments();



    </script>

     <script>
            translateSetRoute('<?php echo isset($this->request->get["route"])?$this->request->get["route"]:" "; ?>');
     </script> */ ?>
</head>
<body <?php if(!in_array('common/home',Utilities::getControllerList() )) { ?> class="nohome" <?php } ?>>
<div id="zaciem" style="display:none"></div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pl_PL/all.js#xfbml=1&appId=112173815552215";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="black"></div>


<div id="header">
<div class="poziom">

<div>

	  <?php if ($logo) { ?>
	  <div id="logo"><a href="./"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
	  <?php } ?>
 
</div>
<div id="telmobile">
	<h1><?php echo $this->config->get('config_telephone'); ?></h1>
</div>
<div>
	<?php if(in_array('checkout/cart',Utilities::getControllerList() )) { ?>
		<div style="display:table; width:100%;">
			<div style="display:table-cell; vertical-align:middle; width:75%;" id="mor">
				<h1 style="margin:0"><?php echo $text_greet_cart; ?>.</h1>
				<h2><?php echo $text_ask; ?>: <span style="color:#be0000"><?php echo $this->config->get('config_telephone'); ?></span></h2>
			</div>
			<div style="display:table-cell; vertical-align:middle; width:25%; text-align:right;">	  
				<img src="./catalog/view/theme/default/img/trust.png" alt="trusted"/>	
			</div>
		</div>
	<?php } else if(in_array('checkout/checkout',Utilities::getControllerList() )) { ?>
		<div style="display:table; width:100%;">
			<div style="display:table-cell; vertical-align:middle; width:75%;" id="mor">
				<h1 style="margin:0"><?php echo $text_greet_checkout; ?>.</h1>
				<h2><?php echo $text_ask; ?>: <span style="color:#be0000"><?php echo $this->config->get('config_telephone'); ?></span></h2>
			</div>
			<div style="display:table-cell; vertical-align:middle; width:25%; text-align:right;">	  
				<img src="./catalog/view/theme/default/img/trust.png" alt="trusted"/>	
			</div>
		</div>
	<?php } else { ?>
		<div style="float:left;" class="mobilesearch">
			<div id="search">
				<input type="text" class="borderb" name="search" placeholder="<?php echo $text_search; ?>" value="<?php echo $search; ?>" />
				<div class="button-search"><?php echo $text_search; ?></div>
                <select name="search_category" >
                    <option value="0">Wszystkie kategorie</option>
                    <?php foreach($categories_for_search as $category){ ?>
                        <option <?php if($category['category_id'] == $category_search){ echo 'selected="selected"'; } ?> value="<?php echo $category['category_id']; ?>" ><?php echo $category['name']; ?></option>
                    <?php } ?>
                </select>
			</div>
		</div>
		<div style="float:right;">	  
			<?php echo $cart; ?>    
			<div id="trusted"><img src="./catalog/view/theme/default/img/trust.png" alt="trusted"/></div>	
		</div>
	<?php } ?>
</div>
</div>
</div>

<div id="mobileheader">
	<div>
		<?php if(!in_array('checkout/cart',Utilities::getControllerList()) && !in_array('checkout/checkout',Utilities::getControllerList()) && !in_array('product/product',Utilities::getControllerList())) { ?>
			<a href="javascript:void(0);" id="showmobilemenu"><span><?php echo $text_category; ?></span></a>
			<a href="javascript:void(0);" id="showmobilefilter"><span><?php echo $text_filter; ?></span></a>
		<?php } else { ?>
			<a href="./index.php?route=account/login" class="clear"><span><?php echo $text_login; ?></span></a>
		<?php } ?>
			<span class="phone"><span><?php echo $this->config->get('config_telephone'); ?></span></span>
	</div>
</div>

<div id="container">

<?php  /* if ($categories) { ?>
<div id="menu">
  <ul>
    <?php foreach ($categories as $category) { ?>
    <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
      <?php if ($category['children']) { ?>
      <div>
        <?php for ($i = 0; $i < count($category['children']);) { ?>
        <ul>
          <?php $j = $i + ceil(count($category['children']) / $category['column']); ?>
          <?php for (; $i < $j; $i++) { ?>
          <?php if (isset($category['children'][$i])) { ?>
          <li><a href="<?php echo $category['children'][$i]['href']; ?>"><?php echo $category['children'][$i]['name']; ?></a></li>
          <?php } ?>
          <?php } ?>
        </ul>
        <?php } ?>
      </div>
      <?php } ?>
    </li>
    <?php } ?>
    <?php foreach($informations as $information){ ?>

      <li><a href="<?php echo $information['href']; ?>"><?php echo $information['name']; ?></a></li>
    <?php } ?>
  </ul>
</div>
<?php } */?>

<div id="notification"></div>
    <div id="translateBox"></div>


<?php /* foreach(Utilities::getInstance()->getControllerList() as $controller){ ?>
      <input type="hidden" name="active_controller[]" value="<?php echo $controller; ?>.php" />
<?php } */ ?>


<div class="poziom" style="position:relative;">