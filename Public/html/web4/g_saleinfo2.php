<?php
    include 'inc/top.php';
?>
<script type="text/javascript">
	pSet('3');
</script>

<div class="bdiv cont">
    <div class="content">
        <div class="list_item">
            <label>:: 货单号：{$info.b_code} - {$info.b_status|getBillStatus} :: </label>
            <if condition="$info.b_status gt 0">　　 <<a href="">下载电子合同</a>></if>
            <if condition="$info.b_status eq -1">　
                <<a href="/Home/Sell/sellBill/b_id/{$info.b_id}">修改</a>> 　
                <<a href="#" onclick="disp_confirm()">删除</a>></if>
        </div>
        <div class="list">
            <table>
                <tr>
                    <td width="30" rowspan="6"></td>
                    <td width="230" rowspan="6"><img src="{$info.b_photo}" width="200" height="200" /></td>
                    <td width="20"></td>
                    <td colspan="3">品名：{$info.b_name}　　年份：{$info.b_year}　　产地：{$info.b_place}　　等级：{$info.b_level}　　容重：{$info.b_rz}g/l</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">生霉：{$info.b_mb}%　　水份：{$info.b_sf}%　　杂质：{$info.b_zz}%　　呕吐毒素：{$info.b_ot}μg/kg</td>
                </tr>
                <tr>
                    <td></td>
                    <td width="200">初始单价：{$info.b_pri0|formatMoney}元/吨</td>
                    <td width="200">净重总计：{$info.b_weig}吨</td>
                    <td>{$info|getFrei} (200元/车*{$info|getCartNumber}车)</td>
                </tr>
                <tr>
                    <td></td>
                    <td>初始总价：{$info|getAllPrice}元</td>
                    <td>{$info|getDepo}</td>
                    <td></td>
                </tr>
                <if condition="$info['b_status'] gt 3">
                    <tr>
                        <td></td>
                        <td>货款已回：340,000元</td>
                        <td colspan="2">回款时间：2018年7月15日 11:21:35 (距今5天)</td>
                    </tr>
                </if>

                <tr>
                    <td></td>
                    <td colspan="3">装货地址：{$info.b_add}　　联系人：{$info.b_cont}　　手机号：{$info.b_mobi}</td>
                </tr>
            </table>
            <table>
                <if condition="$info['wait']">
                    <tr>
                        <th width="30"></th>
                        <th>({$info.wait|count}) 待上架货组：</th>
                        <th colspan="3"><label>{$info.b_pri1}</label>元/吨 <a href="/Home/Sell/changePrice?b_id={$_GET['b_id']}"><修改单价></a></th>
                        <th width="150"></th>
                        <th width="90"></th>
                    </tr>
                    <volist name="info.wait" id="vo">
                        <tr>
                            <td></td>
                            <td>NO：{$vo.bi_id} {$info|getBillItemStatusByBill=$vo['bi_status']}</td>
                            <td width="90">{$vo.bi_gwei}吨({$vo.bi_sum}箱)</td>
                            <td width="180">{$vo.bi_dpay|formatMoney}元</td>
                            <td width="60">已回款：</td>
                            <td><a href="/Home/Sell/billItemInfo/bi_id/{$vo.bi_id}?b_code={$info.b_code}"><货组详情></a></td>
                        </tr>
                    </volist>
                </if>

                <if condition="$info['on_sell']">
                    <tr>
                        <th width="30"></th>
                        <th>({$info.on_sell|count}) 在售货组：</th>
                        <th colspan="3"><label>{$info.b_pri1}</label>元/吨 <a href="/Home/Sell/changePrice?b_id={$_GET['b_id']}"><修改单价></a></th>
                        <th width="240"></th>
                        <th width="90"></th>
                    </tr>
                    <volist name="info.on_sell" id="vo">
                        <tr>
                        <td></td>
                        <td>NO：{$vo.bi_id} {$info|getBillItemStatusByBill=$vo['bi_status']}</td>
                        <td width="90">{$vo.bi_gwei}吨({$vo.bi_sum}箱)</td>
                        <td width="90">{$vo.bi_dpay|formatMoney}元</td>
                        <td width="60">已回款：</td>
                        <td>{$vo.bi_rpay|formatMoney}元 (计息{$info|getInte=$vo}元)</td>
                        <td><a href="/Home/Sell/billItemInfo/bi_id/{$vo.bi_id}?b_code={$info.b_code}"><货组详情></a></td>
                    </tr>
                    </volist>
                </if>

                <if condition="$info['finish_sell']">
                    <tr>
                        <th></th>
                        <th colspan="4">({$info.finish_sell|count}) 已售货组：</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <volist name="info.finish_sell" id="vo">
                        <tr>
                            <td></td>
                            <td>NO：{$vo.bi_id} {$info|getBillItemStatusByBill=$vo['bi_status']}</td>
                            <td width="90">{$vo.bi_gwei}吨({$vo.bi_sum}箱)</td>
                            <td width="180">{$vo.bi_dpay|formatMoney}元</td>
                            <td width="60">已回款：</td>
                            <td>{$vo.bi_rpay}元 (结息{$vo.bi_inte|formatMoney}元)</td>
                            <td><a href="/Home/Sell/billItemInfo/bi_id/{$vo.bi_id}?b_code={$info.b_code}"><货组详情></a></td>
                        </tr>
                    </volist>
                </if>

                <if condition="$info['over_sell']">
                    <tr>
                        <th></th>
                        <th colspan="4">({$info.over_sell|count}) 已结货组：</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <volist name="info.over_sell" id="vo">
                        <tr>
                            <td></td>
                            <td>NO：{$vo.bi_id} {$info|getBillItemStatusByBill=$vo['bi_status']}</td>
                            <td width="90">{$vo.bi_gwei}吨({$vo.bi_sum}箱)</td>
                            <td width="180">{$vo.bi_dpay|formatMoney}元</td>
                            <td width="60">已回款：</td>
                            <td>{$vo.bi_rpay}元 (结息{$vo.bi_inte}元)</td>
                            <td><a href="/Home/Sell/billItemInfo/bi_id/{$vo.bi_id}?b_code={$info.b_code}"><货组详情></a></td>
                        </tr>
                    </volist>
                </if>
            </table>

            <table>
                <if condition="$info['b_status'] GT 3 AND $info['b_status'] LT 10">
                <tr>
                    <th width="30"></th>
                    <th width="200">需支付：<label><b>585<b></label> 元</th>
                    <th colspan="5">其中：待付利息 <label><b>85</b></label> 元，待付跌价差价 <label><b>500</b></label> 元，请按合同说明方式付款至平台指定帐号。</th>
                </tr>
                </if>

                <if condition="$info['b_status'] EGT 5">
                <tr>
                    <td></td>
                    <td></td>
                    <td>已退保证金：<br/>待退保证金：</td>
                    <td class="tdright">{$info.b_id|getAllDepo}元<br/>{$info.b_id|getAllDepo=1}元</td>
                    <td colspan="3"><br/>(其中:{$info.b_id|getAllDepo=1,8}元，今日支付结算后可退。)</td>
                </tr>
                </if>

            </table>
        </div>
    </div>
</div>
<?php
    include 'inc/bot.php';
?>