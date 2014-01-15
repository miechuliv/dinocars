<?php echo $header; ?>

   <div id="content">

  <?php  if(isset($error_msg)){ echo $error_msg; }?>

       <form method="post" action="<?php echo $debay_config_action;?>" >
       <?php $i=true; ?>
       <table style="display:block" id="tabela-config">
            <?php foreach($shipping_services as $service){ ?>

         <?php if($i){ echo '<tr>'; } ?>
              <td class="grey">    <label for="debay_shipping_<?php echo $service->ShippingService; ?>" class="grass">Metoda wysyłki</label> </td>
               <td>   <input type="text" class="nazwa" value="<?php echo $service->Description; ?>" name="debay_shipping_<?php echo $service->ShippingService; ?>" disabled="disabled" /></td>
               <td>   <label for="debay_shipping_cost_<?php echo $service->ShippingService; ?>" >Koszt wysyłki:</label></td>
               <td>   <input type="text" value="<?php echo $service->Cost; ?>" name="debay_shipping_cost_<?php echo $service->ShippingService; ?>" style="width:50px;"/></td>

           <?php if(!$i){ echo '</tr>'; } ?>
           <?php if($i){ $i=false; }else{ $i=true; }            } ?>

          <?php /* <tr>
              <label for="debay_PaymentInstructions" ><h2>Instrukcje płatności, wyświetlą się na stronie ebay po dokonaniu zakupu</h2></label>
              <textfield  name="debay_PaymentInstructions" value="<?php echo $debay_PaymentInstructions ?>" >

              </textfield>
          </tr> */ ?>
       </table>

       <div style="padding:5px; font-weight:bold;">
           Polityka zwrotów:
       </div>
        <table>
            <tr>
                <td>
				<div style="float:left; width:100%;">
                    <label for="debay_ReturnsAccepted_<?php echo $site; ?>">Czy przymujesz zwroty?</label>
                    <?php if($debay_ReturnsAccepted){ ?>
                    <input type="checkbox" name="debay_ReturnsAccepted_<?php echo $site; ?>" value="1" checked="checked" >
                    <?php }else{ ?>
                    <input type="checkbox" name="debay_ReturnsAccepted_<?php echo $site; ?>" value="1"  >
                    <?php } ?>
					Akceptuj zwroty
				</div><div style="float:left; width:100%; margin:5px 0;">
                    <label for="debay_ReturnsWithinOption_<?php echo $site; ?>">Ile dni na zwrot?</label>
                    <select name="debay_ReturnsWithinOption_<?php echo $site; ?>"  >
                          <?php foreach($return_duration_codes as $key => $code){ ?>
                               <?php if($key == $debay_ReturnsWithinOption ){ ?>
                                   <option value="<?php echo $key ?>" selected="selected" ><?php echo $code; ?></option>
                               <?php }else{ ?>
                        <option value="<?php echo $key ?>"  ><?php echo $code; ?></option>

                               <?php } ?>
                          <?php } ?>
                    </select>
				</div></div><div style="float:left; width:100%; margin:5px 0;">
                    <label for="debay_Description_<?php echo $site; ?>">Instrukcje do zwrotu</label>
                    <textarea name="debay_Description_<?php echo $site; ?>"  style="width:100%; height:100px; padding:5px;"><?php echo $debay_Description; ?></textarea>
				</div>
                </td>

            </tr>
			<!-- chwilowo wyłączone ze względu na problem z przekzaniem wielokrotnej płatności -->
           <tr>
                Metody płatności
            </tr>
            <tr>

                    <?php foreach($payment_methods as $key => $method){ ?>
                   <td><label for="debay_payment_method_<?php echo $key; ?>" ><?php echo $method; ?></label></td>
                   <td><input type="checkbox" value="<?php echo $key; ?>" name="debay_payment_method_<?php echo $key; ?>" <?php if($debay_payment_method[$key]){ echo 'checked="checked"'; } ?>  /></td>
                    <?php } ?>
                   <td>
                       <label for="debay_paypal_email_<?php echo $site; ?>" >Adres email PayPal</label>
                       <input type="text" name="debay_paypal_email_<?php echo $site; ?>" value="<?php echo $debay_paypal_email; ?>" />
                   </td>
            </tr>
        </table>

       <input type="submit" value="Zapisz" />
       </form>
   </div>


<?php echo $footer; ?>