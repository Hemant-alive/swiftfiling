<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>

<meta name="viewport" content="width=device-width, user-scalable=no,initial-scale=1">
<table width="100%" height="100%" style="border-collapse:collapse; border: none ; background:#ebeef3;">
<tr>
<td align="center" style="padding:0 10px;">
    
<table style="border-collapse:collapse; border: none ;  font-size:14px; width:100%; max-width:600px;">
  <thead>
    <tr>
       <tr align="center">
          <td><h5 style="margin:0; font-size:24px; color:#6d879a; font-weight:600; font-family:calibri;" >Dear, <?php echo $response['userName'] ;?></h5></td>
        </tr>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <div style="padding:15px; background:#fff;">
          <table width="100%" border="0">
              <tbody align="center" style="min-height:300px;">
                <tr>
                    <td>
                        <h5 style="color:#049d25; font-size:26px; font-weight:normal; margin:10px 0 20px 0; font-family:calibri;">Welcome to Swiftflings.com</h5>
                    </td>
                </tr>
         <tr>
         
          <td align="center">
                 <div class="custom-thanks-page">
                        <h1>Thank you for your order</h1>
                        <h5><i class="icon icon-check-circle green"></i> Your order is Failed.Something went wrong with your Paypal payment!</h5>  
                        <h5>YOUR ORDER NUMBER: <span class="red"><?php echo $user->order_id; ?></span></h5>
                        <p><a href="{{url('llc/place-order')}}"> Try Again</a></p>
                        
                 </div>
          </td>
        </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td align="center">
              <p style="color:#7d7b7b; font-size:18px; line-height:28px; padding: 15px 0 0 0; margin: 0; border-top:solid #dfdfdf 1px; font-family:calibri; ">
              <strong style="color:#000; font-family:calibri;">Thank You.</strong><br>
              Customer Service Team
            </p>
          </td>
                </tr>
              </tfoot>
            </table>
        </div>
      </td>
    </tr>
  </tbody>
  <tfoot>
  <tr>
    <td align="center" height="150">
    </td>
  </tr>
  </tfoot>
</table>

</td>
</tr>
</table>
