<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	pSet('3');
</script>

<div class="bdiv cont">
    <div class="content">
        <div class="list_item">
            <label>:: 货单号：{$_GET['b_code']} ::</label>　　<<a href="javascript:;" onClick="javascript :history.back(-1);">返回</a>>
        </div>
        <div class="list">
            货组编号：{$info.bill_item.bi_id} - <label>[{$info.bill_item.bi_status|getBillItemStatus}]</label>
            <table>
                <tr>
                    <th width="30" rowspan="2"></th>
                    <th rowspan="2" width="110"><img src="{$Think.config.CN_URL}{$info.bill_item.bi_cnum1_pho}" width="80" height="80"/><br/></th>
                    <th rowspan="2" width="110"><img src="{$Think.config.SN_URL}{$info.bill_item.bi_snum1_pho}" width="80" height="80"/><br/></th>
                    <th>箱号：{$info.bill_item.bi_cnum1}</th>
                    <th width="30" rowspan="2"></th>
                    <th rowspan="2" width="110"><img src="{$Think.config.CN_URL}{$info.bill_item.bi_cnum2_pho}" width="80" height="80"/><br/></th>
                    <th rowspan="2" width="110"><img src="{$Think.config.SN_URL}{$info.bill_item.bi_snum2_pho}" width="80" height="80"/><br/></th>
                    <th>箱号：{$info.bill_item.bi_cnum2}</th>
                </tr>
                <tr>
                    <th>封号：{$info.bill_item.bi_snum1}</th>
                    <th>封号：{$info.bill_item.bi_snum2}</th>
                </tr>
                <tr>
                    <th></th>
                    <th colspan="7">
                        封箱: {$info.bill_item.bi_sum}箱　　　
                        毛重: {$info.bill_item.bi_gwei}吨　　　
                        皮重: {$info.bill_item.bi_tare}吨　　　
                        净重: {$info.bill_item.bi_nwei}吨　　　
                        货款：{$info.bill_item.bi_dpay|formatMoney}元
                        ({$info.bill_item.bi_dpri|formatMoney}元/吨)　　　
                        <a href="{$Think.config.LD_URL}{$info.bill_item.bi_video1}">A箱视频</a>　　
                        <a href="{$Think.config.LD_URL}{$info.bill_item.bi_video2}">B箱视频</a>
                    </th>
                </tr>
            </table>
            <if condition="$info['bill_item']['bi_status'] gt 1">
            <table>
                <tr>
                    <td></td>
                    <td>物流信息：</td>
                    <td width="320">{$info.order_item.oi_otime|getDateTime} [装车]</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>入港时间：</td>
                    <td width="220">{$info.order_item.bi_itime|getDateTime} </td>
                    <td width="90">入港名称：</td>
                    <td>{$info.order_item.bi_pname}</td>
                </tr>
                <tr>
                    <td width="30"></td>
                    <td width="90">上架时间：</td>
                    <td colspan="3">{$info.order_item.bi_stime|getDateTime} </td>
                </tr>
                <tr>
                    <td width="30"></td>
                    <td width="90">成交时间：</td>
                    <td colspan="3">{$info.order_item.bi_dtime|getDateTime} </td>
                </tr>
            </table>
            </if>

            <if condition="$info['bill_item']['bi_status'] gt 3">
            <table>
                <tr>
                    <th width="30"></th>
                    <th width="90">{$info.bill_item|getBillItemPayStatus}结回款：</th>
                    <th width="300">
                        <label>{$info.bill_item.bi_rpay|formatMoney}</label> 元
                    </th>
                    <th width="90">{$info.bill_item|getBillItemPayStatus}付利息：</th>
                    <th>
                        <label><b>{$info.order_item.oi_id}</b></label> 元 (回款
                        {$info.bill_item.bi_rpay|formatMoney}元 x
                        日利率{$info.bill.b_rrate} x
                        在售{$info.bill_item|getSellDays}天)
                    </th>
                </tr>
                <tr>
                    <th></th>
                    <th>{$info.bill_item|getBillItemPayStatus}
                        {$info.bill|getBackMoneyText=$info['bill_item']}：</th>
                    <th><label><b>{$info.bill|getBackMoney=$info['bill_item']}</b></label>元
                        (货款{$info.bill|getClinch=$info['bill_item']}元 - 回款{$info.bill_item.bi_rpay|formatMoney}元)</th>
                    <th>{$info.bill_item|getBillItemPayStatus}退保证金：</th>
                    <th><label><b>{$info.bill_item.bi_depo|formatMoney}</b></label>元 (付清结算费用后，即退。)</th>
                </tr>
            </table>
            </if>
        </div>
    </div>
</div>

<?php
    include 'inc/bot.php';
?>