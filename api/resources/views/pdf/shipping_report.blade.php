<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <title>Shipping Reports</title>

  <style type="text/css">
    body {
      margin: 0;
      padding: 0;
      border: 0 none;
    }
    p {
      margin:0;
      padding:0;
      font-size: 10px;
      line-height: 14px;
    }
    th {
      line-height: 19px;
    }
    td {
      line-height: 19px;
    }    
  </style>
</head>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="left" valign="top" width="100%">          
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td><img src="{{$company_detail[0]->photo}}" title="Culture Studio" alt="Culture Studio" height="100px" width="100px"></td>
                    <td align="center" valign="top" width="50%" class="tableCol">
                        <span style="font-size:15px; line-height:15px;">
                            <strong>{{$company_detail[0]->name}}</strong>                
                        </span>
                        <br/>
                        <span>{{$company_detail[0]->address}}, {{$company_detail[0]->city}}, {{$company_detail[0]->state}}, <br/>{{$company_detail[0]->country}} - {{$company_detail[0]->zip}}<br />{{$company_detail[0]->url}}</span>
                    </td>
                    <td align="right" valign="top" width="25%">
                        <span><strong>Job # {{$shipping->order_id}}</strong></span>
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
            <td align="left" valign="top" width="38%"><span><strong>CLIENT</strong></span>
              <p style="border:1px solid #000000;"><span><strong> {{$shipping->description}}</strong></span><br />
                <span> {{$shipping->address}} {{$shipping->address2}}</span><br />
                <span> {{$shipping->city}} {{$shipping->state}}</span><br/>
                <span> {{$shipping->zipcode}} {{$shipping->country}}</span>
              </p>
            </td>
            <td align="left" valign="top" width="2%">&nbsp;</td>
            <td align="left" valign="top" width="40%"><br /><br /><br /><span></span><br />
                <span><strong>{{$shipping->name}}</strong></span><br />
                <span><strong>Shipped On :</strong> {{$shipping->shipping_by}}</span>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
      <td align="left" valign="top" width="100%">          
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tr>
            <td align="left" valign="top" width="100%" style="font-size:14px;"><span><strong>Garments For Job:</strong> {{$shipping->name}}</span></td>
          </tr>
        </table>
      </td>            
    </tr>

    <tr>
      <td align="left" valign="top" width="100%">&nbsp;</td>
    </tr>


    <!-- <tr>
      <td align="left" valign="top">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          
               @foreach ($color_all_data as $color => $colordata)
               <tr>
                   <td align="left" valign="top" width="100%" style="border:1px solid #000000;">SKU: {{$colordata['desc']}} : COLOR: {{$color}}:
                   <?php $sum = 0; ?>
                    @foreach ($colordata as $size => $value_data)
                   <?php if($size == 'desc'){
                    $size = '';
                   
                   }
                   ?>
                  <?php $sum += $value_data;?>
        
                    <?php if($size != ''){?>
                   [{{$size}}]:{{$value_data}} 
                   <?php }?>
                    @endforeach 
                    :TOTAL QNTY:<?php echo $sum;?>    
                  </td> 
              </tr>
              @endforeach              
          
        </table>
      </td>
    </tr> -->

    

    <tr>
      <td align="left" valign="top" width="100%">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="top" width="100%">&nbsp;</td>
    </tr>

    <tr>
      <td align="left" valign="top" width="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-top:1px solid #000000;">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="50%"><p><span><strong>{{$shipping->description}}</strong></span><br />
                <span>{{$shipping->address}} {{$shipping->address2}}</span><br />
                <span>{{$shipping->city}} {{$shipping->state}} {{$shipping->zipcode}} {{$shipping->country}}</span></p>
            </td>
            <td width="50%" style="font-size:16px;">
              <span><strong>Tracking Number:</strong>{{$shipping->tracking_number}}</span>
            </td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>

    <tr>
        <td align="left" valign="top" width="100%">        
          <table border="0" cellpadding="0" cellspacing="0" width="100%">              
              <thead>
                <tr>
                  <th align="left" valign="top" width="15%" style="border:1px solid #000000;"><strong> Size</strong></th>
                  <!-- <th align="left" valign="top" width="15%" style="border:1px solid #000000;"><strong> Group</strong></th> -->
                  <th align="left" valign="top" width="20%" style="border:1px solid #000000;"><strong> Color</strong></th>
                  <th align="left" valign="top" width="40%" style="border:1px solid #000000;"><strong> Description</strong></th>
                  <th align="right" valign="top" width="10%" style="border:1px solid #000000;"><strong> Qnty&nbsp;&nbsp;</strong></th>
                </tr>
              </thead>
              <tbody class="color-grey">
                @foreach ($shipping_boxes as $box)
                <tr>
                  <td align="left" valign="top" class="brdrBox" width="15%" style="border:1px solid #000000;"> {{$box->size}}</td>
                  <!-- <td align="left" valign="top" class="brdrBox" width="15%" style="border:1px solid #000000;"> {{$box->size_group_name}}</td> -->
                  <td align="left" valign="top" class="brdrBox" width="20%" style="border:1px solid #000000;"> {{$box->color_name}}</td>
                  <td align="left" valign="top" class="brdrBox" width="40%" style="border:1px solid #000000;"> {{$box->product_name}}</td>
                  <td align="right" valign="top" class="brdrBox" width="10%" style="border:1px solid #000000;"> {{$box->boxed_qnty}}&nbsp;&nbsp;&nbsp;</td>
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
              <tbody>
                <tr>
                  <td align="left" valign="top" width="50%" style="font-size:14px;"><strong>TOTAL BOXES {{$other_data['total_box']}}</strong></td>
                  <td align="right" valign="top" width="50%" style="font-size:14px;">
                    <strong>Total Pieces  {{$other_data['total_pieces']}}&nbsp;&nbsp;</strong>
                  </td>
                </tr> 
              </tbody>
          </table>
        </td>
      </tr>

      <tr>
        <td align="left" valign="top" width="100%">&nbsp;</td>
      </tr>

      <tr>
        <td align="left" valign="top" width="100%" class="topbrdr" style="border-top:1px solid #000000;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td align="left" valign="top" width="100%">&nbsp;</td>
            </tr>
            <tr>
              <td width="45%"><span><strong>Total Spoilage:</strong> {{$other_data['total_spoil']}}</span><br />
                <span><strong>Total Manufacturer Defect:</strong> {{$other_data['total_md']}}</span>
              </td>
            </tr>
        </table>
      </td>
    </tr>
</table>
</body>
</html>