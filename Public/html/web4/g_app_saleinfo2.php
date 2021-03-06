<?php
    include 'app_inc/top.php';
?>

<div class="cont">
    <div class="tit"><a href="/Wap/Message/index/?item=3"><返回</a>货单详情</div>
    <hr>
    <div class="order_info">
        <label>货单号: {$info.b_code}</label><label>[{$info.b_status|getBillStatus}]</label>
    </div>

    <if condition="$info['b_status'] GT 3 AND $info['b_status'] LT 10">
        <div class="order_info">
            <label><span><b>需支付：85,084.5</b></span>元</label><br/>
            其中：待付利息 <span><b>85</b></span>元，待付跌价差价 <span>
            <b>500</b></span>元，请按合同说明方式付款至平台指定帐号。
        </div>
    </if>

    <div class="order_info">
        <img src="{$info.b_photo}" width="200" height="200" />
    </div>

    <div class="order_info">
        <label>
            {$info.b_name}　
            {$info.b_year}　
            {$info.b_place}　
            {$info.b_level}　
            容重{$info.b_rz}g/l
        </label>
    </div>

    <div class="order_info">
        <label>生霉{$info.b_mb}%</label>
        <label>水份{$info.b_sf}%</label>
        <label>杂质{$info.b_zz}%</label>
        <label>呕吐毒素{$info.b_ot}μg/kg</label>
    </div>

    <div class="order_item">
        净重合计：{$info.b_weig}吨
        <label>初始售价：{$info.b_pri0|formatMoney}元/吨</label>
    </div>

    <div class="order_item">
        入港运费：<b>{$info.b_frei|formatMoney}</b>元　
        (1,200元/车*{$info|getCartNumber}车)
    </div>

    <div class="order_item">
        初始总价：<b>{$info|getAllPrice}</b>元
        <label>保证金：<b>{$info.b_depo|formatMoney}</b>元</label>
    </div>

    <if condition="$info['b_status'] gt 3">
        <div class="order_item">
            回款入帐：<b>340,000</b>元　(2018/07/19 12:21)
        </div>
    </if>

    <div class="order_item">
        装货地址：{$info.b_add}<br/>
        联系人：{$info.b_cont}　　
        手机号：{$info.b_mobi}
    </div>
    <hr>

    <if condition="$info['wait']">
        <div class="order_info" style="text-align:left;">({$info.wait|count})待上架货组　　<b>{$info.b_pri1}</b>元/吨　<a href="/Wap/Sell/changePrice?b_id={$_GET['b_id']}"><修改售价></a></div>
        <volist name="info.wait" id="vo">
            <div class="order_item" onclick="location.href='/Wap/Sell/billItemInfo/bi_id/{$vo.bi_id}?b_code={$info.b_code}'">
                &#8470;.{$vo.bi_id}<label>
                <span><b>[{$vo.bi_status|getBillItemStatus}]</b></span>　(详情)</label><br/>
                货款：<b>{$vo.bi_dpay|formatMoney}</b>元
                ({$info.b_pri0|formatMoney}元/吨)<label>
                {$vo.bi_sum}箱　净重{$info.b_weig}吨</label><br/>
                回款：<b>{$vo.bi_rpay}</b>元<label>
                回款结息：<span><b>{$vo.bi_inte}</b></span>元</label>
            </div>
        </volist>
    </if>


    <if condition="$info['on_sell']">
        <div class="order_info" style="text-align:left;">({$info.on_sell|count})在售货组　　<b>{$info.b_pri1}</b>元/吨　<a href="/Wap/Sell/changePrice?b_id={$_GET['b_id']}"><修改售价></a></div>
        <volist name="info.on_sell" id="vo">
            <div class="order_item" onclick="location.href='/Wap/Sell/billItemInfo/bi_id/{$vo.bi_id}?b_code={$info.b_code}'">
                &#8470;.{$vo.bi_id}<label>
                <span><b>[{$vo.bi_status|getBillItemStatus}]</b></span>　(详情)</label><br/>
                货款：<b>{$vo.bi_dpay|formatMoney}</b>元
                ({$info.b_pri0|formatMoney}元/吨)<label>
                {$vo.bi_sum}箱　净重{$info.b_weig}吨</label><br/>
                回款：<b>{$vo.bi_rpay}</b>元<label>
                回款结息：<span><b>{$vo.bi_inte}</b></span>元</label>
            </div>
        </volist>
    </if>


    <if condition="$info['finish_sell']">
    <div class="order_info" style="text-align:left;">({$info.finish_sell|count})已售货组</div>
        <volist name="info.finish_sell" id="vo">
            <div class="order_item" onclick="location.href='/Wap/Sell/billItemInfo/bi_id/{$vo.bi_id}?b_code={$info.b_code}'">
                &#8470;.{$vo.bi_id}<label>
                <span><b>[{$vo.bi_status|getBillItemStatus}]</b></span>　(详情)</label><br/>
                货款：<b>{$vo.bi_dpay|formatMoney}</b>元
                ({$info.b_pri0|formatMoney}元/吨)<label>
                {$vo.bi_sum}箱　净重{$info.b_weig}吨</label><br/>
                回款：<b>{$vo.bi_rpay}</b>元<label>
                回款结息：<span><b>{$vo.bi_inte}</b></span>元</label>
            </div>
        </volist>
    </if>


    <if condition="$info['over_sell']">
    <div class="order_info" style="text-align:left;">({$info.over_sell|count})已结货组</div>
        <volist name="info.finish_sell" id="vo">
        <div class="order_item" onclick="location.href='/Wap/Sell/billItemInfo/bi_id/{$vo.bi_id}?b_code={$info.b_code}'">
            &#8470;.{$vo.bi_id}<label>
            <span><b>[{$vo.bi_status|getBillItemStatus}]</b></span>　(详情)</label><br/>
            货款：<b>{$vo.bi_dpay|formatMoney}</b>元
            ({$info.b_pri0|formatMoney}元/吨)<label>
            {$vo.bi_sum}箱　净重{$info.b_weig}吨</label><br/>
            回款：<b>{$vo.bi_rpay}</b>元<label>
            回款结息：<span><b>{$vo.bi_inte}</b></span>元</label>
        </div>
        </volist>
    </if>

    <if condition="$info['b_status'] EGT 5">
        <div class="order_info"></div>
        <div class="order_item">
            已退保证金：<b>{$info.b_id|getAllDepo}</b>元
        </div>
        <div class="order_item">
            待退保证金：<b>{$info.b_id|getAllDepo=1}</b>元<br/>
            (其中:<span><b>{$info.b_id|getAllDepo=1,8}</b></span> 元，今日支付结算后可退。)
        </div>
    </if>

        <if condition="$info.b_status gt 0">
            <div class="order_info"><<a href="">查看电子合同</a>></div>
        </if>
        <if condition="$info.b_status eq -1">　
            <div class="order_info">
            <<a href="/Wap/Sell/sellBill/b_id/{$info.b_id}">修改</a>> 　
            <<a href="#" onclick="disp_confirm()">删除</a>>
            </div>
        </if>
    </div>

    <if condition="$info['b_status'] gt 3">
        <label>上架时间：{$info.b_stime|getDateTime}</label>
    </if>
    
<?php
    include 'inc/bot.php';
?>