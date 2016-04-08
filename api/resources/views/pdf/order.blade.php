
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <title>Orders Print</title>

  <style type="text/css">
    @media print {
      body { margin: 0; padding: 0; }
      td.tableCol { margin: 0; padding: 0; }
      h1.title { margin: 0; padding: 0; font-size: 15px; line-height: 16px; }
      .brdrBox { border:1px solid #999999; }
      div.payDetails { margin: 0; padding: 0; line-height: 1; }
      span { margin: 0; padding: 0; line-height: 1; }
      td { margin: 0; padding: 0; font-size: 12px !important; }
   }
    
  </style>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">    
  <tr>
    <td align="left" valign="top" width="100%">          
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td align="left" valign="top" width="25%">

            <img src="{{$data["company_detail"][0]->photo}}" alt="Logo" style="display:block; max-width:100%;" width="80" />
          </td>
          <td align="center" valign="top" width="25%" class="tableCol">
            <span style="font-size:15px; line-height:15px;">
                <strong>{{$data['company_detail'][0]->name}}</strong>                
            </span>
            <br/>
            <span>{{$data['company_detail'][0]->prime_address1}}, {{$data['company_detail'][0]->prime_address_city}}, {{$data['company_detail'][0]->prime_address_state}}, <br/>{{$data['company_detail'][0]->prime_address_country}} - {{$data['company_detail'][0]->prime_address_zip}}<br />{{$data['company_detail'][0]->url}}</span>
          </td>
          <td align="right" valign="top" width="50%">
            <span>
                <strong>Estimate #{{$data['order']->id}}</strong> <br/> 
                <strong>Created On: {{$data['order']->created_date}}</strong><br/>
                <strong>Job Name:  {{$data['order']->job_name}}</strong></p>
          </td>
        </tr>
        <tr>
          <td align="left" valign="top">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>

  <tr>
    <td align="left" valign="top" width="100%">          
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td align="left" valign="top" width="49%" style="border:1px solid #999; padding:5px;"><div style="display:block; margin:5px;"><strong style="font-size:15px; line-height:15px;">BILL TO</strong><br/>

              <?php $company_name='';;?>
             @foreach ($data['all_company'] as $key => $companydata)
             <?php 
             if($companydata->client_id == $data['order']->client_id){
                 $company_name = $companydata->client_company;
             }?>
             @endforeach


             <?php $main_contact_name='';?>
             @foreach ($data['client_main_data'] as $key => $maindata)
             <?php 
             if($maindata->contact_main == '1'){
                 $main_contact_name = $maindata->first_name.' '.$maindata->last_name;
             }?>
             @endforeach


            <strong>{{$company_name}}</strong><br/>
            {{$main_contact_name}}
          </div>
          </td>
          <td align="left" valign="top" width="2%">&nbsp;</td>
          <td align="left" valign="top" width="49%" style="border:1px solid #999;"><p><strong style="font-size:15px; line-height:15px;">SHIP TO</strong><br/>
            <strong>{{$company_name}}</strong><br/>
            <?php $first = true; $address ='';?>
            
            @foreach ($data['distributed_address'] as $key => $adddata)
             <?php 
             if($adddata->print_on_pdf == '1' && $first){
                 $first = false;
                 $address = $adddata->address ." ". $adddata->address2 ." ". $adddata->city ." ". $adddata->state ." ". $adddata->zipcode ." ".$adddata->country;
               
             }?>
             @endforeach


            {{$address}}</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>

  <tr>
    <td align="left" valign="top" width="100%">&nbsp;</td>
  </tr>

  <tr>
    <td align="left" valign="top" width="100%">        
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th align="left" valign="top" width="20%">Customer PO</th>
            <th align="left" valign="top" width="20%">Rep/Brand Co.</th>
            <th align="left" valign="top" width="10%">Terms</th>
            <th align="left" valign="top" width="10%">Ship Via</th>
            <th align="left" valign="top" width="10%">Ship Date</th>
            <th align="left" valign="top" width="20%">In Hands Date</th>
            <th align="left" valign="top" width="20%">Payment Due</th>
          </tr>
          <tr>
            <th colspan="7">&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <tr>

             <?php $staff_name='';;?>
             @foreach ($data['staff_list'] as $key => $staffdata)
             <?php 
             if($staffdata->id == $data['order']->sales_id){
                 $staff_name = $staffdata->first_name.' '.$staffdata->last_name;
             }?>
             @endforeach

            <td align="left" valign="top" class="brdrBox" width="20%"></td>
            <td align="left" valign="top" class="brdrBox" width="20%"><?php echo $staff_name;?></td>
            <td align="left" valign="top" class="brdrBox" width="10%"></td>
            <td align="left" valign="top" class="brdrBox" width="10%"></td>
            <td align="left" valign="top" class="brdrBox" width="10%"></td>
            <td align="left" valign="top" class="brdrBox" width="20%">{{$data['order']->shipping_by}}</td>
            <td align="left" valign="top" class="brdrBox" width="20%">{{$data['order']->in_hands_by}}</td>
          </tr>
        </tbody>
      </table>
    </td>
  </tr>

  <tr>
    <td align="left" valign="top" width="100%">&nbsp;</td>
  </tr>

  <tr>
    <td align="left" valign="top" width="100%">        
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="garmentDetails">
        <thead>
          <tr>
            <th align="left" valign="top" width="35%">Garment / Item Description</th>
            <th align="left" valign="top" width="10%">Color</th>
            <th align="left" valign="top" width="30%">Sizes / Quantities</th>
            <th align="left" valign="top" width="5%">OS</th>
            <th align="left" valign="top" width="10%">Qnty</th>
            <th align="left" valign="top" width="10%">Unit Price</th>                
          </tr>
          <tr>
            <th colspan="6">&nbsp;</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($data['order_line'] as $key => $orderline)
          <tr>
            <td align="left" valign="top" class="brdrBox" width="35%">&nbsp;{{$orderline->product_name}} / {{$orderline->product_description}}</td>
            <td align="left" valign="top" class="brdrBox" width="10%">&nbsp;{{$orderline->color_name}}</td>
            <td align="left" valign="top" class="brdrBox" width="30%"> 
              @foreach ($orderline->items as $key => $order_size_array)
              <?php if($order_size_array->qnty > 0){?>
              &nbsp;{{$order_size_array->size}} : {{($order_size_array->qnty)}}&nbsp;
              <?php }?>
              @endforeach
              
            </td>
            <td align="left" valign="top" class="brdrBox" width="5%">&nbsp;{{$orderline->os}}</td>
            <td align="left" valign="top" class="brdrBox" width="10%">&nbsp;{{$orderline->qnty}}</td>
            <td align="left" valign="top" class="brdrBox" width="10%">&nbsp;{{$orderline->peritem}}</td>
          </tr>
         @endforeach
        </tbody>
      </table>
    </td>
  </tr>

  <tr>
    <td align="left" valign="top" width="100%">&nbsp;</td>
  </tr>

  <tr>
    <td align="left" valign="top" width="100%">          
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td align="left" valign="top" width="33%">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td align="left" valign="top"><div class="payDetails">@foreach ($data['order_item'] as $orderitem)<?php if($orderitem->selected == '1'){?><span>{{$orderitem->item}} @ {{$orderitem->charge}}</span><br /><?php }?>@endforeach</div>
    
                  <?php $count = 1; ?>
                  @foreach ($data['order_position'] as $position)
                  
                  <?php if($count <= '6'){?> 
                  <div class="payDetails"><?php $pos_id = $position->position_id; 
                      $placement_id = $position->placement_type;
                      $display_label = '';
                      if($placement_id > 0 ) {

                        if($data['order_misc']->placement_type->$placement_id->slug == '43'){
                        $display_label = 'Colors:';
                        }elseif ($data['order_misc']->placement_type->$placement_id->slug == '45') {
                        $display_label = 'Stiches:';
                        } 
                    }

                    if($pos_id > 0) {
                       
                      ?><span>Position: {{$data['order_misc']->position->$pos_id->value}} &nbsp;<strong><?php echo $display_label?>{{$position->color_stitch_count}}</strong></span><br />
                  <?php if($position->discharge_qnty > '0'){ 
                    $discharge_price = $position->discharge_qnty * $data['price_grid']->discharge; ?>
                    <span>Discharge Ink @ <?php echo $discharge_price;?></span><br/>
                  <?php }?>

                  <?php if($position->speciality_qnty > '0'){
                    $speciality_price = $position->speciality_qnty * $data['price_grid']->specialty; ?>
                    <span>Speciality Ink @ <?php echo $speciality_price;?></span><br/>
                  <?php }?>


                  <?php if($position->foil_qnty > '0'){
                    $foil_price = $position->foil_qnty * $data['price_grid']->foil; ?>
                    <span>Foil @ <?php echo $foil_price;?></span><br/>
                  <?php }?>

                  <?php if($position->ink_charge_qnty > '0'){
                    $ink_price = $position->ink_charge_qnty * $data['price_grid']->ink_changes; ?>
                    <span>Ink Charge @ <?php echo $ink_price;?></span><br/>
                  <?php }?>

                   <?php if($position->number_on_dark_qnty > '0'){
                    $dark_price = $position->number_on_dark_qnty * $data['price_grid']->number_on_dark; ?>
                    <span># on Dark @ <?php echo $dark_price;?></span><br/>
                  <?php }?>

                   <?php if($position->number_on_light_qnty > '0'){
                    $light_price = $position->number_on_light_qnty * $data['price_grid']->number_on_light; ?>
                    <span># on Light @ <?php echo $light_price;?></span><br/>
                  <?php }?>

                   <?php if($position->oversize_screens_qnty > '0'){
                   $oversize_price = $position->oversize_screens_qnty * $data['price_grid']->over_size_screens; ?>
                    <span>Oversize Screen @ <?php echo $oversize_price;?></span><br/>
                  <?php }?>

                   <?php if($position->press_setup_qnty > '0'){
                   $press_setup_price = $position->press_setup_qnty * $data['price_grid']->press_setup; ?>
                    <span>Press Setup @ <?php echo $press_setup_price;?></span><br/>
                  <?php }?>

                  <?php if($position->screen_fees_qnty > '0'){
                   $screen_fees_price = $position->screen_fees_qnty * $data['price_grid']->screen_fees; ?>
                    <span>Screen Fee @ <?php echo $screen_fees_price;?></span><br/>
                  <?php }?>

                  <?php   if($position->color_stitch_count > '0') {
                   
                          if($data['order_misc']->placement_type->$placement_id->slug == '43') {
                     
                   foreach ($data['price_screen_primary'] as $price_screen_primary) {

                      if($data['total_qty'] >= $price_screen_primary->range_low && $data['total_qty'] <= $price_screen_primary->range_high) {

                      $price_field = 'pricing_'.$position->color_stitch_count.'c';

                      $screen_price_calc =  $price_screen_primary->$price_field; ?>
                      <span>Screen Print @ <?php echo $screen_price_calc;?></span><br/>
                     <?php 

                       }
                      }
                     } 
                   }

                  } ?>  
          
      
                    
                  </div>
                   <?php }
                    $count++; ?>
                    @endforeach
                  
                 
                </td>
              </tr>
            </table>
          </td>
          <td align="left" valign="top" width="34%">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                
                <td align="left" valign="top" width="100%">
                  <?php if(isset($data['order_image_pdf'][0])) {?>  
                  <img  src="{{$data['order_image_pdf'][0]}}" alt="Logo" style="display:block; width:150px; height:150px;" width="150" height="150" /> <br/>   <br/>
                  <?php }?>      
                  <?php if(isset($data['order_image_pdf'][1])) {?>        
                 <img src="{{$data['order_image_pdf'][1]}}" alt="Logo" style="display:block; width:150px; height:150px;" width="150" height="150" />
                 <?php }?>
                </td>
              </tr>
            </table>
          </td>
          <td align="right" valign="top" width="33%">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
              <tr>
                <td align="right" valign="top" width="45%">Total Qnty</td>
                <td align="left" valign="top" width="5%">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox" width="50%">{{$data['total_qty']}}&nbsp;</td>
              </tr>

              <tr>
                <td align="right" valign="top">Screens</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox">{{$data['order']->screen_charge}}&nbsp;</td>
              </tr>

              <tr>
                <td align="right" valign="top">Press Setup</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox">{{$data['order']->press_setup_charge}}&nbsp;</td>
              </tr>

              <tr>
                <td align="right" valign="top">Digitize</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox">{{$data['order']->digitize_charge}}&nbsp;</td>
              </tr>

              <tr>
                <td align="right" valign="top">Art Work</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox">{{$data['order']->artwork_charge}}&nbsp;</td>
              </tr>

              <tr>
                <td align="right" valign="top">Separations</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox">{{$data['order']->separations_charge}}&nbsp;</td>
              </tr>
              <tr>
                <td align="right" valign="top">Distribution</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox">{{$data['order']->distribution_charge}}&nbsp;</td>
              </tr>

              <tr>
                <td align="right" valign="top">Shipping</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox">{{$data['order']->shipping_charge}}&nbsp;</td>
              </tr>

              <tr>
                <td align="right" valign="top">new charge</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox">{{$data['order']->setup_charge}}&nbsp;</td>
              </tr>

              <tr>
                <td align="right" valign="top">Discount</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox">{{$data['order']->discount}}&nbsp;</td>
              </tr>

              <tr>
                <td align="right" valign="top">Order Total</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox">{{$data['order']->sales_order_total}}&nbsp;</td>
              </tr>

              <tr>
                <td align="right" valign="top">Tax</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox">{{$data['order']->tax}}&nbsp;</td>
              </tr>

              <tr>
                <td align="right" valign="top">Grand Total</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox">{{$data['order']->grand_total}}&nbsp;</td>
              </tr>

              <tr>
                <td align="right" valign="top">Payments/Deposit</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox">{{$data['order']->total_payments}}&nbsp;</td>
              </tr>

              <tr>
                <td align="right" valign="top">Balance Due</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="right" valign="top" class="brdrBox">{{$data['order']->balance_due}}&nbsp;</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>

  <tr>
    <td align="left" valign="top" width="100%">        
      <table border="0" cellpadding="0" cellspacing="0" width="100%">          
        <tr>
          <th align="left" valign="top" width="40%">Garment Link</th>
          <th align="left" valign="top" width="60%">NOTES</th>
        </tr>

        <tr>
          <td align="left" valign="top" width="40%"><a href="#">{{$data['order']->garment_link}}</a>
            </td>
            <td align="left" valign="top" width="60%" style="border:1px solid #999999;">
              {{$data['order']->invoice_note}}
              </td>
            </tr>          
          </table>
        </td>
      </tr>

      <tr>
        <td align="left" valign="top" width="100%">&nbsp;</td>
      </tr>

      <tr>
        <td align="left" valign="top" width="100%">
          <table border="0" cellpadding="0" cellspacing="0" width="70%" align="center">            
            <tr>
              <td align="center" valign="top" width="30%">
                <p style="height:30px; font-size:12px;">Production QC</p>
                <p style="border:1px solid #999999; height:40px; width:40px;"></p>
              </td>
              <td align="center" valign="top" width="3%">&nbsp;</td>
              <td align="center" valign="top" width="30%">
                <p style="height:30px;">QC</p>
                <p style="border:1px solid #999999; height:40px; width:40px;"></p>
              </td>
              <td align="center" valign="top" width="3%">&nbsp;</td>
              <td align="center" valign="top" width="30%">
                <p style="height:30px;">Pack</p>
                <p style="border:1px solid #999999; height:40px; width:40px;"></p>
              </td>
              <td align="center" valign="top" width="3%">&nbsp;</td>
              <td align="center" valign="top" width="30%">
                <p style="height:30px;">Ship</p>
                <p style="border:1px solid #999999; height:40px; width:40px;"></p>
              </td>
              <td align="center" valign="top" width="3%">&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>

      <tr>
        <td align="left" valign="top" width="100%">
          <table border="0" cellpadding="0" cellspacing="0" width="70%" align="center">            
            <tr>

              <?php $trcount=1;$empty_row=0;

                $orderitem_count = count($data['order_item']);
              ?>
              
              @foreach ($data['order_item'] as $orderitem)
              <?php if($orderitem->selected == '1'){
                $empty_row++;
                ?>

             

              <td align="center" valign="top" width="30%">
                <p style="height:30px; font-size:12px;">{{$orderitem->item}}</p>
                <p style="border:1px solid #999999; height:40px; width:40px;"></p>
              </td>
              <td align="center" valign="top" width="3%">&nbsp;</td>

             <?php if($trcount %4 == 0 && $orderitem_count > $trcount){?>
                           </tr>
                            <tr>
                          <?php }?>


              <?php }$trcount++;?>

              @endforeach 

              <?php if($empty_row == '0'){?>
              <td>&nbsp;</td>
              <?php }?>
              </tr>


        <tr>  
        <?php $count = 1;
          $position_array = array();
          $orderpos_count = count($data['order_position']);
        ?>
        <?php //echo count($data['order_position']);exit;?>
        @foreach ($data['order_position'] as $position)
         
          <?php $pos_id = $position->position_id; 
          $placement_id = $position->placement_type;

          if($pos_id > 0) {

          if(!in_array($data['order_misc']->position->$pos_id->value,$position_array)) {
          array_push($position_array, $data['order_misc']->position->$pos_id->value); 
          ?>

           <?php if($count %4 == 0 && $orderpos_count > $count){?>
               </tr>
                <tr>
              <?php }?>

           <td align="center" valign="top" width="30%">
                <p style="height:30px; font-size:12px;">Print {{$data['order_misc']->position->$pos_id->value}}</p>
                <p style="border:1px solid #999999; height:40px; width:40px;"></p>
              </td>
          <td align="center" valign="top" width="3%">&nbsp;</td>

          


          <?php }$count++;}
           ?>
        @endforeach


              <?php if($count == '1'){?>
              <td>&nbsp;</td>
              <?php }?>
            </tr>
          </table>
        </td>
      </tr>

      <tr>
        <td align="center" valign="top" width="100%">        
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td align="center" valign="top">&nbsp;</td>
            </tr>                     
            <tr>
              <td align="center" valign="top">
                <span class="txtUpCash">Please respond with "Approved, Name and Date",  for order to be placed into production</span>
                <span class="txtSmall">Unless document states final invoice the amount listed may not be the total due. Shipping, tax and any additions during the art or press stages may result in a change of price.</span>
              </td>
            </tr>
          </table>
        </td>
      </tr>

    </table>
  </body>
  </html>