<?php
    include 'app_inc/top.php';
?>

<div class="cont">
    <div class="tit"><a href="javascript:;" onClick="javascript:history.back(-1);"><返回</a>货单货组详情</div>
    <hr>
    <div class="order_info"><label>货单号: {$_GET['b_code']}</label></div>
    <div class="order_info"><label>货组编号：{$info.bill_item.bi_id} - <span><b>[{$info.bill_item.bi_status|getBillItemStatus}]</b></span></label></div>

    <if condition="$info['bill_item']['bi_status'] gt 3">
        <div class="order_item">
            {$info.bill_item|getBillItemPayStatus}结回款：<label>
            <span><b>{$info.bill_item.bi_rpay|formatMoney}</b></span>元</label>
        </div>
        <div class="order_item">
            {$info.bill_item|getBillItemPayStatus}付利息：<label>
            <span><b>{$info.order_item.oi_id}</b></span>元</label><br/>
            计息：{$info.bill_item|getSellDays}天(回款日开始)
            <label>
                ({$info.bill.b_rrate}元x
                {$info.bill.b_rrate}
                x{$info.bill_item|getSellDays})
            </label>
        </div>
        <div class="order_item">
            {$info.bill_item|getBillItemPayStatus}
            {$info.bill|getBackMoneyText=$info['bill_item']}：
            <span><b>{$info.bill|getBackMoney=$info['bill_item']}</b></span>元
            <label>
                (货款{$info.bill|getClinch=$info['bill_item']}元 -
                回款{$info.bill_item.bi_rpay|formatMoney}元)
            </label>
        </div>
        <div class="order_item">
            {$info.bill_item|getBillItemPayStatus}退保证金：<span>
            <b>{$info.bill_item.bi_depo|formatMoney}</b></span>元 (付清结算费用后即退)
        </div>
    </if>


    <div class="order_info"></div>
    <div class="order_item">
        {$info.bill_item.bi_sum}箱　
        毛重{$info.bill_item.bi_gwei}吨　
        皮重{$info.bill_item.bi_tare}吨　
        净重{$info.bill_item.bi_nwei}吨
    </div>
    <div class="order_item">
        货款合计：<b>{$info.bill_item.bi_dpay|formatMoney}</b>元
        ({$info.bill_item.bi_dpri}元/吨)
    </div>

    <if condition="$info['bill_item']['bi_status'] gt 1">
    <div class="order_item">物流信息：{$info.order_item.oi_otime|getDateTime} [装车]</div>
    <div class="order_item">
        入港时间：{$info.order_item.bi_itime|getDateTime}<br/>
        入港名称：{$info.order_item.bi_pname}
    </div>
    <div class="order_item">
      上架时间：{$info.order_item.bi_stime|getDateTime}
    </div>
    <div class="order_item">
      成交时间：{$info.order_item.bi_dtime|getDateTime} (在售{$info.bill_item|getSellDays}天)
    </div>
    </if>

    <div class="order_info">
        <label>箱号：{$info.bill_item.bi_cnum1}</label>
        <label>封号：{$info.bill_item.bi_snum1}</label><br/>
        <img src="{$Think.config.CN_URL}{$info.bill_item.bi_cnum1_pho}" class="simg" />
        <img src="{$Think.config.SN_URL}{$info.bill_item.bi_snum1_pho}" class="simg" /><br/>
        <label>箱号：{$info.bill_item.bi_cnum2}</label>
        <label>封号：{$info.bill_item.bi_snum2}</label><br/>
        <img src="{$Think.config.CN_URL}{$info.bill_item.bi_cnum2_pho}" class="simg" />
        <img src="{$Think.config.SN_URL}{$info.bill_item.bi_cnum2_pho}" class="simg" /><br/>
        <label><a href="{$Think.config.LD_URL}{$info.bill_item.bi_video1}">A箱视频</a></label>
        <label><a href="{$Think.config.LD_URL}{$info.bill_item.bi_video2}">B箱视频</a></label>
    </div>
</div>

<?php
    include 'inc/bot.php';
?>