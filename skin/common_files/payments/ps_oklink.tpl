<h1>Oklink</h1>

{capture name=dialog}
<form action="cc_processing.php?cc_processor={$smarty.get.cc_processor|escape:"url"}" method="post">
    
	<table cellspacing="10">

      <tr>
        <td>API Key:</td>
        <td><input type="text" name="param01" value="{$module_data.param01|escape}" /></td>
      </tr>
      <tr>
        <td>API Secret:</td>
        <td><input type="text" name="param02" value="{$module_data.param02|escape}" /></td>
      </tr>

      <tr>
        <td>Store Currency:</td>
        <td>
          <select name="param03">
            <option value="BTC"{if $module_data.param03 eq "BTC"} selected="selected"{/if}>Bitcoin (BTC)</option>
            <option value="USD"{if $module_data.param03 eq "USD"} selected="selected"{/if}>U.S. Dollars (USD)</option>
            <option value="CNY"{if $module_data.param03 eq "CNY"} selected="selected"{/if}>Chinese Yuan (CNY)</option>
          </select>
        </td>
      </tr>

    </table>

    <br />
    <br />

    <input type="submit" value="{$lng.lbl_update|strip_tags:false|escape}" />

</form>
{/capture}
{include file="dialog.tpl" title=$lng.lbl_cc_settings content=$smarty.capture.dialog extra='width="100%"'}
