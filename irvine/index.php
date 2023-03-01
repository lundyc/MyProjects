<html>

  <head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script src="submit.js"></script>
    <script src="enter.js"></script>
    <script src="popup.js"></script>
    <link rel="stylesheet" type="text/css" href="theme.css">
    <title>Piperhill Ltd - Cash-in Sheet</title>
  </head>

  <body>
    <div class="messagepop">
      <table class="popuptab">
        <tr id="total">
          <td width="30%" class="blue"><strong>Total</strong></td>
          <td width="5%" align="right" valign="middle"></td>
          <td width="65%" valign="middle" class="total_amount">&nbsp;</td>
        </tr>
        <tr id="cash_drop">
          <td class="blue"><strong>Cash Drop</strong></td>
          <td align="right" valign="middle">&pound;</td>
          <td valign="middle" class="cash_drop">&nbsp;</td>
        </tr>
        <tr id="bead_total">
        <td class="blue"><strong>Bread</strong></td>
          <td align="right" valign="middle"></td>
          <td valign="middle" class="bread_total">0</td>
        </tr>
        <tr id="flatbead_total">
        <td class="blue"><strong>Flatbread</strong></td>
          <td align="right" valign="middle"></td>
          <td valign="middle" class="flatbread_total">0</td>
        </tr>
				
        <tr>
          <td colspan="3" align="center" valign="middle"><a class="close" href="/">Cancel</a></td>
        </tr>

      </table>
    </div>

    <form name="form" id="form" method="post" autocomplete="off">
      <table cellpadding="0" cellspacing="2" id="cash">
        <tr>
          <td height=27 colspan="2" class="blue">Name</td>
          <td colspan="2">
            <input name="staff_name" type="text" id="staff_name" value="" placeholder="Enter your Name">
          </td>
        </tr>
        <tr class="blue">
          <td height="43" colspan="2">Cash</td>
          <td colspan="2">Count</td>
        </tr>
        <tr height=27 style='height:20.25pt'>
          <td width="7%" height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
          <td width="22%" class=xl77192621 style='height:20.25pt'>50.00</td>
          <td colspan="2" class=xl78192621>
            <input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="50n" name="50n">
          </td>
        </tr>
        <tr height=27 style='height:20.25pt'>
          <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
          <td class=xl77192621 style='height:20.25pt'>20.00</td>
          <td colspan="2" class=xl78192621>
            <input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="20n" name="20n">
          </td>
        </tr>
        <tr height=27 style='height:20.25pt'>
          <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
          <td class=xl77192621 style='height:20.25pt'>10.00</td>
          <td colspan="2" class=xl78192621>
            <input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="10n" name="10n">
          </td>
        </tr>
        <tr height=27 style='height:20.25pt'>
          <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
          <td class=xl77192621 style='height:20.25pt'>5.00</td>
          <td colspan="2" class=xl78192621>
            <input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="5n" name="5n">
          </td>
        </tr>
        <tr height=27 style='height:20.25pt'>
          <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
          <td class=xl77192621 style='height:20.25pt'>1.00</td>
          <td colspan="2" class=xl78192621>
            <input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="1pound" name="1pound">
          </td>
        </tr>
        <tr height=27 style='height:20.25pt'>
          <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
          <td class=xl77192621 style='height:20.25pt'>0.50</td>
          <td colspan="2" class=xl78192621>
            <input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="50p" name="50p">
          </td>
        </tr>
        <tr height=27 style='height:20.25pt'>
          <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
          <td class=xl77192621 style='height:20.25pt'>0.20</td>
          <td colspan="2" class=xl78192621>
            <input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="20p" name="20p">
          </td>
        </tr>
        <tr height=27 style='height:20.25pt'>
          <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
          <td class=xl77192621 style='height:20.25pt'>0.10</td>
          <td colspan="2" class=xl78192621>
            <input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="10p" name="10p">
          </td>
        </tr>
        <tr height=27 style='height:20.25pt'>
          <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
          <td class=xl77192621 style='height:20.25pt'>0.05</td>
          <td colspan="2" class=xl78192621>
            <input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="5p" name="5p">
          </td>
        </tr>
        <tr height=27 style='height:20.25pt'>
          <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
          <td class=xl77192621 style='height:20.25pt'>0.02</td>
          <td colspan="2" class=xl78192621>
            <input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="2p" name="2p">
          </td>
        </tr>
        <tr height=27 style='height:20.25pt'>
          <td height=27 class=xl77192621 style='height:20.25pt'>&pound;</td>
          <td class=xl77192621 style='height:20.25pt'>0.01</td>
          <td colspan="2" class=xl78192621>
            <input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="1p" name="1p">
          </td>
        </tr>
        <tr height=27 style='height:20.25pt'>
          <td height=27 colspan="2" align="center" style='height:20.25pt'>change</td>
          <td colspan="2" class=xl82192621>
            <input class="price" type="number" placeholder="0.00" min="0" max="10000" step="any" id="change" name="change">
          </td>
        </tr>
        <tr>
          <td height="5" colspan="2">&nbsp;</td>
          <td colspan="2"></td>
        </tr>
        <tr height=27 style='height:20.25pt'>
          <td height=27 colspan="2" class=blue style='height:20.25pt'>Bread Count</td>
          <td colspan="2" class=xl15192621>
            <input type="number" placeholder="0.00" min="0" max="10000" step="any" value="" id="bread" name="bread">
          </td>
        </tr>
        <tr height=27 style='height:20.25pt'>
          <td height=27 colspan="2" class=blue style='height:20.25pt'>Flatbread</td>
          <td colspan="2" class=xl15192621>
            <input type="number" placeholder="0.00" min="0" max="10000" step="any" value="" id="flatbread" name="flatbread">
          </td>
        </tr>

        <tr height=27 style='height:20.25pt' id="submit_but">
          <td height=27 colspan="2" class=xl15192621 style='height:20.25pt'></td>
          <td colspan="2" class=xl15192621>
            <input type="submit" name="submit" id="submit" value="Submit">
          </td>
        </tr>
      </table>
    </form>
  </body>

</html>